<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;



class OrderController extends Controller
{
    // Danh sách đơn hàng
    public function index(Request $request)
{
    $orders = Order::query();

    if ($request->has('search')) {
        $orders->where('customer_name', 'like', '%' . $request->search . '%')
               ->orWhere('address', 'like', '%' . $request->search . '%');
    }

    if ($request->has('status')) {
        $orders->where('status', $request->status);
    }

    $orders = $orders->paginate(10);
    return view('admin/manageo', compact('orders'));
}


    // Chi tiết đơn hàng
    public function show(Order $order)
{
    return view('admin/edito', compact('order'));
}

    

public function update(Request $request, Order $order)
{
    $request->validate(['status' => 'required|in:pending,processing,shipped,completed,canceled']);
    $order->update(['status' => $request->status]);

    return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
}
// Xóa đơn hàng
public function destroy(Order $order)
{
    $order->delete();
    return redirect()->route('orders.index')->with('success', 'Xóa đơn hàng thành công.');
}
public function placeOrder()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Giỏ hàng trống!');
        }

        $totalAmount = $cartItems->sum(fn($item) => $item->book->price * $item->quantity);
        $totalQuantity = $cartItems->sum('quantity');

        Order::create([
            'user_id' => $userId,
            'total_price' => $totalAmount,
            'total_quantity' => $totalQuantity,
            'name' => Auth::user()->name,
            'address' => Auth::user()->address,
        ]);

        Cart::where('user_id', $userId)->delete();
        return redirect()->route('user.cart')->with('success', 'Đặt hàng thành công!');
    }
    public function checkout()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('book')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        $totalAmount = $cartItems->sum(fn($item) => $item->book->price * $item->quantity);
        $totalQuantity = $cartItems->sum('quantity');

        return view('user/checkout', compact('user', 'cartItems', 'totalAmount', 'totalQuantity'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
        ]);

        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('book')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống, không thể đặt hàng.');
        }

        $totalAmount = $cartItems->sum(fn($item) => $item->book->price * $item->quantity);

        $order = Order::create([
            'user_id' => $user->id,
            'customer_name' => $request->customer_name,
            'address' => $request->address,
            'total_price' => $totalAmount,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item->book->id,
                'quantity' => $item->quantity,
                'price' => $item->book->price,
            ]);
        }

        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('cart.index')->with('success', 'Thanh toán thành công! Đơn hàng của bạn đã được ghi nhận.');
    }

}