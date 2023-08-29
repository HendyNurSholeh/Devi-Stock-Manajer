<?php
    require_once "../utility/functionsUtil.php";
    $conn = mysqli_connect("localhost", "root", "", "toko_buah"); // koneksi ke database

    function selectProdukMasukByRange($tanggal_awal, $tanggal_akhir){
        global $conn;
        $query = "SELECT * FROM produk_masuk WHERE tanggal_masuk>='$tanggal_awal' AND tanggal_masuk<='$tanggal_akhir'";
        $result = mysqli_query($conn, $query); // hasilnya object
        // mengubah data object menjadi array asosiatif
        $allProdukMasukByRange = [];
        while ($ProdukMasukByRange = mysqli_fetch_assoc($result)){
            $allProdukMasukByRange[] = $ProdukMasukByRange;
        }
        return $allProdukMasukByRange;    
    }

    function selectProdukMasukById($idProduk){
        global $conn;
        $query = "SELECT * FROM produk_masuk WHERE id_produk=$idProduk";
        $result = mysqli_query($conn, $query); // hasilnya object
        // mengubah data object menjadi array asosiatif
        $allProdukMasuk = [];
        while ($ProdukMasuk = mysqli_fetch_assoc($result)){
            $allProdukMasuk[] = $ProdukMasuk;
        }
        return $allProdukMasuk;    
    }
?>