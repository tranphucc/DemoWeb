<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link rel="stylesheet" href="{{ asset('css/contact.css')}}">
    <link rel="stylesheet" href="{{ asset('css/layout.css')}}">
</head>
<body>
    @include('user/header')
    <div class="container">
        <h2>Liên hệ với chúng tôi</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf 
                <input type="text" id="name" name="name" placeholder="Tên đầy đủ" value="{{ $user->name }}" readonly><br>

                <input type="email" id="email" name="email" placeholder="Email" value="{{ $user->email }}" readonly><br>

                <textarea id="message" name="message" placeholder="Phản hồi" required></textarea>
            <button type="submit">Gửi</button>
        </form>
    </div>
    @include('footer')
</body>
</html>