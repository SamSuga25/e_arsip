<?php  
	session_start();
	if ($_SESSION['user'] == "") {
		header("Location: index.php");
	}
	include_once 'connection.php';

	$date = date_create($_POST['d8']);
	
	$jenis = $_POST['jenis_s8'];
	$nama1 = $_POST['nsj'];
	$tmpt1 = $_POST['tetl8'];
	$date1 = date_format($date, 'd-m-Y');
	$kewa1 = $_POST['kew8'];
	$jkel1 = $_POST['jke9'];
	$agam1 = $_POST['agama8'];
	$peker = $_POST['pkj6'];
	$stpe1 = $_POST['sp9'];
	$temp1 = $_POST['tempa8'];
	$altuj = $_POST['altu0'];
	$bermu = $_POST['bemu0'];
	$ttd = $_POST['ttdsj'];
	
	$sql = "INSERT INTO data_surat_umum(no, jenis, nama, kewar, jk, agama, pekerjaan, st_pe, tempat, altuj, bermu, ttl, ttd_jabat, ket) VALUES ( '', '" . $jenis . "', '" . $nama1 . "', '" . $kewa1 . "', '" . $jkel1 . "', '" . $agam1 . "', '" . $peker . "', '" . $stpe1 . "', '" . $temp1 . "', '" . $altuj . "', '" . $bermu . "', '" . $tmpt1 . ", " . $date1 . "', '" . $ttd . "', '" . date('Y-m-d') . "')";
	
	if ($conn->query($sql) === TRUE) {
		echo "Data Sudah Dimasukkan";
		header("Location:data_umum.php");
	}
	else{
		echo "Gagal";
		header("Location:data_umum.php");
	}
?>