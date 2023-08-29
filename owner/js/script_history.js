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

  if (e.target.classList.contains("produk-keluar-btn")) {
    document.getElementById("history-produk-keluar").classList.remove("d-none");
    document.getElementById("history-produk-masuk").classList.add("d-none");
  } else if (e.target.classList.contains("produk-masuk-btn")) {
    document.getElementById("history-produk-keluar").classList.add("d-none");
    document.getElementById("history-produk-masuk").classList.remove("d-none");
  }
});

setTimeout(function () {
  document.getElementById("history-produk-masuk").classList.add("d-none");
}, 10);
