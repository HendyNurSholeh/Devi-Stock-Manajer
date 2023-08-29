// function printTable() {
//   // Menyembunyikan elemen-elemen yang tidak perlu ditampilkan dalam cetakan
//   var navbar = document.querySelector(".navbar");
//   var btn = document.querySelector(".btn");
//   var dataTablesElements = document.querySelectorAll(".dataTables_wrapper, .dataTables_paginate, .dataTables_info, .dataTables_length, .dataTables_filter");

//   navbar.style.display = "none";
//   btn.style.display = "none";
//   dataTablesElements.forEach(function (element) {
//     element.style.display = "none";
//   });

//   // Memanggil fungsi bawaan JavaScript untuk mencetak halaman
//   window.print();

//   // Mengembalikan tampilan asli setelah pencetakan selesai
//   navbar.style.display = "block";
//   btn.style.display = "block";
//   dataTablesElements.forEach(function (element) {
//     element.style.display = "block";
//   });
// }
