<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
</head>
<body>
    @include('header')
    <div class="show">
    <div class="book-container">
        <div class="book-image">
            <img src="{{ asset('images/' . $book->image) }}" alt="{{ $book->title }}">
        </div>
        <div class="book-detail">
            <h2>{{ $book->title }}</h2>
            <p>Tác giả: {{ $book->author }}</p>
            <h4>Giá: {{ number_format($book->price, 0, ',', '.') }}đ</h4>
            <p>Nhà xuất bản: {{ $book->publisher }}</p>

            <p><a href="{{ route('login') }}">Đăng nhập</a> để viết đánh giá và thêm vào giỏ hàng.</p>
        </div>
    </div>

    <div class="book-container">
        <div class="book-detail">
            <h3>Đánh giá:</h3>
            <ul>
                @foreach ($reviews as $review)
                <li>
                    {{ $review->user->name }} - {{ $review->rating }} ⭐: {{ $review->comment }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    </div>
    @include('footer')
</body>
</html>