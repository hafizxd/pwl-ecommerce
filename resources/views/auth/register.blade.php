<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <a href="{{ route('login') }}">Login</a>
    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="name" name="name" id="name">
            @error('name')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            @error('email')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            @error('password')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password_confirmation">Password Confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
            @error('password_confirmation')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <input type="submit" value="Register">
        </div>
    </form>
</body>
</html>