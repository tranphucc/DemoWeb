<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('user/profile', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'birth' => 'nullable|date',
        'gender' => 'nullable|in:male,female,other',
        'password' => 'nullable|min:6',
        'address' => 'nullable|string|max:255', // Thêm validation cho địa chỉ
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'birth' => $request->birth,
        'gender' => $request->gender,
        'address' => $request->address, // Lưu địa chỉ mới
    ]);

    if ($request->filled('password')) {
        $user->update(['password' => Hash::make($request->password)]);
    }

    return redirect()->route('profile.show')->with('success', 'Cập nhật thành công!');
}

}
