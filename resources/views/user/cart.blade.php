<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/manageu.css') }}">
    <style>
        .buy{
            text-decoration: none;
            color: white;
            background-color: #28a745;
            padding: 8px;
            margin: 20px auto 0px auto;
            border-radius:4px;
            transition: 0.3s;
        }
        .buy:hover{
            background: #218838;
        }
    </style>
</head>
<body>
    @include('user/header')
        <h2>Giỏ Hàng</h2>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        @if($cartItems->isEmpty())
            <p style="text-align: center;">Giỏ hàng của bạn đang trống.</p>
            <a class="buy" href="{{asset('user/books')}}">Mua ngay</a>
        @else
        <table border="1">
            <thead>
                <tr>
                    <th>Tên Sách</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Hành động</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->book->title }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->book->price, 0, ',', '.') }} VNĐ</td>
                    <td>
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button style="margin: auto; padding: 7px 15px 7px 15px;" type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                    <td>{{ number_format($item->book->price * $item->quantity, 0, ',', '.') }} VNĐ</td>
                </tr>
                @endforeach
                <!-- Hàng tổng cộng và thanh toán -->
                <tr>
                    <td colspan="4" style="text-align: center; font-weight: bold; font-size: 18px;">Tổng cộng:</td>
                    <td style="color: red; font-weight: bold; font-size: 18px">{{ number_format($totalAmount, 0, ',', '.') }} VNĐ</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;">
                        <a href="{{ route('checkout') }}" class="btn btn-primary">Thanh Toán</a>
                    </td>
                </tr>
            </tbody>
        </table>        
        @endif
    @include('footer')
</body>
</html>