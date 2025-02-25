<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
</head>
<body>
    @include('user/header')
    <section class="banner">
        <h1>Chào mừng {{ Auth::user()->name }} đến với BookStore!</h1>
        <p>Nơi hội tụ những cuốn sách hay nhất</p>
        <a href="{{ asset('user/books') }}" class="btn">Khám phá ngay</a>
    </section>

    <section class="books">
        <h2>Sách nổi bật</h2>
        <div class="book-list">
            @foreach ($books as $book)
                <div class="book">
                    <img src="{{ asset('images/' . $book->image) }}" alt="{{ $book->title }}">
                    <h3>{{ $book->title }}</h3>
                    <p>{{ $book->formatted_price }}đ</p>
                    <a href="{{ route('user.book.show', $book->id) }}" class="btn">Xem ngay</a>
                </div>
            @endforeach
        </div>
    </section>
    @include('footer')
</body>
</html>