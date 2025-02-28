<form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <input type="email" name="email" placeholder="Enter your email" required>

    <input type="password" name="password" placeholder="Enter your new password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm your new password" required>

    <button type="submit">Reset Password</button>
</form>
<style>
    form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
    }
</style>
