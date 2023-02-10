<?php

namespace App\Http\Controllers;

use App\Models\Admincp\Faqs\Faqs;
use App\Models\Admincp\Lenders\Lenders;
use App\Models\Admincp\Lenders\LendersCategories;
use App\Models\Admincp\Lenders\LendersSorting;
use App\Models\Admincp\Lenders\LendersSortingEpc;
use App\Models\Admincp\Lenders\Visits;
use App\Models\Admincp\Lenders\VisitsSorting;
use App\Models\Admincp\LoanTypes\LoanTypes;
use App\Models\Admincp\Sections\Sections;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SectionController extends Controller
{
    /**
     * Return a section.
     *
     * @param Request $request
     * @param string $name
     * @return View
     * @throws HttpException
     */
    public function index(Request $request, string $name)
    {
        $loanType = LoanTypes::where('route_name', $name)->where('lang', App::getLocale())->where('active', true)->first();
        $section = Sections::where('route_name', $name)->where('lang', App::getLocale())->where('active', true)->where('type', '!=', 'home')->first();
        $faqs = Faqs::where('lang', App::getLocale())->where('active', true)->get();

        if (!$loanType && !$section) {
            abort(404);
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
        } elseif ($section->type == 'contact') {
            $loanTypes = LoanTypes::where('lang', App::getLocale())->where('active', true)->orderBy('order')->get();

            return view('contact-us')->with([

                'section' => $section,
                'loanTypes' => $loanTypes,
                'faqs' => $faqs,
            ]);
        } elseif ($section->type == 'reviews') {
            $lenders = Lenders::where('active', true)->get();

            return view('reviews.index')->with([
                'lenders' => $lenders,
                'section' => $section,
            ]);
        } elseif ($section->type == 'blog') {
            $blogPosts = Sections::where('parent_section_id', $section->id)
                ->where('lang', App::getLocale())
                ->where('type', 'blog')
                ->where('active', true)
                ->orderBy('order')
                ->paginate(5);

            return view('blog.index')->with([
                'section' => $section,
                'blogPosts' => $blogPosts,
            ]);
        } else {
            return view('footer-page')->with([
                'section' => $section,
                'faqs' => $faqs,
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
