<?php
	session_start();
	include_once 'connection.php';

	$nip = $_POST['nip'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$jabatan = $_POST['jabatan'];

	$sql0 = "SELECT * FROM pegawai WHERE nip = " . $nip;

	$sql1 = "INSERT INTO pegawai VALUES ('" . $nama . "', '" . $alamat . "','" . $nip . "', '" . $jabatan . "')";

	if ($conn->query($sql0)->num_rows == 0) {
		if ($conn->query($sql1) === TRUE) {
			echo "Data Sudah Dimasukkan";
			header("Location:data_pegawai.php");
		}
		else{
			echo "Gagal!";
		}
	}
	else{
		echo "Maaf anda sudah Terdaftar";
	}
?>