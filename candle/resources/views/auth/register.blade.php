<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
        }

        form {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 14px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background-color: #f9f9f9;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .error {
            color: #e63946;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        hr {
            border: 0;
            height: 1px;
            background: #e0e0e0;
            margin: 20px 0;
        }

        a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
            text-align: center;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<form method="POST" action="/register">
    @csrf
    <div>
        <label for="first_name">First Name</label>
        <input name="first_name" id="first_name" type="text" value="{{ old('first_name') }}" required>
        @error('first_name')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <hr>
    <div>
        <label for="last_name">Last Name</label>
        <input name="last_name" id="last_name" type="text" value="{{ old('last_name') }}" required>
        @error('last_name')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <hr>
    <div>
        <label for="email">Email</label>
        <input name="email" id="email" type="email" value="{{ old('email') }}" required>
        @error('email')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <hr>
    <div>
        <label for="password">Password</label>
        <input name="password" id="password" type="password" required>
        @error('password')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <hr>
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input name="password_confirmation" id="password_confirmation" type="password" required>
    </div>
    <div>
        <button type="submit">Register</button>
        <hr>
        <a href="/login">Already have an account?</a>
    </div>
    <a href="/">Cancel</a>
</form>
</body>
</html>
