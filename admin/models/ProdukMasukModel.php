<?php
    require_once "../utility/functionsUtil.php";
    $conn = mysqli_connect("localhost", "root", "", "toko_buah"); // koneksi ke database

    // query select
    function selectProdukMasukToday(){
        global $conn;
        $today = getTanggalToday();
        $query = "SELECT * FROM produk_masuk WHERE tanggal_masuk='$today'";
        $result = mysqli_query($conn, $query); // hasilnya object
        // mengubah data object menjadi array asosiatif
        $allProdukKeluarToday = [];
        while ($ProdukKeluarToday = mysqli_fetch_assoc($result)){
            $allProdukKeluarToday[] = $ProdukKeluarToday;
        }
        return $allProdukKeluarToday;    
    }

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

     // query insert
     function insertProdukMasuk($idProduk, $idAkun, $hargaBeli, $jumlah, $tanggalMasuk, $catatan){
        global $conn;
        $query = "insert into produk_masuk(id_produk, id_akun, harga_beli, jumlah, tanggal_masuk, catatan)
        values($idProduk, $idAkun, $hargaBeli, $jumlah, '$tanggalMasuk', '$catatan');";
        mysqli_query($conn, $query);       
        $isSuccess = mysqli_affected_rows($conn);
        return $isSuccess;
    }
?>