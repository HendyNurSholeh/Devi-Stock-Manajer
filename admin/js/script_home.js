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

// const salesTable = document.getElementById("sales-table").getElementsByTagName("tbody")[0];
// Tabel
// Tabel > Tampilkan data penjualan
// const dataProduk = [
//   { namaProduk: "Pepaya", kategori: "Buah", stok: 50, satuan: "Kg" },
//   { namaProduk: "Anggur", kategori: "Buah", stok: 21, satuan: "Kg" },
//   { namaProduk: "Mangga", kategori: "Buah", stok: 31, satuan: "Kg" },
//   { namaProduk: "Sosis Jumbo", kategori: "Frozen Food", stok: 37, satuan: "Biji" },
//   { namaProduk: "Nugget", kategori: "Frozen Food", stok: 25, satuan: "Biji" },
//   { namaProduk: "Salak", kategori: "Buah", stok: 29, satuan: "Kg" },
// ];
// Tabel > Hapus isi tabel penjualan sebelumnya
// salesTable.innerHTML = "";
// Tabel > Tambahkan data penjualan ke tabel
// for (let i = 0; i < dataProduk.length; i++) {
//   const row = salesTable.insertRow();
//   const nomorCell = row.insertCell(0);
//   const namaCell = row.insertCell(1);
//   const kategoriCell = row.insertCell(2);
//   const stokCell = row.insertCell(3);
//   nomorCell.innerText = i + 1;
//   namaCell.innerText = dataProduk[i].namaProduk;
//   kategoriCell.innerText = dataProduk[i].kategori;
//   stokCell.innerText = dataProduk[i].stok + " " + dataProduk[i].satuan;
// }

// Table sidebar
// data yang ingin ditampilkan di tabel
// var dataKeluar = [
//   { nama: "Nugget", jumlah: "3", harga: "65.000" },
//   { nama: "Sapi", jumlah: "30", harga: "1.500.000" },
//   { nama: "Tank", jumlah: "5", harga: "2.000" },
// ];
// akses elemen tabel dengan id
// var tableAside = document.querySelector(".table-side tbody");
// loop untuk mengisi tabel dengan data
// function isiDataTabelAside() {
// for (let i = dataKeluar.length - 1; i >= 0; i--) {
// buat elemen baru untuk setiap baris dalam tabel
// let row = document.createElement("tr");
// buat elemen baru untuk setiap sel dalam baris
// let cell1 = document.createElement("td");
// let cell2 = document.createElement("td");
// let cell3 = document.createElement("td");
// let cell4 = document.createElement("td");
// isi setiap sel dengan dataKeluar yang diberikan
// cell1.innerHTML = dataKeluar[i].nama;
// cell2.innerHTML = dataKeluar[i].jumlah;
// cell3.innerHTML = dataKeluar[i].harga;
// cell4.innerHTML = "<a href='#' class='text-decoration-none'><button type='button' class='btn border-0 p-0 m-0 fs-085' data-bs-toggle='modal' data-bs-target='#productModal'>Details</a>";
// tambahkan setiap sel ke dalam baris
// row.appendChild(cell1);
// row.appendChild(cell2);
// row.appendChild(cell3);
// row.appendChild(cell4);
// tambahkan setiap baris ke dalam tabel
// tableAside.appendChild(row);
//   }
// }
// isiDataTabelAside();

// Form nama produk
// Mendapatkan elemen-elemen yang diperlukan
// const namaProduk = document.querySelector("#namaProduk");
// const jumlah = document.querySelector("#jumlah");
// memasukkan item list ke form select nama produk
// dataProduk.forEach((item) => {
//   const option = document.createElement("option");
//   option.value = item.namaProduk.toLocaleLowerCase();
//   option.text = item.namaProduk + " (" + item.kategori + ")";
//   namaProduk.appendChild(option);
// });
// Membuat event listener untuk ketika pilihan produk berubah
// namaProduk.addEventListener("change", function () {
// Mendapatkan nilai dari produk yang dipilih
// const produkYgDipilih = this.value;
// Mengubah nilai pada input jumlah dan memberikan default satuan yang sesuai
//   const produkTerpilih = dataProduk.find((produk) => produk.namaProduk.toLowerCase() === produkYgDipilih);
//   jumlah.placeholder = "Masukkan jumlah dalam " + produkTerpilih.satuan;
// });

// Membuat event listener untuk ketika form disubmit
// const form = document.querySelector("form");
// const harga = document.querySelector("#harga");
// const keterangan = document.querySelector("#keterangan");
// Menutup modal ketika form disubmit
// const modal = document.querySelector(".modal");
// const modalClose = bootstrap.Modal.getOrCreateInstance(modal);

// form.addEventListener("submit", function (event) {
//   event.preventDefault(); // Mencegah form untuk melakukan submit
// Mendapatkan nilai dari input form
// const produkTerpilih = dataProduk.find((produk) => produk.namaProduk.toLocaleLowerCase() === namaProduk.value);
// const jumlahValue = jumlah.value;
// const hargaValue = harga.value;
//   const keteranganValue = keterangan.value;
// if (!produkTerpilih) {
//   alert("Produk yang dipilih tidak ditemukan");
//   return;
// }

// Menambah data ke Table Aside
// Membuat objek untuk data penjualan baru
// const newDataKeluar = {
//   nama: produkTerpilih.namaProduk,
//   jumlah: jumlahValue,
//   harga: hargaValue,
// keterangan: keteranganValue,
// };
// Tambahkan data penjualan baru ke tabel
// dataKeluar[dataKeluar.length] = newDataKeluar;
// tableAside.innerHTML = "";
// isiDataTabelAside();

// Reset form
// form.reset();
// namaProduk.selectedIndex = 0;
// jumlah.placeholder = "";
// Menutup modal
// modalClose.hide();
// });
