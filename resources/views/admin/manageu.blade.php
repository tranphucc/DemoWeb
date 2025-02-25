<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/manageu.css')}}">
</head>
<body>
    @include('admin/header')
    <h2>Quản lý người dùng</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.manageu.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Tên" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <input type="date" name="birth" placeholder="Ngày sinh">
        <input type="text" name="address" placeholder="Địa chỉ"> <!-- Trường địa chỉ mới -->
        <select name="gender">
            <option value="male">Nam</option>
            <option value="female">Nữ</option>
            <option value="other">Khác</option>
        </select>
        <button type="submit">Thêm người dùng</button>
    </form>
    
    <table border="1">
        <tr>
            <th>Tên</th>
            <th>Email</th>
            <th>Ngày sinh</th>
            <th>Địa chỉ</th>
            <th>Giới tính</th>
            <th>Hành động</th>
        </tr>
        @foreach ($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->birth ? date('d-m-Y', strtotime($user->birth)) : 'Chưa có' }}</td>
        <td>{{ $user->address }}</td>
        <td>
            @if ($user->gender === 'male') Nam
            @elseif ($user->gender === 'female') Nữ
            @else Khác
            @endif
        </td>
        <td class="function">
            <div class="action-buttons">
                <a href="{{ route('admin.manageu.edit', $user->id) }}" class="edit">Chỉnh sửa</a>
                <form method="POST" action="{{ route('admin.manageu.destroy', $user->id) }}" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button class="delete" type="submit">Xóa</button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach

    </table>
    <div class="pagination">
        {{ $users->links() }}
    </div>

    @include('footer')
</body>
</html>
