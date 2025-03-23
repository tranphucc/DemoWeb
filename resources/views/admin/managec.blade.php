<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookStore</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link rel="stylesheet" href="{{ asset('css/manageu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
</head>
<body>
    @include('admin/header')
    <h2>Phản hồi khách hàng</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Phản hồi</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ Str::limit($contact->message, 50) }}</td>
                    <td>
                        <form  action="{{ route('admin.managec.destroy', $contact->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button style="margin: auto;" type="submit" class="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $contacts->links() }}
    </div>
    @include('footer')
</body>
</html>
    

