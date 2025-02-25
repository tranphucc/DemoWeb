<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <style>
        h2{
            text-align: center;
            margin: 20px auto 10px auto;
        }
        .login{
            text-align: center;
            margin: 10px auto 0px auto;
            padding: 8px;
            background-color: #28a745;
            color: white;
            border-radius:4px;
            text-decoration: none;
        }
        .login:hover{
            background-color:#218838;
        }
    </style>
</head>
<body>
    @include('header')
    <h2>Giỏ hàng</h2>
    <p style="text-align: center;">Bạn cần đăng nhập để xem giỏ hàng.</p>
    <a class="login" href="{{ route('login') }}">Đăng nhập</a>
    @include('footer')
</body>
</html>