<?php 
	// menghubungkan ke database
	$connect = mysqli_connect("localhost","root","","toko_buah");


	// fungction mengambil data dari databse
	function getDataBaseProduk($query){
		global $connect;
		$result = mysqli_query($connect, $query);
		$rows_produk = [];
		while($row_produk = mysqli_fetch_assoc($result)){
			$rows_produk[] = $row_produk;
		}
		return $rows_produk;
	}


	// function menambah data ke data base
	
		function tambah($data){
		global $connect;
		$nama = $data['nama'];
	 	$stok = $data['stok'];
	 	$harga = $data['harga'];
	 	$kategori = $data['kategori'];
	 	$satuan = $data['satuan'];
	 	$gambar = $data['gambar'];
	 	$deskripsi = $data['deskripsi'];
	 	$status = $data['status'];

	 	$query = "INSERT INTO produk VALUES ('' ,'$nama' ,'$harga' ,'$kategori','$stok','$satuan','$gambar','$deskripsi','aktif')";

	 	mysqli_query($connect,$query);

	 	return mysqli_affected_rows($connect);
	}
	
	




 ?>

 <?php  ?>