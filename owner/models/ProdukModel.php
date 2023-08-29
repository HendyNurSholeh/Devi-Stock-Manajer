<?php
    $conn = mysqli_connect("localhost", "root", "", "toko_buah"); // koneksi ke database

    function selectAllProduk(){
        global $conn;
        $query = "SELECT * FROM produk WHERE status='aktif'";
        $result = mysqli_query($conn, $query); // hasilnya object
        // mengubah data object menjadi array asosiatif
        $allProduk = [];
        while ($produk = mysqli_fetch_assoc($result)){
            $allProduk[] = $produk;
        }
        return $allProduk;    
    }

    function selectProdukById($idProduk){
        global $conn;
        $query = "SELECT * FROM produk where id=$idProduk";
        $result = mysqli_query($conn, $query); // hasilnya object
        $produk = mysqli_fetch_assoc($result); // mengubah data object menjadi array asosiatif
        return $produk;    
    }
?>