<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function updateRole(Request $request, User $user)
    {
        // Hapus role lama
        $user->syncRoles([]);

        // Assign role baru dari request
        $user->assignRole($request->role);

        return redirect()->back()->with('success', 'Role berhasil diubah!');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.usertable')->with('success', 'Deleted');
    }
}
