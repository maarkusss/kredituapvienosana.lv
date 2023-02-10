<?php

namespace App\Http\Controllers\Admincp\Admins;

use App\Http\Controllers\Controller;
use App\User;

class IndexController extends Controller
{
    /**
     * Show the lenders index page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admincp.admins.index')->with([
            'users' => $this->getAllUsers(),
        ]);
    }

    /**
     * Return all users with pagination
     */
    public function getAllUsers()
    {
        return User::paginate(20);
    }
}
