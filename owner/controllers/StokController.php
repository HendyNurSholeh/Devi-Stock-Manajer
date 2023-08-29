<?php 
    require "../models/ProdukModel.php";

	function getAllProduk(){
		$allProduk =selectAllProduk();
		return $allProduk;
	}
?>