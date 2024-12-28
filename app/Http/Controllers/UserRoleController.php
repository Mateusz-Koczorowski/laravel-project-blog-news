<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function updateRole(Request $request, $id)
    {
        $this->authorize('isAdmin'); // Autoryzacja admina

        $request->validate([
            'role' => 'required|in:Admin,Author,Reader',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Role updated successfully!');
    }
}

