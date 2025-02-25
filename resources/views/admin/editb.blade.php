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
    <div style="margin-top: 10px; " class="container">
        <h2 style="margin-top: 5px;">Chỉnh sửa Sách</h2>
        <form method="POST" action="{{ route('admin.manageb.update', $book->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input style="font-size: 15px;" type="text" name="title" value="{{ $book->title }}" required>
            <input style="font-size: 15px;" type="text" name="author" value="{{ $book->author }}" required>
            <input style="font-size: 15px;" type="number" name="price" value="{{ $book->price }}" required>
            <input style="font-size: 15px;" type="text" name="publisher" value="{{ $book->publisher }}" required>
            <label>Ảnh hiện tại:</label><br>
            @if($book->image)
                <img style="margin:auto;" src="{{ asset('images/'.$book->image) }}" width="230">
            @else
                Không có ảnh
            @endif
            <br>
        
            <label>Chọn ảnh mới:</label>
            <input style="font-size: 14px;" type="file" name="image">
            <button type="submit">Cập nhật</button>
        </form>        
        <a href="{{ route('admin.manageb.index5') }}" class="back-btn">← Quay lại</a>
    </div>
</body>
</html>
