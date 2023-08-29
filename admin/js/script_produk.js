// Tabel > edit produk -> agar ketika user mengupload gambar, maka gambar yang diupload akan tampil
const inputGambar = document.querySelectorAll(".input-gambar-edit-produk");
for (let i = 0; i < inputGambar.length; i++) {
  inputGambar[i].addEventListener("change", function () {
    const url = URL.createObjectURL(inputGambar[i].files[0]);
    const gambarEditProduk = inputGambar[i].closest(".mb-3").querySelector(".gambar-edit-produk");
    gambarEditProduk.style.backgroundImage = `url(${url})`;
  });
}
// Produk Keluar -> ketika memilih nama produk, form satuan akan menyesuaikan
const selectProduk = document.getElementById("nama-produk-pk");
selectProduk.addEventListener("change", function () {
  const satuan = selectProduk.options[selectProduk.selectedIndex].dataset.satuan;
  document.getElementById("satuan-pk").placeholder = satuan;
  document.querySelector(".jumlah-pk").placeholder = "masukkan dalam satuan " + satuan;
  // jika satuan biji maka inputan tidak boleh koma (desimal)
  if (satuan === "biji" || satuan === "pcs") {
    document.querySelector(".jumlah-pk").step = "1";
  } else if (satuan === "kg") {
    document.querySelector(".jumlah-pk").step = "0.01";
  }
  changeHargaProdukKeluar();
});

document.querySelector(".jumlah-pk").addEventListener("change", function (e) {
  changeHargaProdukKeluar();
});

// Produk Masuk -> ketika memilih nama produk, form satuan akan menyesuaikan
const selectProdukPm = document.getElementById("nama-produk-pm");
selectProdukPm.addEventListener("change", function () {
  const satuanPm = selectProdukPm.options[selectProdukPm.selectedIndex].dataset.satuan;
  document.getElementById("satuan-pm").placeholder = satuanPm;
  document.querySelector(".jumlah-pm").placeholder = "masukkan dalam satuan " + satuanPm;
  // jika satuan biji maka inputan tidak boleh koma (desimal)
  if (satuanPm === "biji" || satuanPm === "pcs") {
    document.querySelector(".jumlah-pm").step = "1";
  } else if (satuanPm === "kg") {
    document.querySelector(".jumlah-pm").step = "0.01";
  }
});

// fungsi (agar ketika jumlah di isi, maka menampilkan harga otomatis)
function changeHargaProdukKeluar() {
  const harga = selectProduk.options[selectProduk.selectedIndex].dataset.harga;
  const jumlah = document.querySelector(".jumlah-pk").value;
  const hargaTotal = harga * jumlah;
  if (hargaTotal.toString().length > 6) {
    document.getElementById("harga-terjual").value = hargaTotal;
  } else {
    const formattedHarga = hargaTotal.toLocaleString("id-ID");
    document.getElementById("harga-terjual").value = formattedHarga;
  }
}

// const dataProduk = [
// { namaProduk: "Pepaya", kategori: "Buah", harga: 10000, stok: 50, satuan: "Kg" },
// { namaProduk: "Anggur", kategori: "Buah", harga: 70000, stok: 21, satuan: "Kg" },
// { namaProduk: "Mangga", kategori: "Buah", harga: 30000, stok: 31, satuan: "Kg" },
// { namaProduk: "Sosis Jumbo", kategori: "Frozen Food", harga: 55000, stok: 37, satuan: "Biji" },
// { namaProduk: "Nugget", kategori: "Frozen Food", harga: 24000, stok: 25, satuan: "Biji" },
// { namaProduk: "Salak", kategori: "Buah", harga: 15000, stok: 29, satuan: "Kg" },
// ];
// Tabel
// mengambil tabel
// const table = document.getElementById("stok-table");
// mengambil tbody dari tabel
// const tbody = table.getElementsByTagName("tbody")[0];
// mengisi tbody dengan data produk
// for (let i = 0; i < dataProduk.length; i++) {
// const product = dataProduk[i];
// membuat baris baru untuk produk
// const row = tbody.insertRow(i);
// membuat sel untuk nomor urut
// const noCell = row.insertCell(0);
// noCell.textContent = i + 1;
// membuat sel untuk nama produk
// const nameCell = row.insertCell(1);
// nameCell.textContent = product.namaProduk;
// membuat sel untuk kategori
// const categoryCell = row.insertCell(2);
// categoryCell.textContent = product.kategori;
// membuat sel untuk harga
// const priceCell = row.insertCell(3);
// priceCell.textContent = product.harga + " / " + product.satuan;
// membuat sel untuk stok
// const stockCell = row.insertCell(4);
// stockCell.textContent = product.stok + " " + product.satuan;
// membuat sel untuk detail produk
// const detailCell = row.insertCell(5);
// detailCell.innerHTML = "<a href='#' class='text-decoration-none'><button type='button' class='btn border-0 p-0 m-0' data-bs-toggle='modal' data-bs-target='#deskripsiProdukModal'>Details</a>";

// detailLink.href = "#";
// const detailLink = document.createElement("a");
// detailLink.textContent = "Details";
// detailLink.style.textDecoration = "none";
// }

// Modal produk Masuk & Keluar -> Fungsi memasukkan list namaProduk pada Modal
// function listNamaProduk(formNamaProduk, formJumlah) {
// dataProduk.forEach((item) => {
// const option = document.createElement("option");
//   option.value = item.namaProduk.toLocaleLowerCase();
//   option.text = item.namaProduk + " (" + item.kategori + ")";
//   formNamaProduk.appendChild(option);
// });
// Membuat event listener untuk ketika pilihan produk berubah
// formNamaProduk.addEventListener("change", function () {
// Mendapatkan nilai dari produk yang dipilih
// const produkYgDipilih = this.value;
// Mengubah nilai pada input jumlah dan memberikan default satuan yang sesuai
// const produkTerpilih = dataProduk.find((produk) => produk.namaProduk.toLowerCase() === produkYgDipilih);
// formJumlah.placeholder = "Masukkan jumlah dalam " + produkTerpilih.satuan;
// });
// }
// Mendapatkan elemen form Barang Masuk & Keluar
// const formNamaProdukKeluar = document.querySelector("#modalProdukKeluar #namaProduk");
// const formJumlahKeluar = document.querySelector("#modalProdukKeluar #jumlah");
// const formNamaProdukMasuk = document.querySelector("#modalProdukMasuk #namaProduk");
// const formJumlahMasuk = document.querySelector("#modalProdukMasuk #jumlah");
// Menggunakan fungsi yang sudah dibuat sebelumnya
// listNamaProduk(formNamaProdukKeluar, formJumlahKeluar);
// listNamaProduk(formNamaProdukMasuk, formJumlahMasuk);

// Modal Tambah Produk Baru > mengatur tanggal agar tidak melebihi hari ini
// Dapatkan elemen tanggal masuk
// var tanggalMasukElem = document.getElementById("tanggal-masuk");
// Dapatkan tanggal hari ini
// var today = new Date().toISOString().split("T")[0];
// Set tanggal minimal untuk input tanggal masuk
// tanggalMasukElem.setAttribute("max", today);

// Menutup modal ketika form disubmit
// const modalProdukKeluar = document.querySelector("#modalProdukKeluar");
// const modalProdukMasuk = document.querySelector("#modalProdukMasuk");
// const closeModalProdukKeluar = bootstrap.Modal.getOrCreateInstance(modalProdukKeluar);
// const closeModalProdukMasuk = bootstrap.Modal.getOrCreateInstance(modalProdukMasuk);
