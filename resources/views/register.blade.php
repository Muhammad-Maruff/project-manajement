<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
            background-color: #FDDAA0 !important;
            height: 570px;
            width: 500px;
        }

        .form-control {
            border-radius: 0.5rem;
            padding: 1rem;
            font-size: 1rem;
        }

        .btn-primary {
            background: #e74832 !important;
            border: #e74832 !important;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: #F87563 !important;
        }

        .card-title {
            font-weight: bold;
            color: #CF434E;
            margin-bottom: 2rem;
            font-size: 30px;
        }

        .form-group label {
            font-weight: 500;
            color: #666;
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
            color: #e74832 !important;
        }

        .custom-swal-popup {
            background-color: #FDDAA0 !important; /* Warna merah */
            color: white !important; /* Warna teks menjadi putih */
        }

        .custom-swal-confirm-button {
            background-color: #e74832 !important; /* Warna latar belakang tombol konfirmasi */
            border:#e74832 !important; /* Hapus border default tombol konfirmasi */
            border-radius: 0.5rem !important; /* Radius sudut tombol konfirmasi */
            padding: 0.75rem 1.5rem !important; /* Padding tombol konfirmasi */
         }

        .custom-swal-confirm-button:hover {
            background-color: #e87565 !important; /* Warna latar belakang tombol saat hover */
            color: #ffffff !important; /* Warna teks tombol saat hover */
            border: #e74832 !important;
        }
    </style>
    
</head>

<body>

<div class="container">
    <div class="card">
        <h2 class="card-title text-center">Register</h2>
        <form action="register" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password">
            </div>
            <button type="submit" class="btn btn-primary btn-block">REGISTER</button>
            <div class="form-footer">
                <p>Have an account? <a href="login">Login</a></p>
            </div>
        </form>
    </div>
</div>

<!-- Popper.js, Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                showConfirmButton: true,
                customClass: {
                 popup: 'custom-swal-popup',
                 confirmButton: 'custom-swal-confirm-button', 
              },
            });
        @endif

        // Success Notification using SweetAlert2
        @if (session('status'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
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
