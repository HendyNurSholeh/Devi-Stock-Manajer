<?php
    $conn = mysqli_connect("localhost", "root", "", "toko_buah"); // koneksi ke database

    // query select
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

    // query insert
    function insertProduk($nama, $harga, $kategori, $satuan, $gambar, $deskripsi){
        global $conn;
        $query = "insert into produk(nama, harga, kategori, satuan, gambar, deskripsi) 
                  values('$nama', $harga, '$kategori', '$satuan', '$gambar', '$deskripsi')";
        mysqli_query($conn, $query);
        $isSuccess = mysqli_affected_rows($conn);
        return $isSuccess;
    } 
    
     // query update
     function updateStokProduk($idProduk, $stokBaru){
        global $conn;
        $query = "update produk set stok=$stokBaru where id=$idProduk;";
        $isSuccess = mysqli_query($conn, $query);
        return $isSuccess;
    }

    function updateProduk($idProduk, $nama, $harga, $gambar, $kategori, $satuan, $deskripsi){
        global $conn;
        $query = "update produk set nama='$nama', harga=$harga, gambar='$gambar', deskripsi='$deskripsi', kategori='$kategori', satuan='$satuan' where id='$idProduk'";
        $isSuccess = mysqli_query($conn, $query);
        return $isSuccess;
    }

    function deleteProdukById($idProduk){
        global $conn;
        $query = "update produk set status='tidak aktif' where id='$idProduk'";
        $isSuccess = mysqli_query($conn, $query);
        return $isSuccess;           
    }
?>