<?php
require_once "config.php";
// $result = $mysqli->query("SELECT nama,email FROM user WHERE
// 		nama = 'Rizal Fauzi' or email = 'rizalfauzi774@gmail.com'");
// print_r($result->fetch_assoc());exit;
function registrasi($data){
	global $mysqli;
	$nama = strtolower(stripslashes($data["nama"]));
	$email = htmlspecialchars($data["email"]);
	$password = $mysqli->real_escape_string($data["password"]);
	$confPass = $mysqli->real_escape_string($data["confPass"]);

	//cek username udah ada atau belum
  $result = $mysqli->query("SELECT nama,email FROM user WHERE
		nama = '$nama' or email = '$email'");

	if($result->fetch_assoc()){
		echo "
		<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      Nama dan Password sudah ada
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
		";
		return false;
	}

	//cek konfirmasi pasword
	if($password !== $confPass){
		echo "
		<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      Konfirmasi Password tidak sesuai
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
		";
		return false;
	}
	//enkripsi password dulu

	$password = password_hash($password, PASSWORD_DEFAULT);

	//tambahkan userbaru ke database
  $mysqli->query("INSERT INTO user (nama,email,password) VALUES('$nama','$email','$password')");

	return $mysqli->affected_rows;
}

if(isset($_POST["register"])){
	if(registrasi($_POST) > 0){
		echo "
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
        User baru berhasil dibuat
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
		";
	}else{
		echo $mysqli->error;
	}
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Registrasi</title>
</head>

<body>

  <div class="container">
    <div class="row mt-5 text-center">
      <div class="col">
        <h3>Halaman Registrasi</h3>
      </div>
    </div>
    <div class="row  mt-5">
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
                <label for="confPass" class="form-label">Konfirmasi Password :</label>
              </div>
              <div class="col-3">
                <input type="password" class="form-control" name="confPass" id="confPass"
                  placeholder="Masukkan Ulang Password">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="seePassConf"
                    onclick="showPass(confPass)">
                  <label class="form-check-label" for="seePassConf">
                    Show Password
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col text-center mb-2">
                <a href="login.php" class="btn btn-primary">Back</a>
              </div>
              <div class="text-center">
                <button type="submit" name="register" class="btn btn-primary">Register</button>
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


