<?php

namespace App\Http\Controllers;

use App\Models\Admincp\Lenders\Lenders;
use App\Models\Admincp\Lenders\LendersCategories;
use App\Models\Admincp\Lenders\LendersSorting;
use App\Models\Admincp\Lenders\LendersSortingEpc;
use App\Models\Admincp\Lenders\Visits;
use App\Models\Admincp\Lenders\VisitsSorting;
use App\Models\Admincp\LoanTypes\LoanTypes;
use App\Models\Admincp\Sections\Sections;
use App\Models\Reviews;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class DeepSectionController extends Controller
{
    /**
     * Return a deep section.
     *
     * @param string $name
     * @param string $deep_name
     * @return View
     * @throws ModelNotFoundException
     */
    public function index(Request $request, string $name, string $deep_name)
    {
        $loanType = LoanTypes::where('route_name', $deep_name)->where('lang', App::getLocale())->where('active', true)->first();
        $lender = Lenders::where('route_name', $deep_name)->where('active', true)->first();
        $section = Sections::where('route_name', $name)->where('lang', App::getLocale())->where('active', true)->where('type', '!=', 'home')->first();

        if (!$loanType && !$section && !$lender) {
            abort(404);
        }

        if ($loanType) {
            $parentLoanType = LoanTypes::whereNull('parent_type_id')->where('route_name', $name)->where('lang', App()->getLocale())->where('active', 1)->first();

            // Checking if the loan type from 1st URL parameter does not exist
            if (!$parentLoanType) {

                $redirect_loan_type = LoanTypes::where('id', $loanType->parent_type_id)->where('active', true)->first();
                // If the loan types could not be found, throw a 404
                if (!$redirect_loan_type) {
                    abort(404);
                }

                // Redirect to the corect loan type of the current locale
                if ($redirect_loan_type) {
                    return redirect()->route('section.deep', [
                        'name' => $redirect_loan_type->route_name,
                        'deep_name' => $deep_name
                    ]);
                }
            }
        }

        if ($lender) {
            $parentSection = Sections::whereNull('parent_section_id')->where('route_name', $name)->where('lang', App()->getLocale())->where('type', 'reviews')->where('active', 1)->first();

            // Checking if the section from 1st URL parameter does not exist
            if (!$parentSection) {

                $redirect_section = Sections::whereNull('parent_section_id')->where('lang', App()->getLocale())->where('type', 'reviews')->where('active', 1)->first();
                // If the section could not be found, throw a 404
                if (!$redirect_section) {
                    abort(404);
                }

                // Redirect to the corect parent section of the current locale
                if ($redirect_section) {
                    return redirect()->route('section.deep', [
                        'name' => $redirect_section->route_name,
                        'deep_name' => $deep_name
                    ]);
                }
            }
        }

        $utm_campaign = $request->utm_campaign ? $request->utm_campaign : $request->cookie('utm_campaign');

        $sorting = LendersSorting::where('campaign_name', $utm_campaign)->first();

        if ($sorting) {
            $sorting_epc = LendersSortingEpc::where('sorting_id', $sorting->id)->get();
        } else {
            $sorting_epc = [];
        }

        $lenders = [];
        $lenders_array = [];

        if ($loanType) {
            $bot = false;

            if (stristr(request()->header('user-agent'), 'bot') || stristr(request()->header('user-agent'), 'crawler') || stristr(request()->header('user-agent'), 'Skype')) {
                $bot = true;
            }

            $visit = $this->createVisit($bot);

            if ($utm_campaign && count($sorting_epc) !== 0) {
                foreach ($sorting_epc as $sorting) {
                    $lender = Lenders::where('id', $sorting->lender_id)->first();
                    $categories = LendersCategories::where('loan_type_id', $loanType->id)->where('lender_id', $lender->id)->exists();

                    if ($lender->active && $categories) {
                        if ($lender->frequency) {
                            if (rand(1, $lender->frequency) == $lender->frequency) {
                                $lenders[$sorting->position] = $lender;
                            }
                        } else {
                            $lenders[$sorting->position] = $lender;
                        }
                    }
                }
            } else {
                $categories = LendersCategories::where('loan_type_id', $loanType->id)->get();

                foreach ($categories as $category) {
                    $lender = Lenders::where('id', $category->lender_id)->first();
                    if ($lender) {
                        if ($lender->position && $lender->active) {
                            if ($lender->frequency) {
                                if (rand(1, $lender->frequency) == $lender->frequency) {
                                    $lenders[$lender->position] = $lender;
                                }
                            } else {
                                $lenders[$lender->position] = $lender;
                            }
                        }
                    }
                }
            }

            if ($lenders) {
                ksort($lenders);
            }

            $i = 1;

            foreach ($lenders as $lender) {
                $this->createVisitSorting($visit, $lender->id, $i, $bot);

                $lenders_array[$i++] = $lender;
            }
        }

        if ($loanType) {
            return view('loan-type')->with([
                'loanType' => $loanType,
                'lenders' => $lenders_array,
                'reviews' => Reviews::whereNotNull('rating')->get(),
                'reviewSection' =>  Sections::where('type', 'reviews')->where('lang', App::getLocale())->where('active', true)->first(),
            ]);
        }

        if ($lender) {
            $reviews = Reviews::where('lender_id', $lender->id)->get();
            // Average rating
            $ratings = 0;

            foreach ($reviews as $review) {
                $ratings = $ratings + $review->rating;
                $average_rating = number_format(($ratings / $reviews->count()), 1);
            }

            return view('reviews.show')->with([
                'lender' => $lender,
                'lenders' => Lenders::query()
                    ->whereHas('data', function ($query) {
                        $query->where('lang', App::getLocale());
                    })
                    ->where('active', true)->get(),
                'section' => $section,
                'reviews' => $reviews,
                'average_rating' => $reviews->count() > 0 ? $average_rating : '0',
            ]);
        } else {
            $section = Sections::where('route_name', $deep_name)
                ->where('lang', App::getLocale())
                ->where('active', true)
                ->firstOrFail();

            $parentSection = Sections::where('id', $section->parent_section_id)
                ->where('route_name', $name)
                ->where('lang', App::getLocale())
                ->where('active', true)
                ->firstOrFail();

            return view('blog.blog')->with([
                'blogPost' => $section,
                'blogPostParent' => $parentSection,
            ]);
        }
    }

    public function createVisit($bot): int
    {
        $visit = new Visits();

        if (request()->cookie('visitor_id')) {
            $visit->visitor_id = request()->cookie('visitor_id');
        } else {
            $visit->visitor_id = null;
        }

        $visit->utm_campaign = request()->cookie('utm_campaign');
        $visit->bot = $bot;

        $visit->save();

        return $visit->id;
    }

    public function createVisitSorting($visit_id, $lender_id, $position, $bot)
    {
        VisitsSorting::create([
            'visit_id' => $visit_id,
            'lender_id' => $lender_id,
            'position' => $position,
            'bot' => $bot,
        ]);

        return true;
    }
}
