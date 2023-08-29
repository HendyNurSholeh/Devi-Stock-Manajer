// statistik bottom > mengatur kategori
const conKategori = document.getElementsByClassName("conKategori")[0];
const kategori = document.querySelectorAll(".kategori");
const semua = document.querySelectorAll(".semua");
const buah = document.querySelectorAll(".buah");
const frozenFood = document.querySelectorAll(".frozen-food");
const lainnya = document.querySelectorAll(".lainnya");
const kartuPt = document.querySelectorAll(".kartuPt");
conKategori.addEventListener("click", function (e) {
  e.target.classList.remove("text-secondary");
  if (e.target.classList.contains("click-oren")) {
    // mengganti warna
    for (let i = 0; i < kategori.length; i++) {
      kategori[i].classList.remove("aktif");
      kategori[i].classList.add("borderGray");
      kategori[i].style.color = "#6c757d";
    }
    e.target.classList.remove("borderGray");
    e.target.classList.add("aktif");
    e.target.style.color = "rgb(226,135,67)";
    // menampilkan produk
    for (let i = 0; i < kartuPt.length; i++) {
      kartuPt[i].classList.add("d-none");
    }
    if (e.target.classList.contains("btn-semua")) {
      for (let i = 0; i < semua.length; i++) {
        semua[i].classList.remove("d-none");
      }
    } else if (e.target.classList.contains("btn-buah")) {
      for (let i = 0; i < buah.length; i++) {
        buah[i].classList.remove("d-none");
      }
    } else if (e.target.classList.contains("btn-frozen-food")) {
      for (let i = 0; i < frozenFood.length; i++) {
        frozenFood[i].classList.remove("d-none");
      }
    } else if (e.target.classList.contains("btn-lainnya")) {
      for (let i = 0; i < lainnya.length; i++) {
        lainnya[i].classList.remove("d-none");
      }
    }
  }
});

const conKategoriPm = document.getElementsByClassName("conKategoriPm")[0];
const kategoriPm = document.querySelectorAll(".kategoriPm");
const semuaPm = document.querySelectorAll(".semuaPm");
const buahPm = document.querySelectorAll(".buahPm");
const frozenFoodPm = document.querySelectorAll(".frozen-foodPm");
const lainnyaPm = document.querySelectorAll(".lainnyaPm");
const kartuPm = document.querySelectorAll(".kartuPm");
conKategoriPm.addEventListener("click", function (e) {
  // mengganti warna
  e.target.classList.remove("text-secondary");
  if (e.target.classList.contains("click-oren")) {
    for (let i = 0; i < kategoriPm.length; i++) {
      kategoriPm[i].classList.remove("aktif");
      kategoriPm[i].classList.add("borderGray");
      kategoriPm[i].style.color = "#6c757d";
    }
    e.target.classList.remove("borderGray");
    e.target.classList.add("aktif");
    e.target.style.color = "rgb(226,135,67)";
    // menampilkan produk
    for (let i = 0; i < kartuPm.length; i++) {
      kartuPm[i].classList.add("d-none");
    }
    if (e.target.classList.contains("btn-semuaPm")) {
      for (let i = 0; i < semuaPm.length; i++) {
        semuaPm[i].classList.remove("d-none");
      }
    } else if (e.target.classList.contains("btn-buahPm")) {
      for (let i = 0; i < buahPm.length; i++) {
        buahPm[i].classList.remove("d-none");
      }
    } else if (e.target.classList.contains("btn-frozen-foodPm")) {
      for (let i = 0; i < frozenFoodPm.length; i++) {
        frozenFoodPm[i].classList.remove("d-none");
      }
    } else if (e.target.classList.contains("btn-lainnyaPm")) {
      for (let i = 0; i < lainnyaPm.length; i++) {
        lainnyaPm[i].classList.remove("d-none");
      }
    }
  }
});
// Fungsi > click Oren
function clickOren(e, target) {
  if (e.target.classList.contains("click-oren")) {
    for (let i = 0; i < target.length; i++) {
      target[i].classList.remove("aktif");
      target[i].style.color = "#6c757d";
    }
    e.target.classList.add("aktif");
    e.target.style.color = "rgb(226,135,67)";
  }
}
