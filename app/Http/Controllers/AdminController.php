<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/dashboard');
    }

    public function index1()
    {
        $users = User::paginate(5); 
        return view('admin/manageu', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'birth' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth' => $request->birth,
            'address' => $request->address,
            'gender' => $request->gender,
        ]);

        return redirect()->route('admin.manageu.index1')->with('success', 'Thêm người dùng thành công!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin/editu', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:255',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->birth = $request->birth;
        $user->gender = $request->gender;
        $user->address = $request->address;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.manageu.index1')->with('success', 'Cập nhật người dùng thành công!');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.manageu.index1')->with('success', 'Đã xóa người dùng!');
    }
}
