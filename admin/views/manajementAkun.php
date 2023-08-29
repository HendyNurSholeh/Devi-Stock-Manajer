<?php 
   session_start();
   if(!isset($_SESSION["loginAdmin"])){
     header("Location: login.php");
     exit;
   }
  require "../controllers/ManajementAkunController.php";
  $accounts = getAllAkun();
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
    <link rel="stylesheet" href="../css/style_manajement_akun.css" />
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
                <a class="nav-link click-oren fw-semibold p-2 px-3" aria-current="page" href="history.php"><i class="bi bi-stopwatch-fill"></i> History</a>
              </div>
            </li>
            <li class="nav-item">
              <div class="row me-4">
                <a class="nav-link click-oren fw-semibold p-2 px-3 aktif" aria-current="page" href="#"><i class="bi bi-person-square"></i> Manajement Akun</a>
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
          <div class="row justify-content-between">
            <div class="col">
              <h2 class="text-start mb-3 fw-semibold text-hitamAbu fs-2 text-shadow">Akun Saya</h2>
            </div>
            <div class="col">
              <div class="text-end">
                <button type="button" class="btn-utama btn btn-success text-light fw-bolder" data-bs-toggle="modal" data-bs-target="#modalTambahAkun"><i class="bi bi-plus-lg"></i> Tambah Akun</button>
              </div>
              <!-- Modal Tambah Akun -->
              <div class="modal fade" id="modalTambahAkun" tabindex="-1" aria-labelledby="modalTambahAkunLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalTambahAkunLabel">Tambah Akun</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                      <!-- Form tambah akun -->
                      <form action="" method="POST" autocomplete="off">
                        <div class="mb-3">
                          <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required />
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required />
                        </div>
                        <div class="mb-3">
                          <label for="konfirmasiPassword" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                          <input type="password" class="form-control" id="konfirmasiPassword" name="konfirmasiPassword" placeholder="Masukkan password" required />
                        </div>
                        <div class="mb-3">
                          <label for="level" class="form-label">Level <span class="text-danger">*</span></label>
                          <select class="form-select" id="level" name="level" required>
                            <option value="" selected disabled>-- Pilih Level --</option>
                            <option value="admin">Admin</option>
                            <option value="Owner">Owner</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email (jika ada)"/>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit-add-akun">Tambah</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
              // Tambah Akun
              if(isset($_POST["submit-add-akun"])){
                $isSuccess = addAkun($_POST);
                $_POST = [];
                if($isSuccess === "duplicateUsername"){
                  echo alertFailed('Gagal, "Username Sudah Ada"');
                } else if($isSuccess === "duplicateEmail"){
                  echo alertFailed('Gagal, "Email Sudah Ada"');
                } else if($isSuccess === "invalidNoTelp"){
                  echo alertFailed('Gagal, "Nomor Telephone Tidak Sesuai Format"');
                } else if($isSuccess === "passwordNotSame"){
                  echo alertFailed('"Password dan Konfirmasi Password Harus Sama"');
                } else {
                  echo alertSuccess("Sukses Menambah Akun Baru");
                  $accounts = getAllAkun();
                }
              }
              // ketika tombol 'edit akun' pada tabel di submit
              if(isset($_POST["submit-edit-akun"])){
                $isSuccess = editAkun($_POST);
                if($isSuccess === "duplicateUsername"){
                  echo alertFailed('Gagal, "Username Sudah Ada"');
                } else if($isSuccess === "passwordNotSame"){
                  echo alertFailed('"Password dan Konfirmasi Password Harus Sama"');
                } else if($isSuccess === "invalidNoTelp"){
                  echo alertFailed('"Format No Telp Tidak Valid"');
                } else if($isSuccess === "duplicateEmail"){
                  echo alertFailed('Gagal, "Email Sudah Ada"');
                } else if($isSuccess === "adminKurangDari1"){
                  echo alertFailed('Gagal!, "Admin Tidak Boleh Kurang Dari 1"');
                } else {
                  echo alertSuccess("Sukses Mengubah Data Akun");
                  $accounts = getAllAkun();
                }
                $_POST = [];
              } 
              // ketika tombol 'remove akun' pada tabel di submit
              if(isset($_POST["submit-remove-akun"])){
                $isSuccess = removeAkun($_POST);
                $_POST = [];
                if($isSuccess === "adminKurangDari1"){
                  echo alertFailed('Gagal!, "Admin Tidak Boleh Kurang Dari 1"');
                } else {
                  echo alertSuccess("Sukses Menghapus Akun");
                  $accounts = getAllAkun();
                }
              }
              ?>
            </div>
          </div>
        </header>
        <table id="stok-table" class="table table-striped shadow-sm table-bordered">
          <thead>
            <tr>
              <th>Username</th>
              <th>No. Telephone</th>
              <th>Email</th>
              <th>Level</th>
              <th>Waktu Dibuat</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php for($i=count($accounts)-1; $i>=0; $i--) : ?>
              <tr>
                <td><?=$accounts[$i]['username']?></td>
                <td><?=ifEmptyStrip($accounts[$i]['no_telp'])?></td>
                <td><?=ifEmptyStrip($accounts[$i]['email'])?></td>
                <td><?=$accounts[$i]['level']?></td>
                <td><?=convertTanggaldmy($accounts[$i]['waktu_dibuat'])?></td>
                <td style="width:111px;">
                  <button type='button' class='btn border btn-success p-0 px-2 m-0' data-bs-toggle='modal' data-bs-target='#detail<?=$accounts[$i]["id"]?>'><i class="bi bi-info-circle"></i></button> 
                  <button type='button' class='btn border btn-primary p-0 px-2 m-0' data-bs-toggle='modal' data-bs-target='#edit<?=$accounts[$i]["id"]?>'><i class="bi bi-pencil-square text-light"></i></button>
                  <button type='button' class='btn border btn-danger p-0 px-2 m-0' data-bs-toggle='modal' data-bs-target='#delete<?=$accounts[$i]["id"]?>'><i class="bi bi-trash text-light"></i></button>
                </td>
              </tr>
              <!-- Modal Details -->
              <div class="modal fade" id="detail<?=$accounts[$i]["id"]?>" tabindex="-1" aria-labelledby="deskripsiAkunModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deskripsiAkunModalLabel">Detail Akun</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-5 p-3 gambar-akun" style="background-image: url('../../assets/img/person3.png');"></div>
                        <div class="col-md-7">
                          <p class="fs-5"><strong>Nama: </strong><?= ifEmptyStrip(ucwords($accounts[$i]["nama"])) ?></p>
                          <p class="fs-5"><strong>Username: </strong><?= ucwords($accounts[$i]["username"]) ?></p>
                          <p class="fs-5"><strong>No.Telp: </strong><?= ifEmptyStrip($accounts[$i]["no_telp"]) ?></p>
                          <p class="fs-5"><strong>Email: </strong><?= ifEmptyStrip($accounts[$i]["email"]) ?></p>
                          <p class="fs-5"><strong>Jabatan: </strong><?= ucwords($accounts[$i]["level"]) ?></p>
                          <p class="fs-5"><strong>Alamat: </strong><?= ifEmptyStrip(ucwords($accounts[$i]["alamat"])) ?></p>
                          <p class="fs-5"><strong>Waktu Dibuat: </strong><?= convertTanggaldmy($accounts[$i]["waktu_dibuat"]) ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Edit Akun -->
              <div class="modal fade" id="edit<?=$accounts[$i]["id"]?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Ubah Data Akun</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="" method="post">
                        <div class="row mb-3">
                          <label for="username" class="col-sm-3 col-form-label">Username <span class="text-danger">*</span> : </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" id="username" value="<?=$accounts[$i]["username"]?>" required/>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="password" class="col-sm-3 col-form-label">Pasword Baru : </label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password"/>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="konfirmasiPassword" class="col-sm-3 col-form-label">Konfirmasi Password : </label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" name="konfirmasiPassword" id="konfirmasiPassword"/>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="noTelp" class="col-sm-3 col-form-label">No. Telephone : </label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" name="noTelp" value="<?=$accounts[$i]["no_telp"]?>" id="noTelp" placeholder="-" />
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="email" class="col-sm-3 col-form-label">Email : </label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" value="<?=$accounts[$i]["email"]?>" id="email" placeholder="-" />
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="level" class="col-sm-3 col-form-label">Level <span class="text-danger">*</span> : </label>
                          <div class="col-sm-9">
                            <select class="form-select" name="level" id="level" required>
                              <option value="admin">Admin</option>
                              <option value="owner">Owner</option>
                            </select>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="alamat" class="col-sm-3 col-form-label">Alamat : </label>
                          <div class="col-sm-9">
                            <textarea class="form-control" id="alamat" name="alamat" value="<?=$accounts[$i]["alamat"]?>" placeholder="-"></textarea>
                          </div>
                        </div>
                        <input type="hidden" name="id_akun" value="<?=$accounts[$i]['id']?>">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="submit-edit-akun">Submit Perubahan</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal delete -->
              <div class="modal" id="delete<?=$accounts[$i]["id"]?>" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Hapus Akun</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="" method="post">
                        <input type="hidden" name="id_akun" value="<?=$accounts[$i]["id"]?>" >
                        <p>Apakah anda yakin ingin menghapus Akun "<?=ucwords($accounts[$i]['username'])?>"?</p>
                        <div class="text-end">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-danger" name="submit-remove-akun">Ya</button>
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
      });
    });
    </script>
    <script src="../../assets/bootstrap/js/bootstrap.js"></script>
    <script src="../js/script_umum.js?<?php echo time(); ?>"></script>
    <script src="../js/script_manajement_akun.js?<?php echo time(); ?>"></script>
  </body>
</html>
