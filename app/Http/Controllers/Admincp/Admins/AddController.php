<?php

namespace App\Http\Controllers\Admincp\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admincp\AdminLogs;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AddController extends Controller
{
    /**
     * Show the lenders edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admincp.admins.add')->with([
            'roles' => $this->getAllRoles(),
        ]);
    }

    /**
     * Create new user
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
        ]);

        $user = new User();

        $user->first_name = $data['first_name'];
        $user->email = $data['email'];
        $user->last_name = $data['last_name'];
        $user->username = $data['username'];
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);

        $user->save();

        foreach ($request->permissions as $group => $active) {
            $user->givePermissionTo($group);
        }

        AdminLogs::create(['user_id' => Auth()->id(), 'log' => 'Added admin "' . $data['first_name'] . ' ' . $data['last_name'] . '"']);

        return redirect(route('admincp.admins.index'))->with('success', 'Admin has been added!');
    }

    /**
     * Get all roles
     */
    public function getAllRoles()
    {
        return Role::get();
    }
}
