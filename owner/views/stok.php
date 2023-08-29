<?php 

  require "../controllers/StokController.php";

  $produk = getAllProduk();
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Toko Devi</title>
    <!-- Bootstap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <!-- fonts -->
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />
    <!-- style css & bootstrap -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style_umum.css" />
    <link rel="stylesheet" href="../css/style_stok.css" />
  </head>
  <body class="bg-abu">
    <nav class="navbar navbar-expand-lg navbar-dark-emphasis bg-white shadow fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Devi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <div class="row me-4">
                <a class="nav-link click-oren fw-semibold p-2 px-3" aria-current="page" href="home.php"><i class="bi bi-house-door-fill"></i> Home</a>
              </div>
            </li>
            <li class="nav-item">
              <div class="row me-4">
                <a class="nav-link click-oren fw-semibold p-2 px-3 aktif" aria-current="page" href="#"><i class="bi bi-bag-check-fill"></i> Stok</a>
              </div>
            </li>
            <li class="nav-item">
              <div class="row me-4">
                <a class="nav-link click-oren fw-semibold p-2 px-3" aria-current="page" href="analisis.php"><i class="bi bi-bar-chart-line-fill"></i> Analisis Penjualan</a>
              </div>
            </li>
            <li class="nav-item">
              <div class="row me-4">
                <a class="nav-link click-oren fw-semibold p-2 px-3" aria-current="page" href="history.php"><i class="bi bi-stopwatch-fill"></i> History</a>
              </div>
            </li>
            <li class="nav-item">
              <div class="row">
                <a class="nav-link click-oren fw-semibold p-2 px-3" aria-current="page" href="akun.php"><i class="bi bi-person-circle"></i> Akun</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- content -->
    <div id="anonimous" class="mt-2">`</div>
    <div class="container my-5 bg-white rounded-5 p-5 pt-3 shadow">
      <h2 id="judul-laporan" class="text-center mt-3 fw-semibold text-hitamAbu fs-2 text-shadow ">Stok Produk</h2>
      <div class="text-end">
        <button id="btn-cetak" class="btn text-white fw-semibold mb-2" onclick="cetak()" style="background-color: rgb(226, 135, 67);"><i class="bi bi-printer"></i> Cetak Laporan Stok</button>
      </div>
      <table id="stok-table" class="table table-striped shadow-sm table-bordered print-table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Prduk</th>
            <th>Kategori</th>
            <th>Jumlah Stok</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i = 0;$i < count($produk);$i++): ?>
            <tr>
              <td><?= $i+1 ?></td>
              <td><?= ucwords($produk[$i]["nama"]); ?></td>
              <td><?= ucwords($produk[$i]["kategori"]); ?></td>
              <td><?= ucwords($produk[$i]["stok"]); ?> <?= ucwords($produk[$i]["satuan"]); ?></td>
          </tr>
          <?php endfor; ?>
        </tbody>
      </table>
    </div>

    <script>
      function cetak() {
        window.print();
      }
    </script>


    <!-- jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
      $(document).ready(function () {
        $("#stok-table").DataTable({
          paging: true,
          language: {
            sEmptyTable: "Tidak ada data yang tersedia pada tabel ini",
            sInfo: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            sInfoEmpty: "Menampilkan 0 - 0 dari 0 data",
            sInfoFiltered: "(disaring dari _MAX_ total data)",
            sInfoPostFix: "",
            sInfoThousands: ",",
            sLengthMenu: "Tampilkan _MENU_ data",
            sLoadingRecords: "Memuat...",
            sProcessing: "Sedang diproses...",
            sSearch: "Cari:",
            sZeroRecords: "Tidak ditemukan data yang sesuai",
            oPaginate: {
              sFirst: "Pertama",
              sLast: "Terakhir",
              sNext: "Berikutnya",
              sPrevious: "Sebelumnya",
            },
            oAria: {
              sSortAscending: ": diurutkan secara menaik",
              sSortDescending: ": diurutkan secara menurun",
            },
          },
        });
      });
    </script>
    <script src="../../assets/bootstrap/js/bootstrap.js"></script>
    <script src="../js/script_umum.js"></script>
    <script src="../js/script_stok.js"></script>
  </body>
</html>


<?php 
  

 ?>


