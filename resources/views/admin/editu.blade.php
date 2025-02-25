<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link rel="stylesheet" href="{{ asset('css/editu.css') }}">
</head>
<body>
    <div class="container">
        <h2>Chỉnh sửa người dùng</h2>
        <form method="POST" action="{{ route('admin.manageu.update', $user->id) }}">
            @csrf
            @method('PUT')
            <input type="text" name="name" value="{{ $user->name }}" required>
            <input type="email" name="email" value="{{ $user->email }}" required>
            <input type="password" name="password" placeholder="Nhập mật khẩu mới (bỏ trống nếu không đổi)">
            <input type="date" name="birth" value="{{ $user->birth }}">
            <input type="text" name="address" value="{{ $user->address }}" placeholder="Nhập địa chỉ"> <!-- Trường địa chỉ -->
            <select name="gender">
                <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Nam</option>
                <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Nữ</option>
                <option value="other" {{ $user->gender === 'other' ? 'selected' : '' }}>Khác</option>
            </select>
            <button type="submit">Cập nhật</button>
        </form>        
        <a href="{{ route('admin.manageu.index1') }}" class="back-btn">← Quay lại</a>
        
    </div>
</body>
</html>
