<?php 
    require_once "../utility/functionsUtil.php";
    $conn = mysqli_connect("localhost", "root", "", "toko_buah"); // koneksi ke database

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

    function selectProdukKeluarTodayById($idProduk){
        global $conn;
        $hariIni = getTanggalToday();
        $query = "SELECT * FROM produk_keluar WHERE id_produk=$idProduk AND tanggal_keluar='$hariIni'";
        $result = mysqli_query($conn, $query); // hasilnya object
        // mengubah data object menjadi array asosiatif
        $allProdukKeluar = [];
        while ($produkKeluar = mysqli_fetch_assoc($result)){
            $allProdukKeluar[] = $produkKeluar;
        }
        return $allProdukKeluar;    
    }

    function selectProdukKeluarRangeById($idProduk, $tanggalAwal, $tanggalAkhir){
        global $conn;
        $query = "SELECT * FROM produk_keluar WHERE id_produk=$idProduk AND tanggal_keluar>='$tanggalAwal' AND tanggal_keluar<='$tanggalAkhir'";
        $result = mysqli_query($conn, $query); // hasilnya object
        // mengubah data object menjadi array asosiatif
        $allProdukKeluar = [];
        while ($produkKeluar = mysqli_fetch_assoc($result)){
            $allProdukKeluar[] = $produkKeluar;
        }
        return $allProdukKeluar;    
    }

    function selectProdukKeluarBeforeIdByProdukId($id, $idProduk){
        global $conn;
        $query = "SELECT * FROM produk_keluar WHERE id<$id AND id_produk=$idProduk";
        $result = mysqli_query($conn, $query); // hasilnya object
        // mengubah data object menjadi array asosiatif
        $allProdukKeluar = [];
        while ($produkKeluar = mysqli_fetch_assoc($result)){
            $allProdukKeluar[] = $produkKeluar;
        }
        return $allProdukKeluar;    
    }

    function selectProdukKeluarByDate($tanggal){
        global $conn;
        $query = "SELECT * FROM produk_keluar where tanggal_keluar='$tanggal'";
        $result = mysqli_query($conn, $query); // hasilnya object
        $allProduk = [];
        while ($produk = mysqli_fetch_assoc($result)){
            $allProduk[] = $produk;
        }
        return $allProduk;    
    }

?>