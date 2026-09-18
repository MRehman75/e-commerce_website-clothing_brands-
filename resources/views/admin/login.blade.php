<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>

<h2>Admin Login</h2>

@if ($errors->any())
    <div style="color:red">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('admin.login.store') }}">
    @csrf

    <div>
        <label>Email</label>
        <input type="email" name="email" required>
    </div>

    <br>

    <div>
        <label>Password</label>
        <input type="password" name="password" required>
    </div>

    <br>

    <button type="submit">Login</button>
</form>

</body>
</html>