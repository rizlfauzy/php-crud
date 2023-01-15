<?php


$mysqli = new mysqli("localhost", "rizal", "1234", "input_calon_mahasiswa");

//mengecek apakah error atau tidak
if ($mysqli->connect_errno) {
  echo "Failed to Connect : " . $mysqli->connect_error;
}

?>