<?php 

	require "function.php";




	if(isset($_POST["submit"])){
		if(tambah($_POST) > 0){
			echo "<script>
					alert('Data Berhasil Ditambahkan');
					document.location.href = 'index.php';
				</script>";
		} else{
			echo "<script>
					alert('Data gagal Ditambahkan');
				</script>";
			echo "<br>";
			echo mysqli_error($connect);
		}
	}

	
 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tambah Data</title>
</head>
<body>

	<h1>Tambah Produk</h1>


	<form action="" method="post">
		<label for="nama">Nama :</label>
		<input type="text" id="nama" name="nama">
		<label for="stok">Stok :</label>
		<input type="text" id="stok" name="stok">
		<label for="harga">Harga :</label>
		<input type="text" id="harga" name="harga">
		<label for="kategori">kategori :</label>
		<input type="text" id="kategori" name="kategori">
		<label for="satuan">satuan :</label>
		<input type="text" id="satuan" name="satuan">
		<label for="gambar">gambar :</label>
		<input type="text" id="gambar" name="gambar">
		<label for="deskripsi">deskripsi :</label>
		<input type="text" id="deskripsi" name="deskripsi">
		<label for="status">status :</label>
		<input type="text" id="status" name="status">
		<button type="submit" name="submit">Tambah</button>
	</form>

	

</body>
</html>