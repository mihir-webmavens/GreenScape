<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenScape Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://s3.ap-south-1.amazonaws.com/awsimages.imagesbazaar.com/900x600/19137/220-SM899786.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>GreenScape Login</h2>
        @session('status')
            <div class="alert alert-success">  {{session('status')}}</div>
      @endsession
        <form action="{{ route('loginProcess') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <span>Forgot Password (Send Token on Mail) <a href="{{route('password.request')}}">click here</a></span>
            </div>
            <button type="submit" class="btn btn-success btn-block">Login</button>
        </form>
        <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
    </div>
</body>
</html>
