<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Live Score Dashboard Signup</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
    <div class="register-box">
        <div class="login-logo">
            Live Score Dashboard
        </div>

        <div class="card">
          <div class="card-body register-card-body">
            <h2 class="login-box-msg">Login</h2>
            @if($errors->any())
                <div>
                    @foreach ($errors->all() as $error)
                        <div class="btn btn-block btn-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('login.post') }}" method="post">
                @csrf
              <div class="input-group mb-3 mt-2">
                <input type="email" class="form-control" placeholder="Email" name="email">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>

              <div class="row">
                  <button type="submit" class="btn btn-primary btn-block mb-3">Login</button>
                <!-- /.col -->
              </div>
            </form>
            <a href="/register" class="text-center">Register</a>
          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
      </div>
      <!-- /.register-box -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
</body>
</html>
