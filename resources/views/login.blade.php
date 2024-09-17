<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('{{ asset('images/background.jpg') }}');
                background-repeat: no-repeat;
                background-position: center center;
                background-attachment: fixed;
                background-size: cover;
                font-family: 'Poppins', sans-serif;
        }

        .container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            background-color: #FDDAA0;
        }

        .form-control {
            border-radius: 0.5rem;
            padding: 1rem;
            font-size: 1rem;
        }

        .btn-primary {
            background: #e74832;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: #F87563 ;
        }

        .card-title {
            font-weight: bold;
            color: #CF434E;
            margin-bottom: 2rem;
        }

        .form-group label {
            font-weight: 500;
            color: #666;
        }

        .form-text {
            font-size: 0.85rem;
            color: #999;
        }

        .form-footer {
            margin-top: 1.5rem;
            text-align: center;
        }

        .form-footer a {
            color: #e74832;
            text-decoration: none;
            font-weight: 500;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 class="card-title text-center">Login</h2>
        <form>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <div class="form-footer">
                <p>Don't have an account? <a href="register">Register</a></p>
                <p><a href="#">Forgot your password?</a></p>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
