<?php  
  session_start();
  include_once 'connection.php';

  $search = $_POST['search'];

  if ($search == "") {
    $sql = "SELECT * FROM pegawai";
  }
  else{
    $sql = "SELECT * FROM pegawai WHERE nip LIKE '%" . $search . "%' OR nama LIKE '%" . $search . "%' OR alamat LIKE '%" . $search . "%' OR jabatan LIKE '%" . $search . "%'";
  }

  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Surat</title>
  <link rel="icon" href="assets/img/office-material.svg">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/infinite.css">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="assets/img/office-material.svg" width="40" height="30" alt="">
        E-Arsip
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="pilih_surat.php">Tambah Surat</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Data
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="p_data_surat.php">Data Surat</a>
              <a class="dropdown-item" href="data_pegawai.php">Data Pegawai</a>
              <a class="dropdown-item" href="data_penduduk.php">Data Penduduk</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Hello, <?=$_SESSION['user']?>
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
    <div class="container-fluid bckgrnd">
       <div class="row">
        <div class="col-sm-12">
          <div class="judul m-3">Data Pegawai</div>
        </div>
        <div class="col-sm-12 px-5">
          <div class="card">
            <div class="card-body">
              <div class="float-left mb-3">
                <form class="form-inline" method="POST" action="data_pegawai.php">
                  <div class="form-group mr-sm-3 mb-2">
                    <input type="text" class="form-control" name="search" placeholder="Search....">
                  </div>
                  <button type="submit" class="btn btn-outline-primary mb-2">Search</button>
                </form>
              </div>
              <div class="float-right">
                <a href="data_add_pegawai.php" class="btn btn-primary">Tambah</a>
              </div>
              <div class="table-responsive-lg">
                <table class="table text-center">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">NIP</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Jabatan</th>
                      <th scope="col">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                          <td>
                            <?= $row['nip'] ?>
                          </td>
                          <td>
                            <?= $row['nama'] ?>
                          </td>
                          <td>
                            <?= $row['alamat'] ?>
                          </td>
                          <td>
                            <?= $row['jabatan'] ?>
                          </td>
                          <td>
                            <a href="#">
                                <img src="assets/img/writing.svg" height="25" width="25">
                            </a>
                            <a href="data_delete_action_p.php?nip=<?=$row['nip']?>">
                              <img src="assets/img/clear-button.svg" height="25" width="25">
                            </a>
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