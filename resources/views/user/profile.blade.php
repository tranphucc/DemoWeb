<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
    @include('user/header')
    <div class="profile-container">
        <h2>Thông Tin Cá Nhân</h2>

        @if(session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <p class="error-message">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <label for="name">Tên:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>

            <label for="birth">Ngày Sinh:</label>
            <input type="date" name="birth" id="birth" value="{{ old('birth', isset($user->birth) ? $user->birth->format('Y-m-d') : '') }}">

            <label for="address">Địa chỉ:</label>
            <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}">


            <label for="gender">Giới Tính:</label>
            <select name="gender" id="gender">
                <option value="">Chọn giới tính</option>
                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Nam</option>
                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Nữ</option>
                <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Khác</option>
            </select>
            
            <label for="password">Đổi mật khẩu</label>
            <input type="password" name="password" id="password">

            <button type="submit">Cập Nhật</button>
        </form>
    </div>
    @include('footer')
</body>
</html>
