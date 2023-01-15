<?php
session_start();

require_once 'config.php';


if(!isset($_SESSION["login"])){
	header("Location: login.php");
}

function hapus($id){
	global $mysqli;
	$query = "DELETE FROM calon_mahasiswa WHERE id = $id";
	$mysqli->query($query);
	return $mysqli->affected_rows;
}


$id = $_GET["id"];

if (hapus ($id) > 0){
	echo "
	<script>
		alert('data berhasil dihapus!!');
		document.location.href = 'index.php'
	</script>
	";

}else{
	echo "
	<script>
		alert('data gagal dihapus!!');
		document.location.href = 'index.php'
	</script>
	";
}

 ?>