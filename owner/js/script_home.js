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

const conKategoriPh = document.getElementsByClassName("conKategoriPh")[0];
const kategoriPh = document.querySelectorAll(".kategoriPh");
const semuaPh = document.querySelectorAll(".semuaPh");
const buahPh = document.querySelectorAll(".buahPh");
const frozenFoodPh = document.querySelectorAll(".frozen-foodPh");
const lainnyaPh = document.querySelectorAll(".lainnyaPh");
const kartuPh = document.querySelectorAll(".kartuPh");
conKategoriPh.addEventListener("click", function (e) {
  // mengganti warna
  e.target.classList.remove("text-secondary");
  if (e.target.classList.contains("click-oren")) {
    for (let i = 0; i < kategoriPh.length; i++) {
      kategoriPh[i].classList.remove("aktif");
      kategoriPh[i].classList.add("borderGray");
      kategoriPh[i].style.color = "#6c757d";
    }
    e.target.classList.remove("borderGray");
    e.target.classList.add("aktif");
    e.target.style.color = "rgb(226,135,67)";
    // menampilkan produk
    for (let i = 0; i < kartuPh.length; i++) {
      kartuPh[i].classList.add("d-none");
    }
    if (e.target.classList.contains("btn-semuaPh")) {
      for (let i = 0; i < semuaPh.length; i++) {
        semuaPh[i].classList.remove("d-none");
      }
    } else if (e.target.classList.contains("btn-buahPh")) {
      for (let i = 0; i < buahPh.length; i++) {
        buahPh[i].classList.remove("d-none");
      }
    } else if (e.target.classList.contains("btn-frozen-foodPh")) {
      for (let i = 0; i < frozenFoodPh.length; i++) {
        frozenFoodPh[i].classList.remove("d-none");
      }
    } else if (e.target.classList.contains("btn-lainnyaPh")) {
      for (let i = 0; i < lainnyaPh.length; i++) {
        lainnyaPh[i].classList.remove("d-none");
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

// Main statistik
// google.charts.setOnLoadCallback(drawKeuntungan);

// function drawKeuntungan() {
//   var data = [
//     ["Tanggal", "Keuntungan"],
//     ["2022-05-01", 350],
//     ["2022-05-02", 500],
//     ["2022-05-03", 750],
//     ["2022-05-04", 250],
//     ["2022-05-05", 600],
//     ["2022-05-06", 800],
//     ["2022-05-07", 900],
//     ["2022-05-08", 700],
//     ["2022-05-09", 400],
//     ["2022-05-10", 1000],
//   ];

//   var chartData = google.visualization.arrayToDataTable(data);
//   var options = {
//     title: "10 hari terakhir",
//     curveType: "function",
//     legend: { position: "bottom" },
//     hAxis: { textStyle: { fontSize: 10 } },
//     chartArea: { top: 20, bottom: 50 },
//     titlePosition: "out",
//     // #3366CC
//     titleTextStyle: { color: "black", opacity: "0.6", fontSize: 12 },
//   };
//   var chart = new google.visualization.LineChart(document.getElementById("st-keuntungan-penjualan"));
//   chart.draw(chartData, options);
// }

// statistik total keuntungan
