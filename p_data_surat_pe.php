<?php
  error_reporting(0);
  session_start();
  if ($_SESSION['nip'] == "") {
    header("Location: index.php");
  }
  include_once 'connection.php';

  $jenis = $_POST['jenis'];

  if ($jenis == "Surat Masuk") {
    $sql = "SELECT * FROM arsip_surat WHERE jenis = '" . $jenis . "' ORDER BY tanggal_input";
  }
  elseif ($jenis == "Surat Keluar") {
    $sql = "SELECT * FROM arsip_surat WHERE jenis = '" . $jenis . "' ORDER BY tanggal_input";
  }
  else{
    $sql = "SELECT * FROM arsip_surat ORDER BY tanggal_input";
  }

  $search = $_POST['search'];

  if ($search != "") {
    $sql = "SELECT * FROM arsip_surat WHERE jenis LIKE '%" . $search . "%' OR no_surat LIKE '%" . $search . "%' OR dari_kpd LIKE '%" . $search . "%' OR tanggal_surat LIKE '%" . $search . "%' OR tanggal_input LIKE '%" . $search . "%' OR perihal LIKE '%" . $search . "%' OR alamat LIKE '%" . $search . "%' OR laci LIKE '%" . $search . "%' OR guide LIKE '%" . $search . "%'";
  }

  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Sides - Data Penduduk</title>
  <link rel="icon" href="assets/img/office-material.svg">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/infinite.css">
</head>
<body style="background-color: #3B3B3B;">

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
              Data
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="p_data_surat_pe.php">Data Surat</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="data_penduduk_pe.php">Data Penduduk</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data_char_pe.php">Statistik Surat</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Hello, <?=$_SESSION['nip']?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">About</a>
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
          <div class="judul m-3">Data Surat</div>
        </div>
        <div class="col-sm-12 px-5">
          <div class="card">
            <div class="card-body">
              <div class="float-right mb-3">
                <form action="p_data_surat.php" method="POST" class="form-inline">
                <select name="jenis" class="form-group mx-sm-3 mb-2">
                  <option value="Semua">Semua</option>
                  <option value="Surat Masuk">Surat Masuk</option>
                  <option value="Surat Keluar">Surat Keluar</option>
                </select>
                <input type="submit" class="btn btn-primary mb-2" value="Sort">
                </form>
              </div>
              <div class="float-left mb-3">
                <form class="form-inline" method="POST" action="p_data_surat.php">
                  <div class="form-group mr-sm-3 mb-2">
                    <input type="text" class="form-control" name="search" placeholder="Search....">
                  </div>
                  <button type="submit" class="btn btn-outline-primary mb-2">Search</button>
                </form>
              </div>
              <div class="table-responsive-lg">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Nomor</th>
                      <th scope="col">Jenis</th>
                      <th scope="col">Dari / Kepada</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Nomor Surat</th>
                      <th scope="col">Tanggal Surat</th>
                      <th scope="col">Perihal</th>
                      <th scope="col">Laci</th>
                      <th scope="col">Guide</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                          <td>
                            <?=$row['no_surat']?>
                          </td>
                          <td>
                            <?= $row['jenis'] ?>
                          </td>
                          <td>
                            <?= $row['dari_kpd'] ?>
                          </td>
                          <td>
                            <?= $row['alamat'] ?>
                          </td>
                          <td>
                            <?php  
                              if ($row['jenis'] == "Surat Keluar") {
                               echo "470 / " . $row['no_surat'] . " / 35.07.23.2203 / " . date('Y', strtotime($row['tanggal_input']));
                              }
                              elseif ($row['jenis'] == "Surat Masuk"){
                                echo $row['r_no_su'];
                              }
                            ?>
                          </td>
                          <td>
                            <?php
                              if ($row['jenis'] == "Surat Masuk") {
                                $a = date('d/m/Y', strtotime($row['tanggal_surat']));
                                echo $a;
                              }
                              else{
                                $a = date('d/m/Y', strtotime($row['tanggal_input']));
                                echo $a;
                              }
                            ?>
                          </td>
                          <td>
                            <?= $row['perihal'] ?>
                          </td>
                          <td>
                            <?= $row['laci'] ?>
                          </td>
                          <td>
                            <?= $row['guide'] ?>
                          </td>
                        </tr>
                      <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="float-right">
                <a href="data_cetak_surat.php" class="btn btn-dark d-flex justify-content-center"><i class="material-icons md-light mr-1">print</i>Print</a>
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