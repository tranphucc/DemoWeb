<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">📚 BookStore</div>
        <nav>
            <ul>
                <li><a href="{{ url('admin/dashboard')}}">Trang chủ</a></li>
                <li><a href="{{ url('admin/manageu') }}">Quản lý người dùng</a></li>
                <li><a href="{{ url('admin/manageb') }}">Quản lý sách</a></li>
                <li><a href="{{ url('admin/manageo')}}">Quản lý đơn hàng</a></li>
                <li><a href="{{ url('admin/managec')}}">Phản hồi</a></li>
                
                <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>