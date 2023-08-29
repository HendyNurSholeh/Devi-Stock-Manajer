const formProfil = document.querySelector("#form-profil");
const btnEditProfil = document.querySelector("#edit-profil");
const btnSimpanPerubahan = document.querySelector("#simpan-perubahan");
const inputs = document.querySelectorAll(".form-input");

inputs.forEach(function (e) {
  e.setAttribute("disabled", "disabled");
});

btnEditProfil.addEventListener("click", function () {
  inputs.forEach(function (e) {
    e.removeAttribute("disabled");
  });
  btnEditProfil.classList.add("d-none");
  btnSimpanPerubahan.classList.remove("d-none");
});

// btnEditProfil.addEventListener("click", function () {
//   // menghapus atribut disabled pada setiap input field kecuali jabatan
//   formProfil.querySelectorAll("input:not(#jabatan), textarea").forEach(function (input) {
//     input.removeAttribute("disabled");
//   });
//   // mengganti tombol "Edit Profil" menjadi tombol "Simpan Perubahan"
//   btnEditProfil.classList.add("d-none");
// });

// btnSimpanPerubahan.addEventListener("click", function () {
//   // menyimpan data yang sudah diubah
//   formProfil.submit();
//   // mengembalikan form ke keadaan semula
//   formProfil.querySelectorAll("input:not(#jabatan), textarea").forEach(function (input) {
//     input.setAttribute("disabled", "disabled");
//   });
//   btnSimpanPerubahan.classList.add("d-none");
//   btnEditProfil.classList.remove("d-none");
// });
