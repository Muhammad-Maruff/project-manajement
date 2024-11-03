<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <!-- Font Awesome -->
     <link rel="stylesheet" href=" {{asset('AdminLTE-3/plugins/fontawesome-free/css/all.min.css')}}">
     <!-- SweetAlert2 -->
     <link rel="stylesheet" href=" {{asset('AdminLTE-3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
     <!-- Toastr -->
     <link rel="stylesheet" href=" {{asset('AdminLTE-3/plugins/toastr/toastr.min.css')}}">
     <!-- Theme style -->
     <link rel="stylesheet" href=" {{asset('AdminLTE-3/dist/css/adminlte.min.css')}}">
     <link rel="stylesheet" href="{{ asset('css/style.css') }}">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="body-image">
    <div class="container">
     <div class="card card-login">
        <h2 class="card-title text-center">Login</h2>
        <form action="login" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
            <div class="form-footer">
                <p>Don't have an account? <a href="register">Register</a></p>
                <p><a href="forgot-password">Forgot your password?</a></p>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- jQuery -->
<script src="{{asset('AdminLTE-3/plugins/jquery/jquery.min.js')}} "></script>
<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE-3/plugins/bootstrap/js/bootstrap.bundle.min.js')}} "></script>
<!-- SweetAlert2 -->
<script src="{{asset('AdminLTE-3/plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<!-- Toastr -->
<script src="{{asset('AdminLTE-3/plugins/toastr/toastr.min.js')}} "></script>

<script>
    $(document).ready(function() {
        // SweetAlert2 Notification based on errors or success

        // Error Notification using SweetAlert2
        @if (session('status'))
        Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('message') }}',
                showConfirmButton: true,
                customClass: {
                 popup: 'custom-swal-popup',
                 confirmButton: 'custom-swal-confirm-button', 
              },
            });
        @endif
    });
</script>
</body>
</html>
