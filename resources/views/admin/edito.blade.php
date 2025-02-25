<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link rel="stylesheet" href="{{ asset('css/editu.css') }}">
</head>
<body>
    <div class="container">
        <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>
        <p><strong>Khách hàng:</strong> {{ $order->customer_name }}</p>
        <p><strong>Tổng tiền:</strong> {{ $order->total_price }} VNĐ</p>
        <p><strong>Trạng thái:</strong> {{ ucfirst($order->status) }}</p>
    
        <form method="POST" action="{{ route('orders.update', $order->id) }}">
            @csrf
            @method('PUT')
            <select name="status">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đang giao</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
            <button type="submit">Cập nhật</button>
        </form>
    
        <a href="{{ route('orders.index') }}">Quay lại</a>
    </div>
</body>
</html>
