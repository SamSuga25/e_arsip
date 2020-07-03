<?php
  error_reporting(0);
  session_start();
  if ($_SESSION['nip'] == "") {
    header("Location: index.php");
  }
  include_once 'connection.php';

  $jenis = $_POST['jenis'];
  
  $sql = "SELECT * FROM data_surat_umum ORDER BY ket";

  $search = $_POST['search'];

  if ($search != "") {
    $sql = "SELECT * FROM data_surat_umum WHERE jenis LIKE '%" . $search . "%' OR nama LIKE '%" . $search . "%' OR jk LIKE '%" . $search . "%' OR ttl LIKE '%" . $search . "%' OR kewar LIKE '%" . $search . "%' OR jk LIKE '%" . $search . "%' OR agama LIKE '%" . $search . "%' OR pekerjaan LIKE '%" . $search . "%' OR st_pe LIKE '%" . $search . "%' OR tempat LIKE '%" . $search . "%' OR ket LIKE '%" . $search . "%'";
  }

  $result = $conn->query($sql);
  
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Sides - Data Surat</title>
  <link rel="icon" href="assets/img/office-material.svg">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/infinite.css">
</head>
<body style="background-color: #0079a7;">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="assets/img/office-material.svg" width="40" height="30" alt="">
        E-Sides
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Buku Register
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="data_masuk_pe.php">Register Masuk</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="data_umum_pe.php">Register Umum</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="data_kelahiran_pe.php">Register Kelahiran</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="data_kematian_pe.php">Register Kematian</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="data_pindah_tempat_pe.php">Register Pindah Tempat</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Hello, <?=$_SESSION['nip']?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="about_pe.php">About</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php">Log Out</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Container -->
    <div class="container-fluid">
       <div class="row">
        <div class="col-sm-12">
          <div class="judul m-3">Register Umum</div>
        </div>
        <div class="col-sm-12 px-5">
          <div class="card mb-5">
            <div class="card-body">
              <div class="float-left mb-3">
                <form class="form-inline" method="POST" action="data_umum_pe.php">
                  <div class="form-group mr-sm-3 mb-2">
                    <input type="text" class="form-control" name="search" placeholder="Search....">
                  </div>
                  <button type="submit" class="btn btn-outline-primary mb-2">Search</button>
                </form>
              </div>
              <div class="table-responsive"  style="height: 400px;">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Nomor</th>
                      <th scope="col">Nomor Registrasi</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Tempat, Tanggal Lahir</th>
                      <th scope="col">Kewarnegaraan</th>
                      <th scope="col">Jenis Kelamin</th>
                      <th scope="col">Agama</th>
                      <th scope="col">Pekerjaan</th>
                      <th scope="col">Status Perkawinan</th>
                      <th scope="col">Tempat Tinggal</th>
                      <th scope="col">Keperluan</th>
                      <th scope="col">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                          <td>
                            <?=$row['no']?>
                          </td>
                          <td>
                            <?php
                               $array_bln  = array("01"=>"I", "02"=>"II", "03"=>"III", "04"=>"IV", "05"=>"V", "06"=>"VI", "07"=>"VII", "08"=>"VIII", "09"=>"IX", "10"=>"X", "11"=>"XI", "12"=>"XII");
                              $bln    = $array_bln[date('m', strtotime($row['ket']))];
                              
                              $a = $row['jenis'];
                              if ($a == "Beda Identitas" || $a == "Keterangan Usaha" || $a == "SKTM" || $a == "SKTM Beasiswa") {
                                echo '470 / ' . $row['no'] . ' / 35.07.20.007 / ' . $bln . "/ " . date('Y', strtotime($row['ket']));
                              }
                              elseif ($a == "Keterangan Usaha" || $a == "Surat Kerja") {
                                echo '471 / ' . $row['no'] . ' / 35.07.20.007 / ' . $bln . "/ " . date('Y', strtotime($row['ket']));
                              }
                              elseif ($a == "Domisili Lembaga" || $a == "Domisili Pribadi" || $a == "Belum Menikah" || $a == "Laporan Kehilangan" || $a == "Surat jalan") {
                                echo '474 / ' . $row['no'] . ' / 35.07.20.007 / ' . $bln . "/ " . date('Y', strtotime($row['ket']));
                              }
                              else{
                                echo $row['no_reg'];
                              }
                            ?>
                          </td>
                          <td>
                            <?= $row['nama'] ?>
                          </td>
                          <td>
                            <?= $row['ttl'] ?>
                          </td>
                          <td>
                            <?= $row['kewar'] ?>
                          </td>
                          <td>
                            <?= $row['jk'] ?>
                          </td>
                          <td>
                            <?= $row['agama'] ?>
                          </td>
                          <td>
                            <?= $row['pekerjaan'] ?>
                          </td>
                          <td>
                            <?= $row['st_pe'] ?>
                          </td>
                          <td>
                            <?php
                              if ($row['jenis'] == "Keterangan Usaha") {
                                 echo "RT " . $row['rt'] . " RW " . $row['rw'] . " Desa " . $row['desa'] . " Dusun " . $row['dusun'];
                               } 
                               else{
                                  echo $row['tempat'] ;
                               }
                            ?>
                          </td>
                          <td>
                            <?=$row['jenis'] ?>
                          </td>
                          <td>
                            <?php
                              $date = date_create($row['ket']);
                              echo date_format($date, 'd-m-Y');
                            ?>
                          </td>
                        </tr>
                      <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- JavaScript -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>