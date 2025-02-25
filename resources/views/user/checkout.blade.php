<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
</head>
<body>
    @include('user/header')
        <h2>Trang Thanh Toán</h2>
    
        <form action="{{ route('user.checkout.process') }}" method="POST">
            @csrf
            <div>
                <label>Họ và Tên:</label>
                <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name) }}" required>
            </div>
    
            <div>
                <label>Địa chỉ:</label>
                <input type="text" name="address" value="{{ old('address', auth()->user()->address ?? '') }}" required>
            </div>
        
            <h3 style="text-align: center; margin: 10px 0px 10px 0px;">Sản phẩm trong đơn hàng</h3>
            <table border="1">
                <tr>
                    <th>Tên Sách</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                </tr>
                @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->book->title }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->book->price, 0, ',', '.') }} VNĐ</td>
                    <td>{{ number_format($item->book->price * $item->quantity, 0, ',', '.') }} VNĐ</td>
                </tr>
                @endforeach
            
                <!-- Hàng tổng cộng và nút Thanh toán -->
                <tr>
                    <td colspan="3" style="text-align: center; font-weight: bold; font-size: 18px;">Tổng cộng:</td>
                    <td style="color: red; font-weight: bold; font-size: 18px">
                        {{ number_format($totalAmount, 0, ',', '.') }} VNĐ
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;">
                        <button type="submit" class="btn btn-primary">Thanh Toán</button>
                    </td>
                </tr>
            </table>            
        </form>
    @include('footer')
</body>
</html>