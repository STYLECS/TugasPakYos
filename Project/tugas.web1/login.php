<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SPP Digital</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body class="login-page">
  <div class="login-container">
    <h2>Login Akun</h2>

    <form id="loginForm" method="POST">
      <div class="form-group">
        <label for="username">Nama Pengguna</label>
        <input type="text" id="username" name="username" placeholder="Masukkan username" required>
      </div>

      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
      </div>

      <button type="submit">Masuk</button>
    </form>
  </div>

  <script src="script.js"></script>
</body>
</html>
