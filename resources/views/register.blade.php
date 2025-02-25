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
    <div class="login-container">
        <h2>Đăng ký</h2>
        @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p style="color: red;">{{ $error }}</p>
            @endforeach
        </div>
        @endif
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <input type="name" name="name" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng ký</button>
        </form>
        
    </div>
    @include('footer')
</body>
</html>
