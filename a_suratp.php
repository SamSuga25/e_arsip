<?php
	session_start();
	if ($_SESSION['user'] == "") {
		header("Location: index.php");
	}
	include_once 'connection.php';

	$jenis = $_POST['jenis_sp'];
	$dake = $_POST['namaket'];
	$laci = $_POST['lacip'];
	$guide = $_POST['jenisP'];
	$nik = $_POST['nik'];
	$np = $_POST['namePeg'];

	$sql = "SELECT * FROM penduduk WHERE nik = '" . $nik . "' AND nama = '" . $dake . "'";

	$sql0 = "SELECT * FROM arsip_surat WHERE nik = '" . $nik . "' AND dari_kpd = '" . $dake . "' AND perihal = '" . $laci . " " . $guide . "'";

	$sql1 = "INSERT INTO arsip_surat(jenis, no_surat, nik, dari_kpd, tanggal_input, perihal, laci, guide, nama_pe, admin) VALUES ('" . $jenis . "', '', '" . $nik . "','" . $dake . "', NOW(), '" . $laci . " " . $guide . "', '" . $laci . "', '" . $guide . "', '" . $np . "', '" . $_SESSION['user'] . "')";

	if ($conn->query($sql)->num_rows == 1) {
		if ($conn->query($sql0)->num_rows == 0) {
			if ($conn->query($sql1) === TRUE) {
				echo "Data Sudah Dimasukkan";
				header("Location:p_data_surat.php");
			}
			else{
				echo "Gagal!";
			}
		}
		else{
			echo "Maaf anda sudah Terdaftar";
		}
	}
	else{
		echo "Tidak Terdaftar dalam Penduduk";
	}
?>