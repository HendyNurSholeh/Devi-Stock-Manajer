<?php 
  require_once "../utility/functionsUtil.php";
  require "../controllers/AnalisisController.php";
  session_start();
  if(!isset($_SESSION["loginOwner"])){
    header("Location: ../../admin/views/login.php");
    exit;
  }
  $tanggalAwal = date("Y-m-d", strtotime("-15 days", strtotime(getTanggalToday())));
  $tanggalAkhir = getTanggalToday();
  $totalPenjualan = getTotalPenjualanByRange($tanggalAwal, $tanggalAkhir);
  $produkTerlaris = getProdukTerlarisByRange($tanggalAwal, $tanggalAkhir);
  $jumlahProdukTerlaris = count($produkTerlaris);
  $produkPalingMenguntungkan = getProdukPalingMenguntungkanByRange($tanggalAwal, $tanggalAkhir);
  $jumlahProdukMenguntungkan = count($produkPalingMenguntungkan);
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style_umum.css" />
    <link rel="stylesheet" href="../css/style_analisis.css" />
    <!-- Bootstap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <!-- google cart api -->
    <script src="https://www.gstatic.com/charts/loader.js"></script>
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
                <a class="nav-link click-oren fw-semibold p-2 px-3" aria-current="page" href="home.php"><i class="bi bi-house-door-fill"></i> Home</a>
              </div>
            </li>
            <li class="nav-item">
              <div class="row me-4">
                <a class="nav-link click-oren fw-semibold p-2 px-3" aria-current="page" href="stok.php"><i class="bi bi-bag-check-fill"></i> Stok</a>
              </div>
            </li>
            <li class="nav-item">
              <div class="row me-4">
                <a class="nav-link click-oren fw-semibold p-2 px-3 aktif" aria-current="page" href="#"><i class="bi bi-bar-chart-line-fill"></i> Analisis Penjualan</a>
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
    <div id="content" class="mx-5">
      <div class="mt-3">-</div>
      <div class="mt-5 con-utama rounded-5 p-3">
        <header class="mt-3 mb-3">
          <h2 class="text-center mb-2 fw-semibold text-hitamAbu fs-2 text-shadow">Analisis Penjualan</h2>
        </header>
        <?php 
        // ketika tanggal di pilih
        if(isset($_POST["submitDate"])){
          if($_POST["tanggal-awal"]>$_POST["tanggal-akhir"]){
            echo alertFailed('"Tanggal Akhir Harus Lebih Kecil Dari Tanggal Awal"');
          } else{
            $tanggalAwal = $_POST['tanggal-awal'];
            $tanggalAkhir = $_POST['tanggal-akhir'];
            $totalPenjualan = getTotalPenjualanByRange($tanggalAwal, $tanggalAkhir);
            $produkTerlaris = getProdukTerlarisByRange($tanggalAwal, $tanggalAkhir);
            $jumlahProdukTerlaris = count($produkTerlaris);
            $produkPalingMenguntungkan = getProdukPalingMenguntungkanByRange($tanggalAwal, $tanggalAkhir);
          }
          $_POST = [];
        } 
        ?>
        <p class="text-center fw-semibold">Pilih tanggal :</p>
        <form id="date-form" action="" method="post">
          <label for="tanggal-awal">Tanggal Awal:</label>
          <input type="date" value="<?=$tanggalAwal?>" max="<?=getTanggalToday()?>" id="tanggal-awal" name="tanggal-awal" />
          <label class="ms-2" for="tanggal-akhir">Tanggal Akhir:</label>
          <input type="date" id="tanggal-akhir" value="<?=$tanggalAkhir?>" max="<?=getTanggalToday()?>" name="tanggal-akhir" />
          <button class="ms-2 bg-white rounded-1 border-dark-subtle fs-09 px-2" name="submitDate" type="submit">Filter</button>
        </form>
        <!-- top-statistik -->
        <section id="top-statistik m-0">
          <div class="container-fluid mt-2 text-dark-emphasis">
            <div class="row gap-4">
              <div class="col bg-white rounded-5 p-3 pe-0 shadow-sm">
                <h6 class="fw-semibold ps-2">Pendapatan</h6>
                <div class="d-flex px-2">
                  <div class="align-self-center pe-3">
                    <i style="padding-block: 5px; padding-inline: 7px;" class="rounded-circle bg-warning bi bi-coin text-white fs-4"></i>
                  </div>
                  <div>
                    <p class="fs-4 m-0 fw-semibold">Rp<?= formatNumber($totalPenjualan["totalPendapatan"])?></p>
                  </div>
                </div>
              </div>
              <div class="col bg-white rounded-5 p-3 shadow-sm">
                <h6 class="fw-bolder ps-2">Frozen Food Terjual</h6>
                <div class="d-flex px-2">
                  <div class="align-self-center pe-3">
                    <i style="padding-block: 5px; padding-inline: 7px" class="rounded-circle bg-danger bi bi-cart-check-fill text-white fs-4"></i>
                  </div>
                  <div>
                    <p class="fs-4 m-0 fw-semibold"><?= formatNumber($totalPenjualan["totalFrozenFoodPcs"]) ?> pcs</p>
                  </div>
                </div>
              </div>
              <div class="col bg-white rounded-5 p-3 shadow-sm">
                <h6 class="fw-bolder ps-2">Buah Terjual</h6>
                <div class="d-flex px-2">
                  <div class="align-self-center pe-3">
                    <i style="padding-block: 5px; padding-inline: 7px" class="rounded-circle bg-success bi bi-apple text-white fs-4"></i>
                  </div>
                  <div>
                    <p class="fs-4 m-0 fw-semibold"><?= formatNumber($totalPenjualan["totalBuahKg"]) ?> kg</p>
                  </div>
                </div>
              </div>
              <div class="col bg-white rounded-5 p-3 shadow-sm">
                <h6 class="fw-bolder ps-2">Keuntungan</h6>
                <div class="d-flex px-2">
                  <div class="align-self-center pe-3">
                    <i style="padding-block: 5px; padding-inline: 7px" class="rounded-circle bg-primary bi bi-basket2-fill text-white fs-4"></i>
                  </div>
                  <div>
                    <p class="fs-4 m-0 fw-semibold">Rp<?= formatNumber($totalPenjualan["totalKeuntungan"]) ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- main-statistik -->
        <?php showStatistikPenjualan($tanggalAwal, $tanggalAkhir);?>
        <?php showStatistikKeuntunganKategori($tanggalAwal, $tanggalAkhir);?>
        <section class="main-statistik my-4 text-center text-dark-emphasis">
          <div class="container-fluid">
            <div class="row justify-content-between gap-1">
              <div class="con-st1 bg-white rounded-5 py-3 pb-2 shadow">
                <h6 class="fw-semibold ps-2 mb-1">Statistik Keuntungan Penjualan</h6>
                <div id="st-keuntungan-penjualan" style="height: 250px"></div>
              </div>
              <div class="con-st2 bg-white rounded-5 p-0 pt-3 bg-danger shadow">
                <h6 class="fw-semibold ps-2 mx-2">Total Keuntungan Berdasarkan Kategori</h6>
                <div id="st-total-keuntungan"></div>
              </div>
            </div>
          </div>
        </section>
        <!-- bootom statistik -->
        <section class="bottom-statistik mb-3 text-dark-emphasis">
        <div class="container-fluid">
          <div class="row gap-4">
            <!-- produk terlaris -->
            <div class="col bg-white rounded-5 px-4 pt-4 pb-2 shadow">
              <div class="row">
                <div class="col">
                  <h6 class="fw-bolder">Produk Terlaris</h6>
                </div>
                <div class="col">
                  <p class="text-end">
                    <button type="button" class="border-0 bg-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <a class="text-decoration-none fw-semibold text-warning">lihat semua <i class="bi bi-arrow-right-short"></i></a>
                    </button>
                  </p>
                  <!-- lihat semua -->
                </div>
              </div>
              <div class="row">
                <p class="text-secondary-emphasis fw-semibold mb-3">Produk</p>
              </div>
              <div class="row">
                <?php if($jumlahProdukTerlaris > 4) {$jumlahProdukTerlaris=4;}
                for($i=0; $i<$jumlahProdukTerlaris; $i++) : ?>
                  <div class="col-6">
                    <div class="row">
                      <div class="col-3">
                        <div class="border border-warning con-img p-2 w-100" style="height: 72%">
                          <div class="rounded-circle gambar-produk" style="background-image: url('../../assets/img/<?=$produkTerlaris[$i]["gambar"]?>'); height:100%; width:100%;";></div>
                        </div>
                      </div>
                      <div class="col p-0">
                        <h6 class="fs-6 fw-semibold mb-1"><?= ucwords($produkTerlaris[$i]["nama"]) ?></h6>
                        <p class="text-secondary-emphasis">Terjual : <span class="text-warning"><?=formatNumber($produkTerlaris[$i]["jumlahTerjual"])?> <?=$produkTerlaris[$i]["satuan"]?></span></p>
                      </div>
                    </div>
                  </div>
                <?php endfor; ?>
              </div>
            </div>
            <!-- ModaL Produk Buah Terlaris-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-scrollable ">
                <div class="modal-content bg-abu " >
                  <div class="modal-header py-1">
                    <h1 class="modal-title fs-5 fw-bolder" id="exampleModalLabel">Produk Terlaris</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body pt-0 px-2">
                    <div class="container" style="min-height: 80vh">
                      <div class="filter-kategori d-flex justify-content-between p-0 my-2">
                        <div class="conKategori d-flex gap-3">
                          <button class="kategori btn-semua semua click-oren fw-semibold p-0 px-3 fs-09 aktif border-0"><i class="bi bi-arrow-down-up text-danger"></i> Semua</button>
                          <button class="kategori btn-buah buah click-oren fw-semibold p-0 px-3 fs-09 text-secondary border-0"><i class="bi bi-apple text-success fs-5 m-0"></i> Buah</button>
                          <button class="kategori btn-frozen-food frozen-food click-oren fw-semibold p-0 px-3 fs-09 text-secondary border-0 borderGray"><i class="bi bi-basket2-fill text-primary fs-5 m-0"></i> Frozen Food</button>
                          <button class="kategori btn-lainnya lainnya click-oren fw-semibold p-0 px-3 fs-09 text-secondary border-0 borderGray"><i class="bi bi-apple text-danger fs-5 m-0"></i> Lainnya</button>
                        </div>
                          <p class="p-0 fs-small m-0 text-end align-self-end"><?= count($produkTerlaris) ?> Produk Hasil</p>
                      </div>
                      <div class="row">
                        <?php foreach($produkTerlaris as $product) : ?>
                          <div class="kartu kartuPt semua rounded-5 px-2">
                            <div class="border-0 rounded-5 bg-white d-relative">
                              <div class="text-center mb-0 d-flex justify-content-center">
                                <div class="mt-1 con-img rounded-circle d-flex justify-content-center align-items-center" style="height: 10em; width: 10em;">
                                  <div class="rounded-circle gambar-produk" style="background-image: url('../../assets/img/<?=$product["gambar"]?>'); height: 8em; width: 8em;" ></div>
                                </div>
                              </div>
                              <div class="text-center text-dark">
                                <h5 class="fw-bolder fs-6 m-0 lh-base"><?=ucwords($product["nama"])?></h5>
                                <p class="text-oren fs-5 m-0 fw-bolder text-warning"><?=$product["jumlahTerjual"]?> <?=$product["satuan"]?></p>
                                <p class="text-secondary fw-semibold fs-09 pb-2">terjual</p>
                              </div>
                            </div>
                          </div>
                          <?php if($product["kategori"] == "buah") : ?>
                            <div class="kartu kartuPt buah px-2 rounded-5 d-none">
                            <div class="border-0 rounded-5 bg-white d-relative">
                              <div class="text-center mb-0 d-flex justify-content-center">
                                <div class="mt-1 con-img rounded-circle d-flex justify-content-center align-items-center" style="height: 10em; width: 10em;">
                                  <div class="rounded-circle gambar-produk" style="background-image: url('../../assets/img/<?=$product["gambar"]?>'); height: 8em; width: 8em;" ></div>
                                </div>
                              </div>
                              <div class="text-center text-dark">
                                <h5 class="fw-bolder fs-6 m-0 lh-base"><?=ucwords($product["nama"])?></h5>
                                <p class="text-oren fs-5 m-0 fw-bolder text-warning"><?=$product["jumlahTerjual"]?> <?=$product["satuan"]?></p>
                                <p class="text-secondary fw-semibold fs-09 pb-2">terjual</p>
                              </div>
                            </div>
                          </div>
                          <?php endif ?>
                          <?php if($product["kategori"] == "frozen food") : ?>
                            <div class="kartu kartuPt frozen-food px-2 rounded-5 d-none">
                            <div class="border-0 rounded-5 d-relative bg-white">
                              <div class="text-center mb-0 d-flex justify-content-center">
                                <div class="mt-1 con-img rounded-circle d-flex justify-content-center align-items-center" style="height: 10em; width: 10em;">
                                  <div class="rounded-circle gambar-produk" style="background-image: url('../../assets/img/<?=$product["gambar"]?>'); height: 8em; width: 8em;" ></div>
                                </div>
                              </div>
                              <div class="text-center text-dark">
                                <h5 class="fw-bolder fs-6 m-0 lh-base"><?=ucwords($product["nama"])?></h5>
                                <p class="text-warning fs-5 m-0 fw-bolder"><?=$product["jumlahTerjual"]?> <?=$product["satuan"]?></p>
                                <p class="text-secondary fw-semibold fs-09 pb-2">terjual</p>
                              </div>
                            </div>
                          </div>
                          <?php endif ?>
                          <?php if($product["kategori"] == "lainnya") : ?>
                            <div class="kartu kartuPt lainnya px-2 rounded-5 d-none">
                            <div class="border-0 rounded-5 d-relative bg-white">
                              <div class="text-center mb-0 d-flex justify-content-center">
                                <div class="mt-1 con-img rounded-circle d-flex justify-content-center align-items-center" style="height: 10em; width: 10em;">
                                  <div class="rounded-circle gambar-produk" style="background-image: url('../../assets/img/<?=$product["gambar"]?>'); height: 8em; width: 8em;" ></div>
                                </div>
                              </div>
                              <div class="text-center text-dark">
                                <h5 class="fw-bolder fs-6 m-0 lh-base"><?=ucwords($product["nama"])?></h5>
                                <p class="text-warning fs-5 m-0 fw-bolder"><?=$product["jumlahTerjual"]?> <?=$product["satuan"]?></p>
                                <p class="text-secondary fw-semibold fs-09 pb-2">terjual</p>
                              </div>
                            </div>
                          </div>
                          <?php endif ?>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer py-0">
                    <button type="button" class="btn btn-secondary py-0 fs-09" data-bs-dismiss="modal">Keluar</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- produk terlaris -->
            <div class="col bg-white rounded-5 px-4 pt-4 pb-2 shadow">
              <div class="row">
                <div class="col-8">
                  <h6 class="fw-bolder">Produk Paling Menguntungkan</h6>
                </div>
                <div class="col">
                  <p class="text-end">
                    <button type="button" class="border-0 bg-white" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                      <a class="text-decoration-none fw-semibold text-warning">lihat semua <i class="bi bi-arrow-right-short"></i></a>
                    </button>
                  </p>
                  <!-- lihat semua -->
                </div>
              </div>
              <div class="row">
                <p class="text-secondary-emphasis fw-semibold mb-3">Produk</p>
              </div>
              <div class="row">
                <?php if($jumlahProdukMenguntungkan > 4) {$jumlahProdukMenguntungkan=4;}
                $counter = 0;
                foreach ($produkPalingMenguntungkan as $produk) :
                  if ($counter < $jumlahProdukMenguntungkan) :?>
                    <div class="col-6">
                      <div class="row">
                        <div class="col-3">
                          <div class="border border-warning con-img p-2 w-100" style="height: 72%">
                            <div class="rounded-circle gambar-produk" style="background-image: url('../../assets/img/<?=$produk["gambar"]?>'); height:100%; width:100%;";></div>
                          </div>
                        </div>
                        <div class="col p-0">
                          <h6 class="fs-6 fw-semibold mb-1"><?= ucwords($produk["nama"]) ?></h6>
                          <p class="text-secondary-emphasis fs-09">Keuntungan : <span class="text-warning">Rp<?=formatNumber($produk["keuntungan"])?></span></p>
                        </div>
                      </div>
                    </div>
                <?php 
                  $counter++; 
                  endif; 
                endforeach; ?>
              </div>
            </div>
            <!-- ModaL Produk Paling Menguntungkan-->
            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-scrollable ">
                <div class="modal-content bg-abu " >
                  <div class="modal-header py-1">
                    <h2 class="modal-title fs-5 fw-bolder" id="exampleModalLabel">Produk Paling Menguntungkan</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body pt-0 px-2">
                    <div class="container" style="min-height: 80vh">
                      <div class="filter-kategori d-flex justify-content-between p-0 my-2">
                        <div class="conKategoriPm d-flex gap-3">
                            <button class="kategoriPm btn-semuaPm click-oren fw-semibold p-0 px-3 fs-09 aktif border-0"><i class="bi bi-arrow-down-up text-danger"></i> Semua</button>
                            <button class="kategoriPm btn-buahPm click-oren fw-semibold p-0 px-3 fs-09 text-secondary border-0 borderGray"><i class="bi bi-apple text-success fs-5 m-0"></i> Buah</button>
                            <button class="kategoriPm btn-frozen-foodPm click-oren fw-semibold p-0 px-3 fs-09 text-secondary border-0 borderGray"><i class="bi bi-basket2-fill text-primary fs-5 m-0"></i> Frozen Food</button>
                            <button class="kategoriPm btn-lainnyaPm click-oren fw-semibold p-0 px-3 fs-09 text-secondary border-0 borderGray"><i class="bi bi-apple text-danger fs-5 m-0"></i> Lainnya</button>
                        </div>
                          <p class="p-0 fs-small m-0 text-end align-self-end"><?= count($produkPalingMenguntungkan) ?> Produk Hasil</p>
                      </div>
                      <div class="row">
                        <?php foreach($produkPalingMenguntungkan as $product) : ?>
                          <div class="kartu kartuPm semuaPm rounded-5 px-2">
                            <div class="border-0 rounded-5 bg-white d-relative">
                              <div class="text-center mb-0 d-flex justify-content-center">
                                <div class="mt-1 con-img rounded-circle d-flex justify-content-center align-items-center" style="height: 10em; width: 10em;">
                                  <div class="rounded-circle gambar-produk" style="background-image: url('../../assets/img/<?=$product["gambar"]?>'); height: 8em; width: 8em;" ></div>
                                </div>
                              </div>
                              <div class="text-center text-dark">
                                <h5 class="fw-bolder fs-6 m-0 lh-base"><?=ucwords($product["nama"])?></h5>
                                <p class="text-oren fs-5 m-0 fw-bolder text-warning">Rp<?=formatNumber($product["keuntungan"])?></p>
                                <p class="fw-semibold fs-09 pb-2"><i class="text-warning bi bi-coin"></i> <span class="text-secondary">keuntungan</span></p>
                              </div>
                            </div>
                          </div>
                          <?php if($product["kategori"] == "buah") : ?>
                            <div class="kartu kartuPm buahPm rounded-5 d-none px-2">
                            <div class="border-0 rounded-5 d-relative bg-white">
                              <div class="text-center mb-0 d-flex justify-content-center">
                                <div class="mt-1 con-img rounded-circle d-flex justify-content-center align-items-center" style="height: 10em; width: 10em;">
                                  <div class="rounded-circle gambar-produk" style="background-image: url('../../assets/img/<?=$product["gambar"]?>'); height: 8em; width: 8em;" ></div>
                                </div>
                              </div>
                              <div class="text-center text-dark">
                                <h5 class="fw-bolder fs-6 m-0 lh-base"><?=ucwords($product["nama"])?></h5>
                                <p class="text-oren fs-5 m-0 fw-bolder text-warning">Rp<?=formatNumber($product["keuntungan"])?></p>
                                <p class="fw-semibold fs-09 pb-2"><i class="text-warning bi bi-coin"></i> <span class="text-secondary">keuntungan</span></p>
                              </div>
                            </div>
                          </div>
                          <?php endif ?>
                          <?php if($product["kategori"] == "frozen food") : ?>
                            <div class="kartu kartuPm frozen-foodPm rounded-5 d-none px-2">
                            <div class="border-0 rounded-5 d-relative bg-white">
                              <div class="text-center mb-0 d-flex justify-content-center">
                                <div class="mt-1 con-img rounded-circle d-flex justify-content-center align-items-center" style="height: 10em; width: 10em;">
                                  <div class="rounded-circle gambar-produk" style="background-image: url('../../assets/img/<?=$product["gambar"]?>'); height: 8em; width: 8em;" ></div>
                                </div>
                              </div>
                              <div class="text-center text-dark">
                                <h5 class="fw-bolder fs-6 m-0 lh-base"><?=ucwords($product["nama"])?></h5>
                                <p class="text-oren fs-5 m-0 fw-bolder text-warning">Rp<?=formatNumber($product["keuntungan"])?></p>
                                <p class="fw-semibold fs-09 pb-2"><i class="text-warning bi bi-coin"></i> <span class="text-secondary">keuntungan</span></p>
                              </div>
                            </div>
                          </div>
                          <?php endif ?>
                          <?php if($product["kategori"] == "lainnya") : ?>
                            <div class="kartu kartuPm lainnyaPm rounded-5 d-none px-2">
                            <div class="border-0 rounded-5 d-relative bg-white">
                              <div class="text-center mb-0 d-flex justify-content-center">
                                <div class="mt-1 con-img rounded-circle d-flex justify-content-center align-items-center" style="height: 10em; width: 10em;">
                                  <div class="rounded-circle gambar-produk" style="background-image: url('../../assets/img/<?=$product["gambar"]?>'); height: 8em; width: 8em;" ></div>
                                </div>
                              </div>
                              <div class="text-center text-dark">
                                <h5 class="fw-bolder fs-6 m-0 lh-base"><?=ucwords($product["nama"])?></h5>
                                <p class="text-oren fs-5 m-0 fw-bolder text-warning">Rp<?=formatNumber($product["keuntungan"])?></p>
                                <p class="fw-semibold fs-09 pb-2"><i class="text-warning bi bi-coin"></i> <span class="text-secondary">keuntungan</span></p>
                              </div>
                            </div>
                          </div>
                          <?php endif ?>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer py-0">
                    <button type="button" class="btn btn-secondary py-0 fs-09" data-bs-dismiss="modal">Keluar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      </div>
    </div>
    <script src="../../assets/bootstrap/js/bootstrap.js"></script>
    <script src="../js/script_umum.js"></script>
    <script src="../js/script_analisis.js"></script>
  </body>
</html>
