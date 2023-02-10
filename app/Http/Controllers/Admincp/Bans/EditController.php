<?php

namespace App\Http\Controllers\Admincp\Bans;

use App\Http\Controllers\Controller;
use App\Models\Admincp\AdminLogs;
use App\Models\Admincp\Bans\Bans;
use Illuminate\Http\Request;

class EditController extends Controller
{
    /**
     * Show the lenders edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        return view('admincp.bans.edit')->with([
            'ban' => $this->getCurrentBan($id),
        ]);
    }

    /**
     * Edit current ban
     */
    public function update($id, Request $request)
    {
        $ban = $this->getCurrentBan($id);

        $data = $request->validate([
            'ip' => 'required',
            'reason' => 'required',
        ]);

        $ban->update([
            'ip' => $data['ip'],
            'reason' => $data['reason'],
        ]);

        AdminLogs::create(['user_id' => Auth()->id(), 'log' => 'Updated ban "' . $ban->ip . '"']);

        return redirect()->bacK()->with('success', 'Ban has been updated!');
    }

    public function destroy($id)
    {
        $ban = $this->getCurrentBan($id);

        $ban->delete();

        AdminLogs::create(['user_id' => Auth()->id(), 'log' => 'Removed ban "' . $ban->ip . '"']);

        return redirect(route('admincp.bans.index'))->with('success', 'Ban has been removed!');
    }

    /**
     * Show ban by id
     */
    public function getCurrentBan($id)
    {
        return Bans::findOrFail($id);
    }
}
