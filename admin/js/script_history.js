// DEKLARASI
// const dataProdukKeluar = [ 
//   { tanggal: "2023-01-01", nama: "Apel", kategori: "Buah", jumlah: 10, satuan: "Kg", totalHarga: 0, catatan: "Buah Busuk" },
//   { tanggal: "2023-01-02", nama: "Apel", kategori: "Buah", jumlah: 5, satuan: "Kg", totalHarga: 0, catatan: "Buah Busuk" },
//   { tanggal: "2023-01-03", nama: "Apel", kategori: "Buah", jumlah: 8, satuan: "Kg", totalHarga: 0, catatan: "Buah Busuk" },
//   { tanggal: "2023-01-01", nama: "Apel", kategori: "Buah", jumlah: 10, satuan: "Kg", totalHarga: 0, catatan: "Buah Busuk" },
//   { tanggal: "2023-01-02", nama: "Apel", kategori: "Buah", jumlah: 5, satuan: "Kg", totalHarga: 0, catatan: "Buah Busuk" },
//   { tanggal: "2023-01-03", nama: "Apel", kategori: "Buah", jumlah: 8, satuan: "Kg", totalHarga: 1500000, catatan: "" },
//   { tanggal: "2023-01-01", nama: "Apel", kategori: "Buah", jumlah: 10, satuan: "Kg", totalHarga: 2000000, catatan: "" },
//   { tanggal: "2023-01-02", nama: "Nugget", kategori: "Frozen Food", jumlah: 5, satuan: "Biji", totalHarga: 1000000, catatan: "" },
//   { tanggal: "2023-01-03", nama: "Nugget", kategori: "Frozen Food", jumlah: 8, satuan: "Biji", totalHarga: 1500000, catatan: "" },
//   { tanggal: "2023-01-01", nama: "Nugget", kategori: "Frozen Food", jumlah: 10, satuan: "Biji", totalHarga: 2000000, catatan: "" },
//   { tanggal: "2023-01-02", nama: "Nugget", kategori: "Frozen Food", jumlah: 5, satuan: "Biji", totalHarga: 1000000, catatan: "" },
//   { tanggal: "2023-01-03", nama: "Sosis", kategori: "Frozen Food", jumlah: 8, satuan: "Biji", totalHarga: 270000, catatan: "" },
//   { tanggal: "2023-03-26", nama: "Sosis", kategori: "Frozen Food", jumlah: 8, satuan: "Biji", totalHarga: 270000, catatan: "" },
//   { tanggal: "2023-03-27", nama: "Sosis", kategori: "Frozen Food", jumlah: 8, satuan: "Biji", totalHarga: 270000, catatan: "" },
//   { tanggal: "2023-03-27", nama: "Sosis", kategori: "Frozen Food", jumlah: 8, satuan: "Biji", totalHarga: 270000, catatan: "" },
//   { tanggal: "2023-03-27", nama: "Sosis", kategori: "Frozen Food", jumlah: 8, satuan: "Biji", totalHarga: 270000, catatan: "" },
//   { tanggal: "2023-03-27", nama: "Sosis", kategori: "Frozen Food", jumlah: 8, satuan: "Biji", totalHarga: 1500000, catatan: "" },
//   { tanggal: "2023-03-27", nama: "Sosis", kategori: "Frozen Food", jumlah: 8, satuan: "Biji", totalHarga: 1500000, catatan: "" },
//   { tanggal: "2023-03-31", nama: "Sosis", kategori: "Frozen Food", jumlah: 8, satuan: "Biji", totalHarga: 1500000, catatan: "" },
//   { tanggal: "2023-04-01", nama: "Apel", kategori: "Buah", jumlah: 8, satuan: "Kg", totalHarga: 1500000, catatan: "" },
//   { tanggal: "2023-04-03", nama: "Apel", kategori: "Buah", jumlah: 8, satuan: "Kg", totalHarga: 1500000, catatan: "" },
// ];
// Tanggal Form
// const today = new Date().toISOString().split("T")[0];
// const tanggalMulai = document.getElementById("tanggal-mulai");
// const tanggalAkhir = document.getElementById("tanggal-akhir");
// button filter produk masuk & keluar

// set default tanggal menjadi hari ini
// tanggalMulai.defaultValue = today;
// tanggalAkhir.defaultValue = today;
// Set tanggal agar tidak melebihi hari ini
// tanggalMulai.setAttribute("max", today);
// tanggalAkhir.setAttribute("max", today);

const conFilterHistory = document.getElementsByClassName("con-filter-history")[0];
const filterHistory = document.querySelectorAll(".filter-history");
conFilterHistory.addEventListener("click", function (e) {
  // Botton > Produk Masuk & Produk Keluar (mewarnai)
  if (e.target.classList.contains("click-oren")) {
    for (let i = 0; i < filterHistory.length; i++) {
      filterHistory[i].classList.remove("borderOren");
      filterHistory[i].classList.add("borderGray");
    }
    e.target.classList.remove("borderGray");
    e.target.classList.add("borderOren");
  }

  if(e.target.classList.contains("produk-keluar-btn")){
    document.getElementById("history-produk-keluar").classList.remove("d-none");
    document.getElementById("history-produk-masuk").classList.add("d-none");
  } else if(e.target.classList.contains("produk-masuk-btn")){
    document.getElementById("history-produk-keluar").classList.add("d-none");
    document.getElementById("history-produk-masuk").classList.remove("d-none");
  }
});

setTimeout(function(){
  document.getElementById("history-produk-masuk").classList.add("d-none");
}, 10)

