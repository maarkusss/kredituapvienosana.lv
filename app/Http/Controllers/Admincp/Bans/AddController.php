<?php

namespace App\Http\Controllers\Admincp\Bans;

use App\Http\Controllers\Controller;
use App\Models\Admincp\AdminLogs;
use App\Models\Admincp\Bans\Bans;
use Illuminate\Http\Request;

class AddController extends Controller
{
    /**
     * Show the lenders edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admincp.bans.add');
    }

    /**
     * Add new ban
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'ip' => 'required',
            'reason' => 'required',
        ]);

        Bans::create([
            'ip' => $data['ip'],
            'reason' => $data['reason'],
        ]);

        AdminLogs::create(['user_id' => Auth()->id(), 'log' => 'Added ban "' . $data['ip'] . '"']);

        return redirect(route('admincp.bans.index'))->with('success', 'Ban has been added!');
    }
}
