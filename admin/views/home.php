<?php 
  session_start();
  if(!isset($_SESSION["loginAdmin"])){
    header("Location: login.php");
    exit;
  }
  $no=1;
  require "../controllers/HomeController.php";
  require_once "../utility/functionsUtil.php";
  $products = getAllProduk();
  $allProdukKeluar = getAllProdukKeluar();
  $produkKeluarToday = getProdukKeluarToday();
  $produkMasukToday = getProdukMasukToday();
  $pendapatanToday = getPendapatanToday();
  $jumlahProdukKeluar = count(getProdukKeluarToday());
  $jumlahProdukMasuk = count(getProdukMasukToday());
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Toko Devi</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style_umum.css" />
    <link rel="stylesheet" href="../css/style_home.css" />
    <!-- Bootstap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />
  </head>
  <body class="bg-abu">
    <!-- navigasi -->
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
                <a class="nav-link click-oren fw-semibold p-2 px-3 aktif" aria-current="page" href="#"><i class="bi bi-house-door-fill"></i> Home</a>
              </div>
            </li>
            <li class="nav-item">
              <div class="row me-4">
                <a class="nav-link click-oren fw-semibold p-2 px-3" aria-current="page" href="produk.php"><i class="bi bi-bag-check-fill"></i> Produk</a>
              </div>
            </li>
            <li class="nav-item">
              <div class="row me-4">
                <a class="nav-link click-oren fw-semibold p-2 px-3" aria-current="page" href="history.php"><i class="bi bi-stopwatch-fill"></i> History</a>
              </div>
            </li>
            <li class="nav-item">
              <div class="row me-4">
                <a class="nav-link click-oren fw-semibold p-2 px-3" aria-current="page" href="manajementAkun.php"><i class="bi bi-person-square"></i> Manajement Akun</a>
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
    <div class="mt-5">.</div>
    <!-- Modal Produk Keluar -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 fw-bolder" id="staticBackdropLabel">Produk Keluar</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-start">
            <form action="" method="POST">
              <div class="mb-3">
                <label for="nama-produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                <select class="form-select" id="nama-produk-pk" name="idProduk" required>
                  <option value="">Pilih Produk</option>
                  <?php for($i=0; $i<count($products); $i++) : ?>
                    <option value="<?=$products[$i]['id']?>" data-satuan="<?=$products[$i]['satuan']?>" data-harga="<?=$products[$i]['harga']?>"><?= ucwords($products[$i]["nama"])?></option>
                  <?php endfor; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="number" class="form-control jumlah-pk" id="jumlah" name="jumlah" placeholder="masukkan dalam satuan kg/biji" required min="0" step="1" />
                  <input type="text" class="form-control" id="satuan-pk" name="satuan-pm" placeholder="kg/biji" disabled/>
                </div>
              </div>
              <div class="mb-3">
                <label for="harga-terjual" class="form-label">Harga Terjual <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="harga-terjual" name="harga-terjual" min="0" value="0" step="0.01" required />
              </div>
              <div class="mb-3">
                <label for="tanggal-keluar" class="form-label">Tanggal Keluar <span class="text-danger">*</span></label>
                <input type="date" class="form-control tanggal" name="tanggal-keluar"  required/>
              </div>
              <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea class="form-control" id="catatan" name="catatan" placeholder="(jika ada)" rows="3"></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary" name="submit-barang-keluar">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div id="barang-keluar-success-alert" class="alert alert-success rounded-5 position-fixed top-50 start-50 translate-middle z-3 px-5 py-3 d-none" role="alert">
      Sukses Menambahkan Produk Keluar!
    </div>
    <div id="add-produk-stokMinus-alert" class="alert alert-danger rounded-5 position-fixed top-50 start-50 translate-middle z-3 px-5 py-3 d-none" role="alert">
      Gagal!, "Stok tidak mencukupi"
    </div>
    <?php 
    if(isset($_POST["submit-barang-keluar"])){
      $isSuccess = addProdukKeluar($_POST);
      $_POST = [];
      if($isSuccess == 'stokMinus'){
        echo alertFailed('Gagal!, "Stok tidak mencukupi"');
      } elseif($isSuccess){
        echo alertSuccess("Sukses Menambahkan Produk Keluar");
        $products = getAllProduk();
        $produkKeluarToday = getProdukKeluarToday();
        $pendapatanToday = getPendapatanToday();
        $jumlahProdukKeluar = count(getProdukKeluarToday());
        $jumlahProdukMasuk = count(getProdukMasukToday());
      }
    } 
    ?>
    <!-- content -->
    <div id="content" class="mx-5 mt-2">
      <div class="con-utama rounded-5 p-3 shadow-lg mb-3">
        <!-- top-statistik -->
        <section id="top-statistik m-0 p-0">
          <p class="m-0 p-0"><?=getTodayFormatted()?></p>
          <div class="container-fluid mt-2 text-dark-emphasis">
            <div class="row gap-4">
              <div class="con-child-top bg-white rounded-5 p-3 shadow-sm text-center">
                <i style="padding-block: 5px; padding-inline: 7px" class="rounded-circle bg-warning bi bi-coin text-white fs-2"></i>
                <h6 class="fw-semibold ps-2 mb-0 mt-2">Pendapatan</h6>
                <p class="fs-3 m-0 fw-semibold">Rp<?=formatNumber($pendapatanToday)?></p>
              </div>
              <div class="con-child-top bg-white rounded-5 p-3 shadow-sm text-center">
                <i style="padding-block: 5px; padding-inline: 7px" class="rounded-circle bg-danger bi bi-cart-check-fill text-white fs-2"></i>
                <h6 class="fw-bolder ps-2 mb-0 mt-2">Produk Keluar</h6>
                <p class="fs-3 m-0 fw-semibold"><?=$jumlahProdukKeluar?></p>
              </div>
              <div class="con-child-top bg-white rounded-5 p-3 shadow-sm text-center">
                <i style="padding-block: 5px; padding-inline: 7px" class="rounded-circle bg-primary bi bi-cart-plus-fill text-white fs-2"></i>
                <h6 class="fw-bolder ps-2 mb-0 mt-2">Produk Masuk</h6>
                <p class="fs-3 m-0 fw-semibold"><?=$jumlahProdukMasuk?></p>
              </div>
            </div>
          </div>
        </section>
        <!-- mid-table -->
        <h1 class="text-dark-emphasis fs-4 fw-bolder mt-4">Stok Produk</h1>
        <section class="con-mid-table text-center text-dark-emphasis">
          <div class="container-fluid bg-white rounded-5 p-4">
            <button type="button" class="btn btn-primary bg-biruMuda fw-bolder" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-arrow-down-square"></i> Kurangi Stok</button>
            <table id="sales-table" class="table table-striped text-start">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Kategori</th>
                  <th>Stok</th>
                </tr>
              </thead>
              <tbody>
              <?php  for($i=count($products)-1; $i>=0; $i--) :?>
              <tr>
                <td><?= $no ?></td>
                <td><?= ucwords($products[$i]["nama"]) ?></td>
                <td><?= ucwords($products[$i]["kategori"]) ?></td>
                <td><?= formatNumber($products[$i]["stok"])?> <?= ucwords($products[$i]["satuan"]) ?></td>
              </tr>
              <?php $no++ ?>
            <?php endfor; ?>
              </tbody>
            </table>
          </div>
        </section>
      </div>
      <div id="sidebar" class="position-fixed end-0 bottom-0 p-3 pt-4 overflow-auto">
        <div class="con-side rounded-2 mt-5 p-2 py-3 shadow-lg">
          <h1 class="text-dark-emphasis fs-4 fw-bolder ps-2">Produk Terjual Hari Ini</h1>
          <table class="table-side table-striped table table-hover rounded-2 p-3 shadow-sm text-center">
            <thead>
              <tr>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Harga</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            <?php  for($i=count($produkKeluarToday)-1; $i>=0; $i--) :?>
              <tr>
                <td><?= ucwords($produkKeluarToday[$i]["nama_produk"]) ?></td>
                <td><?= formatNumber($produkKeluarToday[$i]["jumlah"])?> <?=ucwords($produkKeluarToday[$i]["satuan"])?></td>
                <td><?= formatNumber( $produkKeluarToday[$i]["harga_terjual"]) ?></td>
                  <td><button type='button' class='btn border-0  p-0 m-0' data-bs-toggle='modal' data-bs-target='#<?=$produkKeluarToday[$i]["id"]?>'> <a href="#" class="text-decoration-none">Details</a></button></td>
              </tr>
              <?php $no++ ?>
            <?php endfor; ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php  for($i=count($produkKeluarToday)-1; $i>=0; $i--) :?>
      <!-- Modal Details -->
      <div class="modal fade" id="<?=$produkKeluarToday[$i]["id"]?>" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="productModalLabel">Produk Terjual</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6 gambar-produk" style="background-image:url('../../assets/img/<?=$produkKeluarToday[$i]["gambar"]?>');"></div>
                <div class="col-md-6">
                  <h2><?=ucwords($produkKeluarToday[$i]["nama_produk"])?></h2>
                  <p><strong>Kategori: </strong><?=ucwords($produkKeluarToday[$i]["kategori"])?></p>
                  <p><strong>Harga Terjual: </strong>Rp<?=formatNumber($produkKeluarToday[$i]["harga_terjual"])?></p>
                  <p><strong>Jumlah Terjual: </strong><?=formatNumber($produkKeluarToday[$i]["jumlah"])?> <?=ucwords($produkKeluarToday[$i]["satuan"])?></p>
                  <p><strong>Admin: </strong><?=ucwords($produkKeluarToday[$i]["username_admin"])?></p>
                  <p><strong>Catatan: </strong><?=ifEmptyStrip($produkKeluarToday[$i]["catatan"])?></p>
                  <p><strong>Tanggal: </strong><?=convertDateFormatted($produkKeluarToday[$i]["tanggal_keluar"])?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php $no++ ?>
      <?php endfor; ?>
    </div>
    <!-- jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
      $(document).ready(function () {
        $("#sales-table").DataTable({
          paging: true,
          lengthChange: false, // Menghilangkan dropdown untuk mengubah jumlah tampilan data
          pageLength: 5, // Menentukan jumlah data yang ditampilkan per halaman
          responsive: true, // aktifkan fitur responsif
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
    <script src="../js/script_umum.js?<?php echo time(); ?>"></script>
    <script src="../js/script_home.js?<?php echo time(); ?>"></script>
  </body>
</html>
