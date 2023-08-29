<?php 
   session_start();
   if(!isset($_SESSION["loginAdmin"])){
     header("Location: login.php");
     exit;
   }
  require_once "../utility/functionsUtil.php";
  require "../controllers/HistoryController.php";
  $produkKeluarByRange = getProdukKeluarByRange(getTanggalToday(), getTanggalToday());
  $produkMasukByRange = getProdukMasukByRange(getTanggalToday(), getTanggalToday());
  $totalPenjualan = getTotalPenjualanByRange(getTanggalToday(), getTanggalToday());
  $totalProdukMasuk = getTotalProdukMasukByRange(getTanggalToday(), getTanggalToday());
  $tanggalAwal = getTanggalToday();
  $tanggalAkhir = getTanggalToday();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />
    <!-- style css & bootstrap -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style_umum.css" />
    <link rel="stylesheet" href="../css/style_history.css" />
    <!-- Bootstap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
  </head>
  <body class="bg-abu">
    <nav class="navbar navbar-expand-lg navbar-dark-emphasis bg-white shadow fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Devi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <div class="row me-4">
                <a class="nav-link click-oren fw-semibold p-2 px-3" aria-current="page" href="home.php"><i class="bi bi-house-door-fill"></i> Home</a>
              </div>
            </li>
            <li class="nav-item">
              <div class="row me-4">
                <a class="nav-link click-oren fw-semibold p-2 px-3" aria-current="page" href="produk.php"><i class="bi bi-bag-check-fill"></i> Produk</a>
              </div>
            </li>
            <li class="nav-item">
              <div class="row me-4">
                <a class="nav-link click-oren fw-semibold p-2 px-3 aktif" aria-current="page" href="#"><i class="bi bi-stopwatch-fill"></i> History</a>
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
    <!-- content -->
    <div id="content" class="mx-5 pt-5">
      <div class="container my-5 bg-white rounded-5 p-5 pt-3 shadow">
        <header class="mt-3">
          <h2 class="text-center mb-3 fw-semibold text-hitamAbu fs-2 text-shadow"><i class="bi bi-clock-history"></i> History Penjualan</h2>
        </header>
        <?php 
        // ketika tanggal di pilih
        if(isset($_POST["submit-date-form"])){
          if($_POST["tanggal-awal"]>$_POST["tanggal-akhir"]){
            echo alertFailed('"Tanggal Akhir Harus Lebih Kecil Dari Tanggal Awal"');
          } else{
            $tanggalAwal = $_POST['tanggal-awal'];
            $tanggalAkhir = $_POST['tanggal-akhir'];
            // untuk produk masuk
            $totalPenjualan = getTotalPenjualanByRange($tanggalAwal, $tanggalAkhir);
            $produkKeluarByRange = getProdukKeluarByRange($tanggalAwal, $tanggalAkhir);
            // untuk produk keluar
            $totalProdukMasuk = getTotalProdukMasukByRange($tanggalAwal, $tanggalAkhir);
            $produkMasukByRange = getProdukMasukByRange($tanggalAwal, $tanggalAkhir);
          }
          $_POST = [];
        } 
        ?>
        <p class="text-center fw-semibold">Pilih tanggal :</p>
        <form class="mb-3" id="date-form" action="" method="POST">
          <label for="tanggal-awal">Tanggal Awal:</label>
          <input type="date" value="<?=$tanggalAwal?>" max="<?=getTanggalToday()?>" id="tanggal-awal" name="tanggal-awal" class="inputTanggal" lang="id-ID" name="start-date" />
          <label class="ms-2" for="tanggal-akhir" class="inputTanggal">Tanggal Akhir:</label>
          <input type="date" value="<?=$tanggalAkhir?>" max="<?=getTanggalToday()?>" id="tanggal-akhir" name="tanggal-akhir" />
          <button class="ms-2 bg-white rounded-1 border-dark-subtle fs-09 px-2" name="submit-date-form" type="submit">Filter</button>
        </form>
        <div class="con-filter-history d-flex gap-3 pt-3">
          <button class="produk-keluar-btn filter-history click-oren fw-semibold borderOren"><i class="bi bi-arrow-down-square"></i> Produk Keluar</button>
          <button  class="produk-masuk-btn filter-history click-oren fw-semibold borderGray"><i class="bi bi-arrow-up-square"></i> Produk Masuk</button>
        </div>
        <!-- History Produk Keluar -->
        <div id="history-produk-keluar">
          <div class="total-penjualan my-2">
            <h5 class="fw-semibold text-dark-emphasis"> Total Penjualan</h5>
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <div class="judul-total-buah card-header bg-success fw-semibold text-white"><i class="bi bi-apple"></i> Total Buah Terjual</div>
                  <div class="card-body">
                    <span id="total-buah"><?=formatNumber($totalPenjualan["totalBuahKg"])?> Kg <?php if($totalPenjualan["totalBuahBiji"] != 0) {echo "& ".formatNumber($totalPenjualan["totalBuahBiji"]). " Biji";}if($totalPenjualan["totalBuahPcs"] != 0) {echo "& ".formatNumber($totalPenjualan["totalBuahPcs"]). " Pcs";}?> </span>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="judul-total-fr card-header bg-primary fw-semibold text-white"><i class="bi bi-basket2-fill"></i> Total Frozen Food Terjual</div>
                  <div class="card-body">
                    <span id="total-frozen-food"><?=formatNumber($totalPenjualan["totalFrozenFoodPcs"])?> Pcs <?php if($totalPenjualan["totalFrozenFoodBiji"] != 0) {echo "& ".formatNumber($totalPenjualan["totalFrozenFoodBiji"]). " Biji";}if($totalPenjualan["totalFrozenFoodKg"] != 0) {echo "& ".formatNumber($totalPenjualan["totalFrozenFoodKg"]). " Kg";}?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="judul-total-harga card-header bg-oren fw-semibold text-white"><i class="bi bi-database-add"></i> Total Pendapatan</div>
                  <div class="card-body">
                    <span id="total-harga">Rp<?=formatNumber($totalPenjualan["totalHargaPenjualan"])?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <table id="table-history-produk-keluar" class="table table-striped shadow-sm table-bordered">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Harga Terjual</th>
                <th>Admin</th>
                <th width="10px"></th>
              </tr>
            </thead>
            <tbody>
              <?php  for($i=count($produkKeluarByRange)-1; $i>=0; $i--) :?>
                <tr>
                  <td><?= convertTanggaldmy($produkKeluarByRange[$i]["tanggal_keluar"])?></td>
                  <td><?= ucwords($produkKeluarByRange[$i]["nama_produk"]) ?></td>
                  <td><?= ucwords($produkKeluarByRange[$i]["kategori"])?></td>
                  <td><?= formatNumber($produkKeluarByRange[$i]["jumlah"])?> <?=ucwords($produkKeluarByRange[$i]["satuan"])?></td>
                  <td>Rp<?= formatNumber($produkKeluarByRange[$i]["harga_terjual"])?></td>
                  <td><?= ucwords($produkKeluarByRange[$i]["username_admin"])?></td>
                  <td><button type='button' class='btn border btn-success p-0 px-2 m-0' data-bs-toggle='modal' data-bs-target='#detail<?=$produkKeluarByRange[$i]["id"]?>'><i class="bi bi-info-circle"></i></button> </td>
                </tr>
                <!-- Modal Details -->
                <div class="modal fade" id="detail<?=$produkKeluarByRange[$i]["id"]?>" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel">Produk Terjual</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-6 gambar-produk" style="background-image:url('../../assets/img/<?=$produkKeluarByRange[$i]["gambar_produk"]?>');"></div>
                          <div class="col-md-6">
                            <h2><?=ucwords($produkKeluarByRange[$i]["nama_produk"])?></h2>
                            <p><strong>Kategori: </strong><?=ucwords($produkKeluarByRange[$i]["kategori"])?></p>
                            <p><strong>Harga Terjual: </strong>Rp<?=formatNumber($produkKeluarByRange[$i]["harga_terjual"])?></p>
                            <p><strong>Jumlah Terjual: </strong><?=formatNumber($produkKeluarByRange[$i]["jumlah"])?> <?=ucwords($produkKeluarByRange[$i]["satuan"])?></p>
                            <p><strong>Admin: </strong><?=ucwords($produkKeluarByRange[$i]["username_admin"])?></p>
                            <p><strong>Catatan: </strong><?=ifEmptyStrip($produkKeluarByRange[$i]["catatan"])?></p>
                            <p><strong>Tanggal: </strong><?=convertDateFormatted($produkKeluarByRange[$i]["tanggal_keluar"])?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endfor; ?>
            </tbody>
          </table>
        </div>
        <!-- History Produk Masuk -->
        <div id="history-produk-masuk">
          <div class="total-penjualan my-2">
            <h5 class="fw-semibold text-dark-emphasis"> Total Produk Masuk</h5>
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <div class="judul-total-buah card-header bg-success fw-semibold text-white"><i class="bi bi-apple"></i> Total Buah Masuk</div>
                  <div class="card-body">
                    <span id="total-buah"><?=formatNumber($totalProdukMasuk["totalBuahKg"])?> Kg <?php if($totalProdukMasuk["totalBuahBiji"] != 0) {echo "& ".$totalProdukMasuk["totalBuahBiji"]. " Biji";}if($totalProdukMasuk["totalBuahPcs"] != 0) {echo "& ".$totalProdukMasuk["totalBuahPcs"]. " Pcs";}?> </span>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="judul-total-fr card-header bg-primary fw-semibold text-white"><i class="bi bi-basket2-fill"></i> Total Frozen Food Masuk</div>
                  <div class="card-body">
                    <span id="total-frozen-food"><?=formatNumber($totalProdukMasuk["totalFrozenFoodPcs"])?> Pcs <?php if($totalProdukMasuk["totalFrozenFoodBiji"] != 0) {echo "& ".$totalProdukMasuk["totalFrozenFoodBiji"]. " Biji";}if($totalProdukMasuk["totalFrozenFoodKg"] != 0) {echo "& ".$totalProdukMasuk["totalFrozenFoodKg"]. " Kg";}?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="judul-total-modal card-header bg-oren fw-semibold text-white"><i class="bi bi-database-add"></i> Total Modal Pembelian</div>
                  <div class="card-body">
                    <span id="total-modal">Rp<?=formatNumber($totalProdukMasuk["totalHargaBeli"])?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <table id="table-history-produk-masuk" class="table table-striped shadow-sm table-bordered">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Harga Beli</th>
                <th>Admin</th>
                <th width="10px"></th>
              </tr>
            </thead>
            <tbody>
              <?php  for($i=count($produkMasukByRange)-1; $i>=0; $i--) :?>
                <tr>
                  <td><?= convertTanggaldmy($produkMasukByRange[$i]["tanggal_masuk"])?></td>
                  <td><?= ucwords($produkMasukByRange[$i]["nama_produk"]) ?></td>
                  <td><?= ucwords($produkMasukByRange[$i]["kategori"])?></td>
                  <td><?= formatNumber($produkMasukByRange[$i]["jumlah"])?> <?=ucwords($produkMasukByRange[$i]["satuan"])?></td>
                  <td>Rp<?= formatNumber($produkMasukByRange[$i]["harga_beli"])?></td>
                  <td><?= ucwords($produkMasukByRange[$i]["username_admin"])?></td>
                  <td><button type='button' class='btn border btn-success p-0 px-2 m-0' data-bs-toggle='modal' data-bs-target='#detail<?=$produkMasukByRange[$i]["id"]?>'><i class="bi bi-info-circle"></i></button> </td>
                </tr>
                <!-- Modal Details -->
                <div class="modal fade" id="detail<?=$produkMasukByRange[$i]["id"]?>" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel">Produk Masuk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-6 gambar-produk" style="background-image:url('../../assets/img/<?=$produkMasukByRange[$i]["gambar_produk"]?>');"></div>
                          <div class="col-md-6">
                            <h2><?=ucwords($produkMasukByRange[$i]["nama_produk"])?></h2>
                            <p><strong>Kategori: </strong><?=ucwords($produkMasukByRange[$i]["kategori"])?></p>
                            <p><strong>Harga Beli: </strong>Rp<?=formatNumber($produkMasukByRange[$i]["harga_beli"])?></p>
                            <p><strong>Jumlah: </strong><?=formatNumber($produkMasukByRange[$i]["jumlah"])?> <?=ucwords($produkMasukByRange[$i]["satuan"])?></p>
                            <p><strong>Admin: </strong><?=ucwords($produkMasukByRange[$i]["username_admin"])?></p>
                            <p><strong>Catatan: </strong><?=ifEmptyStrip($produkMasukByRange[$i]["catatan"])?></p>
                            <p><strong>Tanggal: </strong><?=convertDateFormatted($produkMasukByRange[$i]["tanggal_masuk"])?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endfor; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
      $(document).ready(function () {
        // Inisialisasi DataTables
        $("#table-history-produk-keluar").DataTable({
          paging: true,
          language: {
            // Konfigurasi bahasa
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
          "order": [[ 0, "desc" ]],
        });
        // Inisialisasi DataTables
        $("#table-history-produk-masuk").DataTable({
          paging: true,
          language: {
            // Konfigurasi bahasa
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
          "order": [[ 0, "desc" ]],
        });
      });
    </script>
    <script src="../../assets/bootstrap/js/bootstrap.js"></script>
    <script src="../js/script_umum.js?<?php echo time(); ?>"></script>
    <script src="../js/script_history.js?<?php echo time(); ?>"></script>
  </body>
</html>
