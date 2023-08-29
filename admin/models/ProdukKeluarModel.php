<?php 
    require_once "../utility/functionsUtil.php";
    $conn = mysqli_connect("localhost", "root", "", "toko_buah"); // koneksi ke database

    function selectAllProdukKeluar(){
        global $conn;
        $query = "SELECT * FROM produk_keluar";
        $result = mysqli_query($conn, $query); // hasilnya object
        // mengubah data object menjadi array asosiatif
        $allProdukKeluar = [];
        while ($ProdukKeluar = mysqli_fetch_assoc($result)){
            $allProdukKeluar[] = $ProdukKeluar;
        }
        return $allProdukKeluar;    
    }

    function selectProdukKeluarToday(){
        global $conn;
        $today = getTanggalToday();
        $query = "SELECT * FROM produk_keluar WHERE tanggal_keluar='$today'";
        $result = mysqli_query($conn, $query); // hasilnya object
        // mengubah data object menjadi array asosiatif
        $allProdukKeluarToday = [];
        while ($ProdukKeluarToday = mysqli_fetch_assoc($result)){
            $allProdukKeluarToday[] = $ProdukKeluarToday;
        }
        return $allProdukKeluarToday;    
    }

    function selectProdukKeluarByRange($tanggal_awal, $tanggal_akhir){
        global $conn;
        $query = "SELECT * FROM produk_keluar WHERE tanggal_keluar>='$tanggal_awal' AND tanggal_keluar<='$tanggal_akhir'";
        $result = mysqli_query($conn, $query); // hasilnya object
        // mengubah data object menjadi array asosiatif
        $allProdukKeluarByRange = [];
        while ($ProdukKeluarByRange = mysqli_fetch_assoc($result)){
            $allProdukKeluarByRange[] = $ProdukKeluarByRange;
        }
        return $allProdukKeluarByRange;    
    }

     function insertProdukKeluar($idProduk, $idAkun, $harga, $jumlah, $tanggalKeluar, $catatan){
        global $conn;
        $query = "insert into produk_keluar(id_produk, id_akun, harga_terjual, jumlah, tanggal_keluar, catatan)
        values($idProduk, $idAkun, $harga, $jumlah, '$tanggalKeluar', '$catatan');";
        mysqli_query($conn, $query);       
        $isSuccess = mysqli_affected_rows($conn);
        return $isSuccess;
    }

?>