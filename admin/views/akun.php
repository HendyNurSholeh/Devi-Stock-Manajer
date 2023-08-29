<?php 
  require "../controllers/AkunController.php";
  require_once "../utility/functionsUtil.php";
  session_start();
  if(!isset($_SESSION["loginAdmin"])){
    header("Location: login.php");
    exit;
  }

  if(isset($_POST["logout"])){
    $_SESSION = [];
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
  }

  if(isset($_POST["submitPerubahan"])){
    $isSuccessEdit = editAkun($_POST);
    if($isSuccessEdit == "invalidNoTelp"){
      echo alertFailed("Nomor Telepon yang anda masukkan tidak valid!");
    } elseif ($isSuccessEdit == "duplicateEmail"){
      echo alertFailed('Gagal, "Email Sudah Ada"');
    } else{
      echo alertSuccess('Sukses mengubah data Profil');
    }
  }

  $akun = getAkunById($_SESSION["idAkun"]);
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
    <link rel="stylesheet" href="../css/style_akun.css" />
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
                <a class="nav-link click-oren fw-semibold p-2 px-3 aktif" aria-current="page" href="#"><i class="bi bi-person-circle"></i> Akun</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- content -->
    <div class="mt-2">-</div>
    <div class="container my-5 bg-white rounded-5 p-5 pt-3 shadow-lg">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card border-0">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-9">
                  <h5 class="card-title mb-3">Informasi Akun</h5>
                  <form action="" method="post" id="form-profil">
                    <div class="mb-3 row">
                      <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control form-input" id="nama" name="nama" placeholder="-" value="<?=ucwords($akun["nama"])?>">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="email" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control form-input" id="email" name="email" placeholder="-" value="<?=$akun["email"]?>">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="telepon" class="col-sm-3 col-form-label">Telepon</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control form-input" id="telepon" name="telepon" placeholder="-" value="<?=$akun["no_telp"]?>">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                      <div class="col-sm-9">
                        <textarea class="form-control form-input" id="alamat" name="alamat"  placeholder="-" rows="3"><?=ucwords($akun["alamat"])?></textarea>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?=ucwords($akun["level"])?>" disabled>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <input type="hidden" name="idAkun" value="<?=$akun['id']?>">
                      <div class="col-sm-9 offset-sm-3">
                        <button type="button" class="btn btn-primary" id="edit-profil"><i class="bi bi-pencil-square me-2"></i>Edit Profil</button>
                        <button type="submit" class="btn btn-primary d-none" name="submitPerubahan" id="simpan-perubahan"><i class="bi bi-check-circle me-2"></i>Simpan Perubahan</button>
                      </div>
                    </div>
                  </form>                  
                </div>
                <div class="col-lg-3">
                  <h5 class="card-title mb-2 mt-5"><?=ucwords($akun["username"])?></h5>
                  <p class="card-text"><?=ucwords($akun["level"])?></p>
                  <hr>
                  <br>
                  <button name="logout" type="submit" class="btn btn-danger d-block"  data-bs-toggle='modal' data-bs-target='#confirmLogout'><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- modal konfirmasi logout  -->
     <div class="modal" id="confirmLogout" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="" method="post">
                    <p>Apakah anda yakin ingin Logout ?</p>
                    <div class="text-end">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-danger" name="logout">Ya</button>
                        </div>
                      </form>
                    </div>
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
    <script src="../js/script_umum.js?<?php echo time(); ?>"></script>
    <script src="../js/script_akun.js?<?php echo time(); ?>"></script>
  </body>
</html>
