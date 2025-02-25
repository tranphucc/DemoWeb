<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        return view('cart');
    }

    public function index()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('book')->get();
        $totalAmount = $cartItems->sum(fn($item) => $item->book->price * $item->quantity);

        return view('user/cart', compact('cartItems', 'totalAmount'));
    }

    public function addToCart(Request $request, $bookId)
{
    $cartItem = Cart::where('user_id', auth()->id())
                    ->where('book_id', $bookId)
                    ->first();

    if ($cartItem) {
        // Nếu đã có sách trong giỏ hàng, chỉ tăng số lượng lên 1
        $cartItem->quantity += 1;
        $cartItem->save();
    } else {
        // Nếu chưa có, thêm mới
        Cart::create([
            'user_id' => auth()->id(),
            'book_id' => $bookId,
            'quantity' => 1
        ]);
    }

    return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công!');
}

    public function requireLogin()
    {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm vào giỏ hàng!');
    }
    public function removeFromCart($cartId)
    {
        $cartItem = Cart::where('id', $cartId)->where('user_id', auth()->id())->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Xóa sách khỏi giỏ hàng thành công!');
        }

        return redirect()->back()->with('error', 'Không tìm thấy sách trong giỏ hàng!');
    }

    public function showBook($bookId)
    {
        $book = Book::findOrFail($bookId);
        $reviews = Review::where('book_id', $bookId)->with('user')->get();
        $user = Auth::user();

        if ($user) {
            return view('user/show', compact('book', 'reviews', 'user'));
        } else {
            return view('show', compact('book', 'reviews'));
        }
        
    }

    public function addReview(Request $request, $bookId)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:500'
    ]);

    Review::create([
        'user_id' => auth()->id(),
        'book_id' => $bookId,
        'rating' => $request->rating,  // Thêm dòng này
        'comment' => $request->comment
    ]);

    return redirect()->back();
}


    public function updateReview(Request $request, $reviewId)
    {
        $request->validate([
            'comment' => 'required|string|max:500'
        ]);

        $review = Review::where('id', $reviewId)->where('user_id', auth()->id())->first();
        
        if ($review) {
            $review->update(['comment' => $request->comment]);
            return redirect()->back()->with('success', 'Đánh giá đã được cập nhật!');
        }

        return redirect()->back()->with('error', 'Không tìm thấy đánh giá!');
    }

    public function deleteReview($reviewId)
    {
        $review = Review::where('id', $reviewId)->where('user_id', auth()->id())->first();

        if ($review) {
            $review->delete();
            return redirect()->back()->with('success', 'Đánh giá đã được xóa!');
        }

        return redirect()->back()->with('error', 'Không tìm thấy đánh giá!');
    }

}