// Tabel


  // dataTable.clear(); // Hapus isi tabel penjualan sebelumnya
  // const dateForm = document.getElementById("date-form"); // Ketika form disubmit, tampilkan data penjualan

  // const totalBuahTerjualEl = document.getElementById('total-buah');
  // const totalFrTerjualEl = document.getElementById('total-frozen-food');
  // const totalHargaPenjualanEl = document.getElementById('total-harga');
  // let totalBuahTerjual = 0;
  // let totalFrozenFoodTerjual = 0;
  // let totalHargaPenjualan = 0;
  // default tabel awal
  // for (let i = 0; i < dataProdukKeluar.length; i++) {
  //   if (dataProdukKeluar[i].tanggal === today) {
  //     dataTable.row.add([dataProdukKeluar[i].tanggal, dataProdukKeluar[i].nama, dataProdukKeluar[i].kategori, 
  //     dataProdukKeluar[i].jumlah + " " + dataProdukKeluar[i].satuan, dataProdukKeluar[i].totalHarga, dataProdukKeluar[i].catatan]);
  //     if (dataProdukKeluar[i].satuan.toLowerCase() === "kg") {
  //       totalBuahTerjual += dataProdukKeluar[i].jumlah;
  //     } else if (dataProdukKeluar[i].satuan.toLowerCase() === "biji") {
  //       totalFrozenFoodTerjual += dataProdukKeluar[i].jumlah;
  //     }
  //     totalHargaPenjualan += dataProdukKeluar[i].totalHarga;
  //   }
  // }
  // totalBuahTerjualEl.innerHTML = totalBuahTerjual + " Kg"; // menambahkan total buah terjual
  // if (!(totalFrozenFoodTerjual === 0)) {
    // totalFrTerjualEl.innerHTML = totalFrozenFoodTerjual + " Biji"; // menambahkan fr terjual
  // }
  // totalHargaPenjualanEl.innerHTML = "Rp" + totalHargaPenjualan; // menambahkan total harga penjualan
  
  // let alertContainer;
  // const conAlert = document.getElementById("con-alert");
  // let alertShow = document.querySelectorAll("#alert-container");
  // Tanggal di submit
  // dateForm.addEventListener("submit", (event) => {
    // Mengecek apakah tanggal valid
    // const tanggalMulaiValue = event.target.elements["start-date"].value;
    // const tanggalAkhirValue = event.target.elements["end-date"].value;
    // dataTable.clear(); // Hapus isi tabel penjualan sebelumnya
    // event.preventDefault(); // menghindari halaman refresh
    // alertShow = document.querySelectorAll("#alert-container");
    // if (tanggalMulaiValue > tanggalAkhirValue) {
    //   if (alertShow.length === 0) {
    //     alertContainer = document.createElement("div");
    //     alertContainer.setAttribute("id", "alert-container");
    //     alertContainer.innerHTML = `
    //     <div class="alert alert-danger alert-dismissible fade show" role="alert">
    //       Tanggal awal harus lebih kecil dari tanggal akhir!
    //       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //       </div>
    //       `;
    //     conAlert.appendChild(alertContainer);
    //   }
    // } else {
      // remove alert container jika tanggal valid
      // if (alertShow.length > 0) {
      //   console.log("remove alert");
      //   alertContainer.remove();
      // }
      // deklarasi variabel untuk tabel total penjualan
      // totalBuahTerjual = 0;
      // totalFrozenFoodTerjual = 0;
      // totalHargaPenjualan = 0;
      // Tambahkan data penjualan ke tabel2
      // for (let i = 0; i < dataProdukKeluar.length; i++) {
      //   if (dataProdukKeluar[i].tanggal >= tanggalMulaiValue && dataProdukKeluar[i].tanggal <= tanggalAkhirValue) {
      //     dataTable.row.add([dataProdukKeluar[i].tanggal, dataProdukKeluar[i].nama, dataProdukKeluar[i].kategori, dataProdukKeluar[i].jumlah + " " + dataProdukKeluar[i].satuan, dataProdukKeluar[i].totalHarga, dataProdukKeluar[i].catatan]);
      //     if (dataProdukKeluar[i].satuan.toLowerCase() === "kg") {
      //       totalBuahTerjual += dataProdukKeluar[i].jumlah;
      //     } else if (dataProdukKeluar[i].satuan.toLowerCase() === "biji") {
      //       totalFrozenFoodTerjual += dataProdukKeluar[i].jumlah;
      //       console.log(totalFrozenFoodTerjual);
      //     }
      //     totalHargaPenjualan += dataProdukKeluar[i].totalHarga;
      //   }
      // }
      // totalBuahTerjualEl.innerHTML = totalBuahTerjual + " Kg"; // menambahkan total buah terjual
      // console.log(totalFrozenFoodTerjual);
      // if (!(totalFrozenFoodTerjual === 0)) {
        // totalFrTerjualEl.innerHTML = totalFrozenFoodTerjual + " Biji"; // menambahkan fr terjual
      // }
      // totalHargaPenjualanEl.innerHTML = "Rp" + totalHargaPenjualan; // menambahkan total harga penjualan
    // }
    // Redraw tabel
    // dataTable.draw();
  // });

  // Redraw tabel
  // dataTable.draw();

  // conKategori.addEventListener('click', function(e){
  //   if(e.target.classList.contains("produk-keluar-btn")){
  //     } else if (e.target.classList.contains("produk-masuk-btn")){
  //       document.querySelector('.total-penjualan h5').innerHTML = "Total Produk Masuk";
  //       document.querySelector('.judul-total-buah').innerHTML = "Total Buah Masuk";
  //       document.querySelector('.judul-total-fr').innerHTML = "Total Frozen Food Masuk";
  //       document.querySelector('.judul-total-harga').innerHTML = "Total Modal / Harga Beli";
  //       document.querySelector('#table-harga-jual').innerHTML = "Harga Beli";
  //     }
  // })

