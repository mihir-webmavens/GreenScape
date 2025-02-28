
<form action="{{ route('password.email') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Enter your email">
    @error('email')
        <div class="text-danger" >{{ $message }}</div>

    @enderror
    <button type="submit">Send Reset Link</button>
</form>
<style>
    form {
        max-width: 400px;
        margin: 0 auto;
        padding: 1em;
        background: #f9f9f9;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    input[type="email"] {
        width: 100%;
        padding: 0.5em;
        margin-bottom: 1em;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    button {
        width: 100%;
        padding: 0.7em;
        background-color: #28a745;
        border: none;
        border-radius: 3px;
        color: white;
        font-size: 1em;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
    }
</style>
