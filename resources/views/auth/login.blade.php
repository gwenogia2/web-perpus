<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            margin: 0;
        }

        .login-container {
            height: 100vh;
        }

        .login-left {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
        }

        .login-box {
            width: 300px;
        }

        .login-right {
            background: url('https://jurnalposmedia.com/wp-content/uploads/2022/07/2612498771.jpg') no-repeat center;
            background-size: cover;
        }

        .btn-login {
            background-color: #0d6efd;
            color: white;
        }

        .btn-login:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>

<body>

<div class="container-fluid login-container">
    <div class="row h-100">

        <!-- LEFT -->
        <div class="col-md-4 login-left">
            <div class="login-box">

                <h4 class="mb-4">Login</h4>

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div> 
                @endif

                <form method="POST" action="/login">
                    @csrf

                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <button class="btn btn-login w-100 mb-3">LOGIN</button>
                </form>

            </div>
        </div>

        <!-- RIGHT -->
        <div class="col-md-8 login-right d-none d-md-block"></div>

    </div>
</div>

</body>
</html>