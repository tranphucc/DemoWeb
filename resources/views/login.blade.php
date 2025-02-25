<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
</head>
<body>
    @include('header')
    
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    <div class="login-container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h2>Đăng Nhập</h2>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng Nhập</button>
            <a href="{{ asset('register')}}">Đăng ký</a>
        </form>
    </div>
    @include('footer')
</body>
</html>
