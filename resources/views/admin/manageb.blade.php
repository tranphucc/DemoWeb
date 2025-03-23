<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link rel="stylesheet" href="{{ asset('css/manageu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
</head>
<body>
    @include('admin.header')
    <h2>Quản lý Sách</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.manageb.store') }}">
        @csrf
        <input type="text" name="title" placeholder="Tiêu đề" required>
        <input type="text" name="author" placeholder="Tác giả" required>
        <input type="text" name="price" placeholder="Giá" required>
        <input type="file" name="image">
        <input type="text" name="publisher" placeholder="Nhà xuất bản"required>
        <button type="submit">Thêm Sách</button>
    </form>

    <table border="1">
        <tr>
            <th>Ảnh</th>
            <th>Tên sách</th>
            <th>Tác giả</th>
            <th>Nhà xuất bản</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
        @foreach ($books as $book)
        <tr>
            <td>
                @if($book->image)
                <img src="{{ asset('images/' . $book->image) }}" alt="{{ $book->title }}" width="100px">
                @else
                    <p>Chưa có ảnh</p>
                @endif
                
            </td>            
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->publisher }}</td>
            <td>{{ number_format($book->price, 0, ',', '.') }}đ</td>
            <td class="function">
                <div class="action-buttons">

                    <a href="{{ route('admin.manageb.edit', $book->id) }}" class="edit">Chỉnh sửa</a>
                    <form method="POST" action="{{ route('admin.manageb.destroy', $book->id) }}" class="delete-form">
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
        {{ $books->links() }}
    </div>

    @include('footer')
</body>
</html>
