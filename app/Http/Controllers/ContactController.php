<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
class ContactController extends Controller
{
    // Hiển thị form liên hệ cho người dùng chưa đăng nhập
    public function showContactForm()
    {
        return view('contact');  
    }

    // Hiển thị form liên hệ cho người dùng đã đăng nhập
    public function showUserContactForm()
    {
        if (auth()->check()) {
            // Người dùng đã đăng nhập
            $user = auth()->user();
            return view('user/contact', compact('user'));  // Gửi thông tin người dùng vào view
        }

        // Nếu người dùng chưa đăng nhập, chuyển hướng về trang contact
        return redirect()->route('contact');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
    
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);
    
        session()->flash('success', 'Cảm ơn bạn đã liên hệ với chúng tôi!');
    
         // Kiểm tra nếu người dùng đã đăng nhập
        if (auth()->check()) {
        // Nếu đã đăng nhập, trả về form của người dùng
        return redirect()->route('user.contact.form');
        }

        // Nếu chưa đăng nhập, trả về form liên hệ chung
        return redirect()->route('contact.form');
    }

public function index2()
{
    {
        // Lấy tất cả dữ liệu liên hệ
        $contacts = Contact::paginate(5);
        
        // Trả về view và truyền dữ liệu vào
        return view('admin.managec', compact('contacts'));
    }
}

public function destroy($id)
{
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return redirect()->route('admin.managec.index2')->with('success', 'Đã xóa phản hồi');
}

}