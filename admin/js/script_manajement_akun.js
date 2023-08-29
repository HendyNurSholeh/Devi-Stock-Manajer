
// $(document).ready(function () {
  // Inisialisasi DataTables
  // const dataTable = $("#stok-table").DataTable({
  //   paging: true,
  //   language: {
      // Konfigurasi bahasa
    //   sEmptyTable: "Tidak ada data yang tersedia pada tabel ini",
    //   sInfo: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
    //   sInfoEmpty: "Menampilkan 0 - 0 dari 0 data",
    //   sInfoFiltered: "(disaring dari _MAX_ total data)",
    //   sInfoPostFix: "",
    //   sInfoThousands: ",",
    //   sLengthMenu: "Tampilkan _MENU_ data",
    //   sLoadingRecords: "Memuat...",
    //   sProcessing: "Sedang diproses...",
    //   sSearch: "Cari:",
    //   sZeroRecords: "Tidak ditemukan data yang sesuai",
    //   oPaginate: {
    //     sFirst: "Pertama",
    //     sLast: "Terakhir",
    //     sNext: "Berikutnya",
    //     sPrevious: "Sebelumnya",
    //   },
    //   oAria: {
    //     sSortAscending: ": diurutkan secara menaik",
    //     sSortDescending: ": diurutkan secara menurun",
    //   },
    // },
     // Menambahkan kolom tindakan baru
  //    columnDefs: [{
  //     targets: 6,
  //     data: null,
  //     orderable: false,
  //     searchable: false,
  //     render: function(data, type, row) {
  //       // Mengisi kolom tindakan dengan HTML button-button
  //       return `<button type="button" class="btn btn-danger btn-action fs-09 py-1" data-bs-toggle="modal" data-bs-target="#editModal">Ubah</button>`;
  //     }
  //   }]
  // });
  // const salesTable = document.getElementById("stok-table").getElementsByTagName("tbody")[0];
  // tampilkan data penjualan
  // Lakukan request data penjualan dari server (gunakan AJAX atau fetch API)
  // Kita asumsikan response dari server adalah sebuah array objek penjualan
  // const salesData = [
  //   { username: "hendy", noTelp: 083145682648, email: "hendynirsholeh@gmail.com", level: "Admin", status:"aktif", dibuat:"2022-02-03"},
  //   { username: "joko", noTelp: 082153454027, email: "tingkir@gmail.com", level: "Admin", status:"aktif", dibuat:"2022-02-03"},
  // ];
  // Hapus isi tabel penjualan sebelumnya
  // dataTable.clear();
  // salesTable.innerHTML = "";
  // Tambahkan data penjualan ke tabel
  // for (let i = 0; i < salesData.length; i++) {
    // dataTable.row.add([salesData[i].username, salesData[i].noTelp, salesData[i].email, salesData[i].level, salesData[i].status, salesData[i].dibuat]);
  // }
  // Redraw tabel
  // dataTable.draw();


  // // Tambahkan event listener untuk tombol Action
  // $(document).on("click",".btn-action", function () {
  //   // Ambil data dari baris tabel yang di-klik
  //   const data = dataTable.row($(this).parents("tr")).data();
  //   // Isi nilai-nilai modal dengan data pengguna yang dipilih
  //   $("#modal-username").val(data[0]);
  //   $("#modal-no-telp").val(data[1]);
  //   $("#modal-email").val(data[2]);
  //   $("#modal-level").val(data[3]);
  //   $("#modal-status").val(data[4]);
  //   // Tampilkan modal
  //   $("#modal-action").modal("show");
  //   // Tambahkan event listener untuk tombol simpan
  //   $("#btn-simpan").on("click", function () {
  //     // Ambil nilai-nilai modal
  //     const username = $("#modal-username").val();
  //     const noTelp = $("#modal-no-telp").val();
  //     const email = $("#modal-email").val();
  //     const level = $("#modal-level").val();
  //     const status = $("#modal-status").val();
  //     // Lakukan update data pengguna di server (gunakan AJAX atau fetch API)
  //     // Kita asumsikan response dari server adalah sukses atau gagal
  //     const response = "sukses";
  //     if (response === "sukses") {
  //       // Update nilai-nilai di baris tabel yang sesuai
  //       dataTable.cell($(this).parents("tr"), 0).data(username);
  //       dataTable.cell($(this).parents("tr"), 1).data(noTelp);
  //       dataTable.cell($(this).parents("tr"), 2).data(email);
  //       dataTable.cell($(this).parents("tr"), 3).data(level);
  //       dataTable.cell($(this).parents("tr"), 4).data(status);
  //       // Redraw tabel
  //       dataTable.draw();
  //       // Sembunyikan modal
  //       $("#modal-action").modal("hide");
  //     } else {
  //       // Tampilkan pesan error jika gagal
  //       alert("Gagal mengubah data pengguna.");
  //     }
  //   });
  // });

  //  // tambahkan event listener untuk tombol "Update"
  //  $("#updateBtn").click(function() {
  //   // ambil nilai input
  //   const username = $("#username").val();
  //   const noTelp = $("#noTelp").val();
  //   const email = $("#email").val();
  //   const level = $("#level").val();
  //   const status = $("#status").val();
  //   const dibuat = $("#dibuat").val();

  //   // kirim permintaan ke server untuk memperbarui data
  //   $.ajax({
  //     url: "update.php", // ubah dengan URL yang benar
  //     type: "POST",
  //     data: {
  //       username: username,
  //       noTelp: noTelp,
  //       email: email,
  //       level: level,
  //       status: status,
  //       dibuat: dibuat
  //     },
  //     success: function(result) {
  //       // tangani respons dari server
  //       console.log(result);
  //       // tutup modal form
  //       $("#editModal").modal("hide");
  //       // muat ulang tabel data
  //       dataTable.ajax.reload();
  //     },
  //     error: function(xhr, status, error) {
  //       // tangani kesalahan
  //       console.error(error);
  //     }
  //   });
  // });
// });
