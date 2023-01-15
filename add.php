<?php
session_start();
require_once "config.php";

//cek apakah ada session login
if (!isset($_SESSION['login'])) {
  header('Location: login.php');
  exit;
}
function tambah($data)  {
  try {
    global $mysqli;
    //ambil data dari query
    $nama = htmlspecialchars($data["nama"]);
    $nisn = htmlspecialchars($data["nisn"]);
    $univ1 = htmlspecialchars($data["univ1"]);
    $univ2 = htmlspecialchars($data["univ2"]);

    // query select nisn
    $query_1 = "SELECT nisn FROM calon_mahasiswa WHERE nisn = '$nisn'";
    $result = $mysqli->query($query_1);
    $row = $result->fetch_assoc();
    if ($row) {
      echo "
			<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Data NISN sudah ada!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
		";
      throw new Exception("Nisn sudah terdaftar", 1);
    }

    //query insert data
    $query_2 = "INSERT INTO calon_mahasiswa (nisn,nama,univ1,univ2) VALUES ('$nisn','$nama','$univ1','$univ2')";

    $mysqli->query($query_2);

    return $mysqli->affected_rows;
  } catch (Exception $e) {
    return 0;
  }
}
if (isset($_POST['add'])) {
  if (tambah($_POST) > 0) {
    echo "
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
        Data baru berhasil dibuat
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
		";
	}else{
		echo $mysqli->error;
	}
}
// print_r(tambah());exit;

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Add</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">Interview</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
          </ul>
          <form class="d-flex">
            <a href="logout.php" class="btn btn-primary">logout</a>
          </form>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="row mt-5 mb-3 text-center">
        <div class="col">
          <h3>Halaman Tambah</h3>
        </div>
      </div>
      <div class="row">
        <div class="col text-center">
          <a href="index.php" class="btn btn-primary">Go to Home</a>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col">
          <form action="" method="post">
            <div class="mb-3">
              <div class="row d-flex justify-content-center">
                <div class="col-1">
                  <label for="nisn" class="form-label">NISN :</label>
                </div>
                <div class="col-3">
                  <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NISN Lengkap">
                </div>
              </div>
            </div>
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
              <div class="row d-flex justify-content-center">
                <div class="col-1">
                  <label for="univ1" class="form-label">Nama Universitas 1 :</label>
                </div>
                <div class="col-3">
                  <input type="text" class="form-control" id="univ1" name="univ1" placeholder="Mohon diisi">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <div class="row d-flex justify-content-center">
                <div class="col-1">
                  <label for="univ2" class="form-label">Nama Universitas 2 :</label>
                </div>
                <div class="col-3">
                  <input type="text" class="form-control" id="univ2" name="univ2" placeholder="Mohon diisi">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <div class="row">
                <div class="text-center">
                  <button type="submit" name="add" class="btn btn-primary">Add Item</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
