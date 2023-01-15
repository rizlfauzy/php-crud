<?php
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
}
require_once "config.php";
$id = $_GET["id"];
$result = $mysqli->query("SELECT*FROM calon_mahasiswa WHERE id = $id");
$calon = $result->fetch_object();


function edit($data)
{
  global $mysqli;
  $id = $data["id"];
	$nisn = htmlspecialchars($data["nisn"]);
	$nama= htmlspecialchars($data["nama"]);
	$univ1 = htmlspecialchars($data["univ1"]);
	$univ2 = htmlspecialchars($data["univ2"]);

  $mysqli->query("UPDATE calon_mahasiswa SET
  nisn = '$nisn',
  nama = '$nama',
  univ1 = '$univ1',
  univ2 = '$univ2'
  WHERE id = $id
  ");

  return $mysqli->affected_rows;
}

if ( isset($_POST["edit"])) {
	//cek apakah data berhasil diubah atau tidak
    if ( edit($_POST) > 0) {
      echo "
        <script>
          alert('data berhasil diubah!!');
          document.location.href = 'index.php';
        </script>
      ";
    }else{
      echo "
        <script>
          alert('data gagal diubah!');
          document.location.href = 'index.php';
        </script>
      ";
    }

}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Edit</title>
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
          <h3>Halaman Edit</h3>
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
                  <input type="hidden" name="id" value="<?= $calon->id ; ?>">
                  <label for="nisn" class="form-label">NISN :</label>
                </div>
                <div class="col-3">
                  <input type="text" class="form-control" id="nisn" name="nisn"
                  value="<?= $calon->nisn ?>">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <div class="row d-flex justify-content-center">
                <div class="col-1">
                  <label for="nama" class="form-label">Nama :</label>
                </div>
                <div class="col-3">
                  <input type="text" class="form-control" id="nama" name="nama" value="<?= $calon->nama ?>">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <div class="row d-flex justify-content-center">
                <div class="col-1">
                  <label for="univ1" class="form-label">Nama Universitas 1 :</label>
                </div>
                <div class="col-3">
                  <input type="text" class="form-control" id="univ1" name="univ1" value="<?= $calon->univ1 ?>">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <div class="row d-flex justify-content-center">
                <div class="col-1">
                  <label for="univ2" class="form-label">Nama Universitas 2 :</label>
                </div>
                <div class="col-3">
                  <input type="text" class="form-control" id="univ2" name="univ2" value="<?= $calon->univ2 ?>">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <div class="row">
                <div class="text-center">
                  <button type="submit" name="edit" class="btn btn-primary">Edit Item</button>
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