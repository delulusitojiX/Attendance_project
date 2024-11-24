<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- FontAwesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="hold-transition login-page" style="height: 100vh; display: flex; align-items: center; justify-content: center; background: #ecf0f5;">

<div class="login-box">
  <div class="login-logo text-center mb-4">
    <img src="{{ asset('img/logo.png') }}" alt="Avatar" class="img-fluid mb-4">
  </div>

  <div class="login-box-body card p-4">
    <p class="login-box-msg text-center mb-4">Sign in to start your session</p>

    <form id="loginForm" action="{{ route('admin.login') }}" method="POST">
      @csrf
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" id="username" placeholder="Input Username" required autofocus>
        <span class="fas fa-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" id="password" placeholder="Input Password" required>
        <span class="fas fa-lock form-control-feedback"></span>
      </div>

      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <div class="row">
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fas fa-sign-in-alt"></i> Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
