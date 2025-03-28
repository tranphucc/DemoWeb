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
    @include('user/header')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
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

            
            <form action="{{ route('cart.add', $book->id) }}" method="POST">
                @csrf
                <button type="submit">Thêm vào giỏ hàng</button>
                
            </form>
        </div>
    </div>
    <div class="book-container">
        <div class="book-detail">
        <h3>Đánh giá:</h3>
            <ul>
                @foreach ($reviews as $review)
                <li>
                    {{ $review->user->name }} - {{ $review->rating }} ⭐: {{ $review->comment }}
            
                    @if (auth()->check() && auth()->id() == $review->user_id)
                    <form action="{{ route('review.delete', $review->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button style="background-color: rgb(234, 0, 0);" type="submit" >Xóa</button>
                    </form>
                    @endif
                </li>
                @endforeach
            </ul>
            <form action="{{ route('review.add', $book->id) }}" method="POST">
                @csrf
                <label for="rating">Đánh giá:</label>
                <select name="rating" id="rating" required>
                    <option value="1">1 sao</option>
                    <option value="2">2 sao</option>
                    <option value="3">3 sao</option>
                    <option value="4">4 sao</option>
                    <option value="5">5 sao</option>
                </select>
                <textarea name="comment" required></textarea>
                <button type="submit">Gửi đánh giá</button>
            </form>
            
        </div>
    </div>
    </div>
    @include('footer')
</body>
</html>

