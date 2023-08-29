function switchProduk(kategori){
	var btnAll = document.getElementById('tombol-all');
	var btnBuah = document.getElementById('tombol-buah');
	var btnFood = document.getElementById('tombol-frozen');
	var btnLainnya = document.getElementById('tombol-lainnya');
	var buah = document.getElementById('produk-buah');
	var food = document.getElementById('produk-food');
	var lainnya = document.getElementById('produk-lainnya')

	if(kategori == 'all'){
		buah.classList.remove('hidden');
		food.classList.remove('hidden');
		lainnya.classList.remove('hidden');
		btnAll.style.backgroundColor = "#3a6a81";
		btnAll.style.color = 'white';
		btnBuah.style.backgroundColor = "white";
		btnBuah.style.color = "#3a6a81";
		btnFood.style.backgroundColor = "white";
		btnFood.style.color = "#3a6a81";
		btnLainnya.style.backgroundColor = "white";
		btnLainnya.style.color = "#3a6a81";
	} else if(kategori == 'buah'){
		buah.classList.remove('hidden');
		food.classList.add('hidden');
		lainnya.classList.add('hidden');
		btnBuah.style.backgroundColor = "#3a6a81";
		btnBuah.style.color = "white";
		btnAll.style.backgroundColor = "white";
		btnAll.style.color = "#3a6a81";
		btnFood.style.backgroundColor = "white";
		btnFood.style.color = "#3a6a81";
		btnLainnya.style.backgroundColor = "white";
		btnLainnya.style.color = "#3a6a81";
	} else if(kategori == 'food'){
		buah.classList.add('hidden');
		food.classList.remove('hidden');
		lainnya.classList.add('hidden');
		btnBuah.style.backgroundColor = "white";
		btnBuah.style.color = "#3a6a81";
		btnAll.style.backgroundColor = "white";
		btnAll.style.color = "#3a6a81";
		btnFood.style.backgroundColor = "#3a6a81";
		btnFood.style.color = "white";
		btnLainnya.style.backgroundColor = "white";
		btnLainnya.style.color = "#3a6a81";
	} else{
		buah.classList.add('hidden');
		food.classList.add('hidden');
		lainnya.classList.remove('hidden');
		btnFood.style.backgroundColor = "white";
		btnFood.style.color = "#3a6a81";
		btnAll.style.backgroundColor = "white";
		btnAll.style.color = "#3a6a81";
		btnLainnya.style.backgroundColor = "#3a6a81";
		btnLainnya.style.color = "white";
		btnBuah.style.backgroundColor = "white";
		btnBuah.style.color = "#3a6a81";
	}

}





	


document.getElementById('cari').addEventListener('input', function(){
	var searchInput = this.value.toLowerCase();
	var produkList = document.getElementById('kotak-produk');
	var products = document.getElementsByTagName('li');

	for(var i = 0; i <products.length; i++){
		var produk = products[i];
		var produkName = produk.getElementsByTagName('h2')[0].innerHTML.toLowerCase();

		if(searchInput === '' || produkName.includes(searchInput)){
			produk.style.display = 'block';
		} else{
			produk.style.display = 'none';
		}
	}
});


// menampilkan navbar filter
var btnFilter = document.getElementById('btn-filter');
var navbarCari = document.getElementById('navbar-filter');

btnFilter.addEventListener("click",function(){
	if(navbarCari.style.display === "none"){
		navbarCari.style.display = "block";
	} else {
		navbarCari.style.display = "none";
	}
});

	

