<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link rel="stylesheet" href="{{ asset('css/manageu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
</head>
<body>
    @include('admin/header')
        <h2>Quản lý đơn hàng</h2>
    
        <form method="GET" class="mb-3">
            <input type="text" name="search" placeholder="Tìm kiếm theo tên..." value="{{ request('search') }}">
            <select name="status">
                <option value="">-- Lọc trạng thái --</option>
                <option value="pending">Chờ xử lý</option>
                <option value="processing">Đang xử lý</option>
                <option value="shipped">Đang giao</option>
                <option value="completed">Hoàn thành</option>
                <option value="canceled">Đã hủy</option>
            </select>
            <button type="submit">Tìm kiếm</button>
        </form>
    
        <table class="1">
            <thead>
                <tr>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->total_price }} VNĐ</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}"class="edit">Xem</a>
                        <form method="POST" action="{{ route('orders.destroy', $order->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="delete" type="submit">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    <div class="pagination">
        {{ $orders->links() }}
    </div>
    @include('footer')
</body>
</html>
