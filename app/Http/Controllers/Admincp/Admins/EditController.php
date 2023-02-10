<?php

namespace App\Http\Controllers\Admincp\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admincp\AdminLogs;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class EditController extends Controller
{
    /**
     * Show the lenders edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        return view('admincp.admins.edit')->with([
            'user' => $this->getCurrentUser($id),
            'roles' => $this->getAllRoles(),
        ]);
    }

    /**
     * Update user function
     */
    public function update($id, Request $request)
    {
        $user = $this->getCurrentUser($id);

        $permissions = $user->getPermissionNames();
        foreach ($permissions as $permission) {
            $user->revokePermissionTo($permission);
        }

        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);

        $user->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
        ]);

        if ($request->permissions) {
            foreach ($request->permissions as $group => $active) {
                $user->givePermissionTo($group);
            }
        }

        if ($request->password) {
            $user->update([
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
            ]);
        }

        AdminLogs::create(['user_id' => Auth()->id(), 'log' => 'Updated admin "' . $user->first_name . ' ' . $user->last_name . '"']);

        return redirect()->back()->with('success', 'Admin has been updated!');
    }

    /**
     * Delete user
     */
    public function destroy($id)
    {
        $user = $this->getCurrentUser($id);

        if (Auth()->id() !== $user->id) {
            $user->delete();
        }

        AdminLogs::create(['user_id' => Auth()->id(), 'log' => 'Deleted admin "' . $user->first_name . ' ' . $user->last_name . '"']);

        return redirect(route('admincp.admins.index'))->with('success', 'Admin has been deleted!');
    }

    /**
     * Get current $id user
     */
    public function getCurrentUser($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Get all roles
     */
    public function getAllRoles()
    {
        return Role::get();
    }
}
