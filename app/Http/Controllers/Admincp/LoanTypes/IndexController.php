<?php

namespace App\Http\Controllers\Admincp\LoanTypes;

use App\Http\Controllers\Controller;
use App\Models\Admincp\AdminLogs;
use App\Models\Admincp\Lenders\LendersCategories;
use App\Models\Admincp\LoanTypes\LoanTypes;
use App\Models\Admincp\LoanTypes\LoanTypesHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    /**
     * Show the lenders index page.
     */
    public function index()
    {
        return view('admincp.loantypes.index')->with([
            'loantypes' => $this->getAllLoanTypes(),
        ]);
    }

    /**
     * Show the lenders edit page.
     */
    public function create()
    {
        return view('admincp.loantypes.add')->with([
            'types' => $this->getAllTypes(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'route_name' => 'required',
            'title' => 'required',
        ]);

        if ($request->type > 0) {
            $parent_id = $request->type;
        } else {
            $parent_id = null;
        }

        $loantypes = new LoanTypes();

        $loantypes->parent_type_id = $parent_id;
        $loantypes->lang = App::getLocale();
        $loantypes->order = $this->getLastOrderId($parent_id);
        $loantypes->name = $data['name'];
        $loantypes->route_name = $data['route_name'];
        $loantypes->title = $request->title;
        $loantypes->description = $request->description;
        $loantypes->keywords = $request->keywords;
        $loantypes->anchor_element_title = $request->anchor_element_title;
        $loantypes->h1 = $request->h1;
        $loantypes->h1_description = $request->h1_description;
        $loantypes->text = $request->text;
        $loantypes->active = $request->active;

        $loantypes->save();

        LoanTypesHistory::create([
            'parent_type_id' => $parent_id,
            'user_id' => Auth()->id(),
            'loan_type_id' => $loantypes->id,
            'lang' => App::getLocale(),
            'name' => $data['name'],
            'route_name' => $data['route_name'],
            'title' => $request->title,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'anchor_element_title' => $request->anchor_element_title,
            'h1' => $request->h1,
            'h1_description' => $request->h1_description,
            'text' => $request->text,
        ]);

        AdminLogs::create(['user_id' => Auth()->id(), 'log' => 'Created loantype "' . $data['name'] . '"']);

        return redirect(route('admincp.loantypes.index'))->with('success', 'Loan type has been added!');
    }

    /**
     * Show the lenders edit page.
     */
    public function edit($loantype_id)
    {
        return view('admincp.loantypes.edit')->with([
            'loantype' => $this->getLoanTypeById($loantype_id),
            'history' => $this->getLoanTypeHistory($loantype_id),
            'types' => $this->getAllTypes(),
        ]);
    }

    public function update($id, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'route_name' => 'required',
            'title' => 'required',
        ]);

        if ($request->type > 0) {
            $parent_id = $request->type;
        } else {
            $parent_id = null;
        }

        LoanTypesHistory::create([
            'parent_type_id' => $parent_id,
            'user_id' => Auth()->id(),
            'loan_type_id' => $id,
            'lang' => App::getLocale(),
            'route_name' => $data['route_name'],
            'name' => $data['name'],
            'title' => $request->title,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'anchor_element_title' => $request->anchor_element_title,
            'h1' => $request->h1,
            'h1_description' => $request->h1_description,
            'text' => $request->text,
        ]);

        LoanTypes::where('id', $id)->update([
            'parent_type_id' => $parent_id,
            'active' => $request->active,
            'lang' => App::getLocale(),
            'name' => $data['name'],
            'route_name' => $data['route_name'],
            'title' => $request->title,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'anchor_element_title' => $request->anchor_element_title,
            'h1' => $request->h1,
            'h1_description' => $request->h1_description,
            'text' => $request->text,
        ]);

        AdminLogs::create(['user_id' => Auth()->id(), 'log' => 'Updated loantype "' . $data['name'] . '"']);

        return redirect(route('admincp.loantypes.index'))->with('success', 'Loan type has been updated!');
    }

    public function destroy($id)
    {
        LoanTypes::where('id', $id)->delete();

        LendersCategories::where('loan_type_id', $id)->delete();

        AdminLogs::create(['user_id' => Auth()->id(), 'log' => 'Deleted leantype "' . $id . '"']);

        return redirect()->route('admincp.loantypes.index')->with([
            'success' => 'Loantype has been deleted!',
        ]);
    }

    public function updateOrder()
    {
        $arr = request()->loantypes['order'];

        if (request()->subsection) {
            $subs_arr = request()->subsection['order'];

            asort($subs_arr);

            $i = 0;

            foreach ($subs_arr as $id => $value) {
                $i++;

                LoanTypes::where('id', $id)->update(['order' => $i]);
            }

            foreach (request()->subsection['active'] as $id => $value) {
                LoanTypes::where('id', $id)->update(['active' => $value]);
            }
        }

        asort($arr);

        $i = 0;

        foreach ($arr as $id => $value) {
            $i++;

            LoanTypes::where('id', $id)->update(['order' => $i]);
        }

        foreach (request()->loantypes['active'] as $id => $value) {
            LoanTypes::where('id', $id)->update(['active' => $value]);
        }

        AdminLogs::create(['user_id' => Auth()->id(), 'log' => 'Updated all loantypes info on Loantypes main page']);

        return redirect()->back()->with('success', 'Loantypes updated!');
    }

    public function getLoanTypeById($id)
    {
        if (request()->history) {
            return LoanTypesHistory::where('loan_type_id', $id)->where('id', request()->history)->firstOrFail();
        }

        return LoanTypes::findOrFail($id);
    }

    public function getAllTypes()
    {
        return LoanTypes::where('lang', App::getLocale())->where('parent_type_id', null)->get();
    }

    public function getLoanTypeHistory($id)
    {
        return LoanTypesHistory::where('loan_type_id', $id)->orderBy('created_at', 'DESC')->get();
    }

    /**
     * Get last order id
     */
    public function getLastOrderId($parent_id)
    {
        if ($parent_id > 0) {
            $loantypes = LoanTypes::where('parent_type_id', $parent_id)->where('lang', App::getLocale())->orderBy('order', 'DESC')->first();
        } else {
            $loantypes = LoanTypes::orderBy('order', 'DESC')->where('parent_type_id', null)->where('lang', App::getLocale())->first();
        }

        if ($loantypes) {
            return $loantypes->order + 1;
        } else {
            return 1;
        }
    }

    public function getAllLoanTypes()
    {
        return LoanTypes::where('lang', App::getLocale())->where('parent_type_id', null)->orderBy('order', 'ASC')->get();
    }
}
