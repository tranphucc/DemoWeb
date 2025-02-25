<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Kiểm tra nếu chưa đăng nhập
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đánh giá.');
        }

        // Validate dữ liệu
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        // Tạo đánh giá
        Review::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Đánh giá của bạn đã được thêm!');
    }
}
