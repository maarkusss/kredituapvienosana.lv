<?php

namespace App\Http\Controllers\Admincp\Lenders;

use App\Http\Controllers\Controller;
use App\Models\Admincp\AdminLogs;
use App\Models\Admincp\Lenders\Lenders;
use App\Models\Admincp\Lenders\LendersCategories;
use App\Models\Admincp\LoanTypes\LoanTypes;
use App\Models\Admincp\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AddController extends Controller
{
    /**
     * Show the lenders edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admincp.lenders.add')->with([
            'categories' => $this->getCategories(),
            'languages' => $this->getLanguages(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return LoanTypes::where('active', 1)->orderBy('order', 'ASC')->get();
    }

    /**
     * @return mixed
     */
    public function getLanguages()
    {
        return Settings::where('name', 'lang')->get();
    }

    public function create(Request $request)
    {
        if (!$request->category) {
            return redirect()->back()->with('error', 'Atleast 1 category must be selected!');
        }

        $data = $request->validate([
            'name' => 'required',
            'affLink' => 'required',
            'route_name' => 'required',
            'firstLoan' => 'required',
            'minAmount' => 'required',
            'maxAmount' => 'required',
            'minTerm' => 'required',
            'maxTerm' => 'required',
            'minYears' => 'required',
            'maxYears' => 'required',
            'receivingTime' => 'required',
        ]);

        $path = Storage::putFile('public/logos', $request->file('image'));

        $path = explode('/', $path);
        $path = '/storage/' . $path[1] . '/' . $path[2];

        $lender = new Lenders();

        $lender->name = $data['name'];
        $lender->image = $path;
        $lender->affiliate_link = $data['affLink'];
        $lender->route_name = $data['route_name'];
        $lender->first_loan = $data['firstLoan'];
        $lender->min_amount = $data['minAmount'];
        $lender->max_amount = $data['maxAmount'];
        $lender->min_term = $data['minTerm'];
        $lender->max_term = $data['maxTerm'];
        $lender->min_years = $data['minYears'];
        $lender->max_years = $data['maxYears'];
        $lender->receiving_time = $data['receivingTime'];
        $lender->active = $request->active;
        $lender->zero_percent = $request->zero_percent;

        $lender->save();

        foreach ($request->category as $key => $value) {
            if ($value == 1) {
                LendersCategories::create([
                    'lender_id' => $lender->id,
                    'loan_type_id' => $key,
                ]);
            }
        }

        AdminLogs::create(['user_id' => Auth()->id(), 'log' => 'Created lender "' . $data['name'] . '"']);

        return redirect(route('admincp.lenders.index'))->with(['success', 'Lender has been added!']);
    }
}
