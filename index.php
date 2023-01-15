<?php
session_start();
require_once "config.php";

//cek apakah ada session login
if (!isset($_SESSION['login'])) {
  header('Location: login.php');
  exit;
}

$result = $mysqli->query("SELECT * FROM calon_mahasiswa ORDER BY nama ASC");

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Home</title>
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
            <a href="./logout.php" class="btn btn-primary">logout</a>
          </form>
        </div>
      </div>
    </nav>

    <div class="container">
      <h3 class="mt-5 mb-3">Halaman Home</h3>
      <div class="row">
        <div class="col">
          <a href="add.php" class="btn btn-primary">Add Item</a>
        </div>
      </div>
      <table class="table table-bordered mt-5">
        <thead>
          <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama</th>
            <th>Nama Univ 1</th>
            <th>Nama Univ 2</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; while($row = $result->fetch_object()) : ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $row->nisn; ?></td>
              <td><?= $row->nama; ?></td>
              <td><?= $row->univ1; ?></td>
              <td><?= $row->univ2; ?></td>
              <td><a href=<?= "edit.php?id=$row->id" ?> >Edit</a> |
                  <a href=<?= "delete.php?id=$row->id" ?> onclick="return confirm('Apakah anda yakin ?')"  >Hapus</a></td>
            </tr>
            <?php ++$i; ?>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>