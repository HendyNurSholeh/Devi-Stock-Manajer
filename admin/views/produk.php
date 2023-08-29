<?php
  session_start();
  if(!isset($_SESSION["loginAdmin"])){
    header("Location: login.php");
    exit;
  }
  $no=1;
  require "../controllers/ProdukController.php";
  require_once "../utility/functionsUtil.php";
  $products = getAllProduk();
  $isSuccess = "";

  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <!-- Bootstap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <!-- fonts -->
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />
    <!-- style css & bootstrap -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style_umum.css" />
    <link rel="stylesheet" href="../css/style_produk.css" />
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
                <a class="nav-link click-oren fw-semibold p-2 px-3 aktif" aria-current="page" href="#"><i class="bi bi-bag-check-fill"></i> Produk</a>
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
    <!-- content -->
    <?php 
    // ketika form 'produk keluar' di submit
  if(isset($_POST["submit-produk-keluar"])){
    $isSuccess = addProdukKeluar($_POST);
    $_POST = [];
    if($isSuccess == "stokMinus"){
      echo alertFailed('Gagal, "Stok Tidak Mencukupi"');
    } else if($isSuccess){
      echo alertSuccess("Sukses Menambah Produk Keluar");
      $products = getAllProduk();
    }      
  } 
  // ketika form 'tambah produk baru' di submit
  if(isset($_POST["submit-tambah-produk-baru"])){
    $isSuccess = addProduk($_POST, $_FILES);
    $_POST = [];
    if($isSuccess === "duplicateName"){
      echo alertFailed('Gagal!, "Nama Produk Sudah Ada"');
    } else if($isSuccess === "gambarOversize"){
      echo alertFailed('Gagal!, "File gambar terlalu Besar"');
    } else {
      echo alertSuccess('Sukses Menambah Produk Baru');
      $products = getAllProduk();
    }
  }
  // ketika form 'produk masuk' di submit
  if(isset($_POST["submit-produk-masuk"])){
    $isSuccess = addProdukMasuk($_POST);
    $_POST = [];
    if($isSuccess){
      echo alertSuccess("Sukses Menambah Produk Masuk");
      $products = getAllProduk();
    }
  } 
  // ketika tombol 'remove produk' pada tabel di submit
  if(isset($_POST["submit-remove-produk"])){
    $isSuccess = removeProduk($_POST);
    $_POST = [];
    if($isSuccess){
      echo alertSuccess("Sukses Menghapus Produk");
      $products = getAllProduk();
    }
  }
  // ketika tombol 'edit produk' pada tabel di submit
  if(isset($_POST["submit-edit-produk"])){
    $isSuccess = editProduk($_POST, $_FILES);
    if($isSuccess === "duplicateName"){
      echo alertFailed('Gagal!, "Nama Produk Sudah Ada"');
    } else if($isSuccess === "gambarOversize"){
      echo alertFailed('Gagal!, "File gambar terlalu Besar"');
    } else {
      echo alertSuccess('Sukses Mengedit Produk');
      $products = getAllProduk();
    }
    $_POST = [];
  } 
    ?>
    <div class="mt-5">-</div>
    <div class="con-utama rounded-5 mx-5 mt-3 py-4 px-3">
    <h2 class="text-center mb-3 fw-semibold text-hitamAbu fs-2 text-shadow me-4"><i class="bi bi-building-down text-orenTua"></i> Produk</h2>
      <div class="con-table container bg-white rounded-5 p-5 pt-3">
        <div class="row mb-2 justify-content-center ps-5">
          <div class="col-3">
            <button type="button" class="btn-utama btn btn-warning text-light bg-oren fw-bolder" data-bs-toggle="modal" data-bs-target="#modalProdukKeluar"><i class="bi bi-arrow-down-square"></i> Produk Keluar</button>
          </div>
          <div class="col-3">
            <button type="button" class="btn-utama btn btn-warning text-light bg-oren fw-bolder" data-bs-toggle="modal" data-bs-target="#modalProdukMasuk"><i class="bi bi-arrow-up-square"></i> Produk Masuk</button>
          </div>
          <div class="col-3">
            <button type="button" class="btn-utama btn btn-warning text-light bg-oren fw-bolder" data-bs-toggle="modal" data-bs-target="#modalTambahProduk"><i class="bi bi-plus-lg"></i> Tambah Produk Baru</button>
          </div>
        </div>
        <!-- Modal Tambah Produk Baru -->
        <div class="modal fade" id="modalTambahProduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahProdukLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bolder" id="modalTambahProdukLabel">Tambah Produk Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-start">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama" name="nama" required/>
                    <p class="duplicate-name text-danger fs-08 d-none">Nama produk sudah ada!</p>
                  </div>
                  <div class="mb-3">
                    <label for="harga" class="form-label">Harga Jual <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="harga" name="harga" min="0" required/>
                  </div>
                  <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select class="form-select" id="kategori" name="kategori">
                      <option value="buah">Buah</option>  
                      <option value="frozen food">Frozen Food</option>
                      <option value="lainnya">Lainnya</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                    <select class="form-select" id="satuan" name="satuan">
                      <option value="kg">Kg</option>
                      <option value="pcs">Pcs</option>
                      <option value="biji">Biji</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar Produk <span class="text-danger">*</span> <span class="fs-09 text-secondary">[maks 2mb]</span></label>
                    <input type="file" class="form-control" id="gambar" name="gambar" required/>
                  </div>
                  <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="(jika ada)"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary" name="submit-tambah-produk-baru">Tambahkan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Produk Keluar -->
        <div class="modal fade" id="modalProdukKeluar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalProdukKeluarLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bolder" id="modalProdukKeluarLabel">Produk Keluar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-start">
                <form action="" method="post">
                  <div class="mb-3">
                    <label for="nama-produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                    <select class="form-select" id="nama-produk-pk" name="idProduk" required>
                      <option value="" data-satuan="kg/biji">Pilih Produk</option>
                      <?php for($i=0; $i<count($products); $i++) : ?>
                        <option value="<?=$products[$i]['id']?>" data-satuan="<?=$products[$i]['satuan']?>" data-harga="<?=$products[$i]['harga']?>" ><?= ucwords($products[$i]["nama"])?></option>
                      <?php endfor; ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <input type="number" class="form-control jumlah-pk" id="jumlah" name="jumlah" placeholder="masukkan satuan dalam kg/biji" required step="0.01" min="0" />
                      <input type="text" class="form-control" id="satuan-pk" name="satuan-pk" placeholder="kg/biji" disabled/>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="harga-terjual" class="form-label">Harga Terjual<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="harga-terjual" value="0" name="harga-terjual" min="0" required />
                  </div>
                  <div class="mb-3">
                    <label for="tanggal-keluar" class="form-label">Tanggal Keluar <span class="text-danger">*</span></label>
                    <input type="date" class="form-control tanggal" name="tanggal-keluar"  required max="<?php echo date('Y-m-d'); ?>"/>
                  </div>
                  <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" placeholder="(jika ada)" rows="3"></textarea>
                  </div>
                  <input type="hidden" id="satuan" name="satuan" />
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary" name="submit-produk-keluar">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Produk Masuk -->
        <div class="modal fade" id="modalProdukMasuk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalProdukMasukLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bolder" id="modalProdukMasukLabel">Produk Masuk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-start">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="nama-produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                    <select class="form-select" id="nama-produk-pm" name="idProduk" required>
                      <option value="">Pilih Produk</option>
                      <?php for($i=0; $i<count($products); $i++) : ?>
                        <option value="<?=$products[$i]['id']?>" data-satuan="<?=$products[$i]['satuan']?>"><?= ucwords($products[$i]["nama"])?></option>
                      <?php endfor; ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <input type="number" class="form-control jumlah-pm" id="jumlah" name="jumlah" placeholder="masukkan dalam satuan kg/biji" required min="0" step="0.01" />
                      <input type="text" class="form-control" id="satuan-pm" name="satuan-pm" placeholder="kg/biji" disabled/>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="harga-beli" class="form-label">Harga Beli <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="harga-beli" name="harga-beli" min="0" step="0.01" required />
                  </div>
                  <div class="mb-3">
                    <label for="tanggal-masuk" class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                    <input type="date" class="form-control tanggal" name="tanggal-masuk"  required/>
                  </div>
                  <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" placeholder="(jika ada)" rows="3"></textarea>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary" name="submit-produk-masuk">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- tabel -->
        <table id="stok-table" class="table table-striped shadow-sm table-bordered">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama Produk</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Stok</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php  for($i=count($products)-1; $i>=0; $i--) :?>
              <tr>
                <td style="width:30px"><?= $no ?></td>
                <td><?=ucwords($products[$i]["nama"])?></td>
                <td><?=ucwords($products[$i]["kategori"]) ?></td>
                <td><?=formatNumber($products[$i]["harga"]) ?>/<?= $products[$i]["satuan"] ?></td>
                <td><?=formatNumber($products[$i]["stok"]) ?> <?= ucwords($products[$i]["satuan"]) ?></td>
                <td style="width:111px;">
                  <button type='button' class='btn border btn-success p-0 px-2 m-0' data-bs-toggle='modal' data-bs-target='#detail<?=$products[$i]["id"]?>'><i class="bi bi-info-circle"></i></button> 
                  <button type='button' class='btn border btn-primary p-0 px-2 m-0' data-bs-toggle='modal' data-bs-target='#edit<?=$products[$i]["id"]?>'><i class="bi bi-pencil-square text-light"></i></button>
                  <button type='button' class='btn border btn-danger p-0 px-2 m-0' data-bs-toggle='modal' data-bs-target='#delete<?=$products[$i]["id"]?>'><i class="bi bi-trash text-light"></i></button>
                </td>
              </tr>
              <?php $no++ ?>
              <!-- Modal Details -->
              <div class="modal fade" id="detail<?=$products[$i]["id"]?>" tabindex="-1" aria-labelledby="deskripsiProdukModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deskripsiProdukModalLabel">Detail Produk</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6 gambar-produk" style="background-image:url('../../assets/img/<?=$products[$i]["gambar"]?>');"></div>
                        <div class="col-md-6">
                          <h1><?= ucwords($products[$i]["nama"]) ?></h1>
                          <p class="fs-5">Kategori: <?= ucwords($products[$i]["kategori"]) ?></p>
                          <p class="fs-5">Harga: Rp<?= formatNumber($products[$i]["harga"]) ?> / <?= $products[$i]["satuan"] ?></p>
                          <p class="fs-5">Stok: <?= formatNumber($products[$i]["stok"]) ?> <?= $products[$i]["satuan"] ?></p>
                          <p class="fs-5">Deskripsi: <?= ifEmptyStrip($products[$i]["deskripsi"]) ?></p> <br> <br>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal form edit Produk -->
              <div class="modal fade" id="edit<?=$products[$i]["id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahProdukLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5 fw-bolder" id="modalTambahProdukLabel">Ubah Data Produk</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                      <form id="edit-produk" action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                          <label for="nama" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="nama" name="nama" value="<?=ucwords($products[$i]["nama"])?>" required/>
                        </div>
                        <div class="mb-3">
                          <label for="harga" class="form-label">Harga Jual <span class="text-danger">*</span></label>
                          <input type="number" class="form-control" id="harga" name="harga" value="<?=$products[$i]["harga"]?>" min="0" required/>
                        </div>
                        <div class="mb-3">
                          <label for="gambar" class="form-label">Gambar Produk </label>
                          <div class="col-2 border border-3">
                            <div class="gambar-produk gambar-edit-produk" style="background-image:url('../../assets/img/<?=$products[$i]["gambar"]?>'); height:70px; width: 100%;"></div>
                          </div>
                          <span class="fs-09 text-secondary">[maks 2mb]</span>
                          <input type="file" class="form-control input-gambar-edit-produk" name="gambar" />
                        </div>
                        <div class="mb-3">
                          <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                          <select class="form-select" id="kategori" name="kategori">
                            <option value="buah">Buah</option>  
                            <option value="frozen food" <?php if($products[$i]["kategori"]==="frozen food"){echo "selected";}?>>Frozen Food</option>
                            <option value="lainnya" <?php if($products[$i]["kategori"]==="lainnya"){echo "selected";}?>>Lainnya</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                          <select class="form-select" id="satuan" name="satuan">
                            <option value="kg">Kg</option>
                            <option value="pcs" <?php if($products[$i]["satuan"]==="pcs"){echo "selected";}?>>Pcs</option>
                            <option value="biji" <?php if($products[$i]["satuan"]==="biji"){echo "selected";}?>>Biji</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                          <textarea class="form-control" id="deskripsi" name="deskripsi" value="<?=ifEmptyStrip($products[$i]["deskripsi"])?>" placeholder="-"></textarea>
                        </div>
                        <input type="hidden" name="id_produk" value="<?=$products[$i]['id']?>">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="submit-edit-produk">Submit Perubahan</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal delete -->
              <div class="modal" id="delete<?=$products[$i]["id"]?>" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Hapus Produk</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="" method="post">
                        <input type="hidden" name="id_produk" value="<?=$products[$i]["id"]?>" >
                        <p>Apakah anda yakin ingin menghapus Produk "<?=ucwords($products[$i]['nama'])?>"?</p>
                        <div class="text-end">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-danger" name="submit-remove-produk">Ya</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php endfor; ?>
          </tbody>
        </table>
      </div>
    </div>

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
    <script src="/toko_devi/admin/js/script_umum.js?<?php echo time(); ?>"></script>
    <script src="/toko_devi/admin/js/script_produk.js?<?php echo time(); ?>"></script>
  </body>
</html>
