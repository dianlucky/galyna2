<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.data', compact('users'));
    }

    public function create()
    {
        $data = [
            'form' => 'Create',
            'action' => url('admin/user')
        ];
        return view('admin.user.form', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required',
            'role' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->role = $request->role;
        $user->save();

        session()->flash('success', 'Data saved successfully');
        return redirect('admin/user');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $data = [
            'form' => 'Edit',
            'action' => url('admin/user/' . $id),
        ];
        return view('admin.user.form', compact('data', 'user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user,email,' . $id . ',id_user',
            'password' => 'nullable',
            'role' => 'required'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->password) {
            $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        }
        $user->save();

        session()->flash('success', 'Data updated successfully');
        return redirect('admin/user');
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();

        session()->flash('success', 'Data deleted successfully');
        return redirect('admin/user');
    }
}
