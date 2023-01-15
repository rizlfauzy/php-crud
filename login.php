<?php
session_start();
require_once 'config.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

  $result = $mysqli->query("SELECT email FROM user WHERE id = $id");
  $row = $result->fetch_object();

  if($key === hash('sha256', $row->email)){
		$_SESSION['login'] = true;
	}
}

//cek apakah sudah login
if (isset($_SESSION['login'])) {
  header('Location: index.php');
  exit;
}
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  // print_r(sha1($password . 'howAreYou'));exit;

  $result = $mysqli->query("SELECT * FROM user WHERE email = '$email' ");
  if ($result->num_rows === 1) {
    $row = $result->fetch_object();
    if (password_verify($password, $row->password)) {
      //set session
      $_SESSION['login'] = true;

      //cek remember me
      if (isset($_POST['remember'])) {

        //buat cookie
        setcookie('id',$row->id,time()+3600*24);
        setcookie('key',hash('sha256', $row->email) ,time()+3600*24);
      }

      header("Location: index.php");
      exit;
    }

  }
  $error = true;
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/style.css">
  <title>Login</title>
</head>

<body>
  <?php if (isset($error)) : ?>

      <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Email / Password salah
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>

    <?php endif; ?>
  <div class="container">
    <div class="row mt-5 text-center">
      <div class="col">
        <h3>Halaman Login</h3>
      </div>
    </div>
    <div class="row mt-5 logo-wrapping">
      <img class="logo-login" src="https://rekreartive.com/wp-content/uploads/2018/10/Logo-Unindra-Universitas-Indraprasta-PGRI-Hitam-Putih-PNG.png">
    </div>
    <div class="row mt-5">
      <div class="col">
        <form action="" method="post">
          <div class="mb-3">
            <div class="row d-flex justify-content-center">
              <div class="col-1">
                <label for="nama" class="form-label">Nama :</label>
              </div>
              <div class="col-3">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row  d-flex justify-content-center">
              <div class="col-1">
                <label for="email" class="form-label">Email :</label>
              </div>
              <div class="col-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email"
                  autocomplete="off">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row d-flex justify-content-center">
              <div class="col-1">
                <label for="password" class="form-label">Password :</label>
              </div>
              <div class="col-3">
                <input type="password" class="form-control" name="password" id="password"
                  placeholder="Masukkan Password">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="seePass" onclick="showPass(pass)">
                  <label class="form-check-label" for="seePass">
                    Show Password
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row d-flex justify-content-center">
              <div class="col-1">
                <label for="remember" class="form-check-label">Remember Me :</label>
              </div>
              <div class="col-3">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="text-center mb-2">
                <button type="submit" name="login" class="btn btn-primary">SIGN IN</button>
              </div>
              <div class="text-center">
                <a href="registrasi.php" class="link link-primary text-decoration-none">Belum Punya Akun ?</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <script src="./js/script.js"></script>
</body>

</html>