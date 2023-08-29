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
