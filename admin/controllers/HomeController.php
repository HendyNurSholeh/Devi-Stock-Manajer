<?php
    require "../models/ProdukModel.php";
    require "../models/ProdukMasukModel.php";
    require "../models/ProdukKeluarModel.php";
    require "../models/AkunModel.php";

    function getAllProduk(){
        $allProduk = selectAllProduk();
        return $allProduk;
    }

    function getAllProdukKeluar(){
        $allProduk = selectAllProdukKeluar();
        return $allProduk;
    }

    function getProdukKeluarToday(){
        $produkKeluarToday = selectProdukKeluarToday();
        for ($i=0; $i<count($produkKeluarToday); $i++ ){
            $produk = selectProdukById($produkKeluarToday[$i]["id_produk"]);
            $akun = selectAkunById($produkKeluarToday[$i]["id_akun"]);
            $produkKeluarToday[$i]["nama_produk"] = $produk["nama"]; // memasukkan nama produk
            $produkKeluarToday[$i]["kategori"] = $produk["kategori"]; // memasukkan kategori
            $produkKeluarToday[$i]["gambar"] = $produk["gambar"]; // memasukkan kategori
            $produkKeluarToday[$i]["satuan"] = $produk["satuan"]; // memasukkan satuan
            $produkKeluarToday[$i]["username_admin"] = $akun["username"]; // memasukkan satuan
        }
        return $produkKeluarToday;
    }

     function getProdukMasukToday(){
        $produkMasukToday = selectProdukMasukToday();
        for ($i=0; $i<count($produkMasukToday); $i++ ){
            $produk = selectProdukById($produkMasukToday[$i]["id_produk"]);
            $produkMasukToday[$i]["nama_produk"] = $produk["nama"]; // memasukkan nama produk
        }
        return $produkMasukToday;
    }

    function addProdukKeluar($post){
        $idProduk = htmlspecialchars($post["idProduk"]);
        $produk =  selectProdukById($idProduk);
        $harga = htmlspecialchars(formatHarga($post["harga-terjual"]));      
        $jumlah = htmlspecialchars($post["jumlah"]);      
        $tanggal_keluar = htmlspecialchars($post["tanggal-keluar"]);      
        $catatan = htmlspecialchars(strtolower($post["catatan"])); 
        $stokLama = $produk['stok'];
        $stokBaru = $stokLama - $jumlah;
        if($stokBaru < 0){
            return "stokMinus";
        }
        $isSuccess = updateStokProduk($idProduk, $stokBaru);// mengupdate stok produk
        if($isSuccess){
            // memasukkan data ke history barang masuk
            $isSuccess = insertProdukKeluar($idProduk, 1, $harga, $jumlah, $tanggal_keluar, $catatan);
            if(!$isSuccess){
                updateStokProduk($idProduk, $stokLama);
            }
        }
        return $isSuccess;     
    }

    function getPendapatanToday(){
        $pendapatan = 0;
        $produkKeluarToday = selectProdukKeluarToday();
        for ($i=0; $i<count($produkKeluarToday); $i++){
            $pendapatan += $produkKeluarToday[$i]["harga_terjual"];
        }
        return $pendapatan;
    }
?>