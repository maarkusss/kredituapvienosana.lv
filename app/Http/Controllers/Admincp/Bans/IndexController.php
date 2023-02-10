<?php

namespace App\Http\Controllers\Admincp\Bans;

use App\Http\Controllers\Controller;
use App\Models\Admincp\Bans\Bans;

class IndexController extends Controller
{
    /**
     * Show the lenders index page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admincp.bans.index')->with([
            'bans' => $this->getAllBans(),
        ]);
    }

    /**
     * Get all bans
     */
    public function getAllBans()
    {
        return Bans::paginate(20);
    }
}
