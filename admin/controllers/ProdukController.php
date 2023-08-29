<?php 
    require "../models/ProdukModel.php";
    require "../models/ProdukMasukModel.php";
    require "../models/ProdukKeluarModel.php";
    require_once "../utility/functionsUtil.php";

    function getAllProduk(){
        $allProduk = selectAllProduk();
        return $allProduk;
    }

     function addProdukMasuk($post){
        $idProduk = htmlspecialchars($post["idProduk"]);
        $produk =  selectProdukById($idProduk);
        $hargaBeli = htmlspecialchars(formatHarga($post["harga-beli"]));      
        $jumlah = htmlspecialchars($post["jumlah"]);      
        $tanggal_masuk = htmlspecialchars($post["tanggal-masuk"]);      
        $catatan = htmlspecialchars(strtolower($post["catatan"])); 
        $stokLama = $produk['stok'];
        $stokBaru = $stokLama + $jumlah;
        $isSuccess = updateStokProduk($idProduk, $stokBaru);// mengupdate stok produk
        if($isSuccess){
            // memasukkan data ke history barang masuk
            $isSuccess = insertProdukMasuk($idProduk, 1, $hargaBeli, $jumlah, $tanggal_masuk, $catatan);
            if(!$isSuccess){
                updateStokProduk($idProduk, $stokLama);
            }
        }
        return $isSuccess;     
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
        $isSuccess = updateStokProduk($idProduk, $stokBaru); // mengupdate stok produk
        if($isSuccess){
            // memasukkan data ke history produk masuk
            $isSuccess = insertProdukKeluar($idProduk, 1, $harga, $jumlah, $tanggal_keluar, $catatan);
            if(!$isSuccess){
                updateStokProduk($idProduk, $stokLama);
            }
        }
        return $isSuccess;     
    }

    function addProduk($post, $files){
        $products = selectAllProduk();
        $nama = htmlspecialchars(strtolower($post["nama"]));
        $harga = htmlspecialchars(formatHarga($post["harga"]));
        $kategori = htmlspecialchars($post["kategori"]);
        $satuan = htmlspecialchars($post["satuan"]);
        $deskripsi = htmlspecialchars($post["deskripsi"]);
        if($files["gambar"]["size"] > 2000000){
            return "gambarOversize";
        }
        for($i=0; $i<count($products); $i++){
            if($products[$i]["nama"] == $nama){
                return "duplicateName";
            }
        }
        $namaGambar = uploadGambar($files); // upload gambar
        $isSuccess = insertProduk($nama, $harga, $kategori, $satuan, $namaGambar, $deskripsi);
        return $isSuccess;
    }
    
    function removeProduk($post){
        $isSuccess = deleteProdukById($post["id_produk"]);
        return $isSuccess;
    }

    function editProduk($post, $files){
        $produkDatabase = selectAllProduk();
        $idProduk = htmlspecialchars(strtolower($post["id_produk"]));
        $nama = htmlspecialchars(strtolower($post["nama"]));
        $harga = htmlspecialchars(formatHarga($post["harga"]));
        $gambar = $files["gambar"];
        $satuan = htmlspecialchars($post["satuan"]);
        $kategori = htmlspecialchars($post["kategori"]);
        $deskripsi = htmlspecialchars($post["deskripsi"]);
        $produk = selectProdukById($idProduk);
        if($gambar["error"] === 4){
            $gambar = $produk["gambar"];
        } else if($gambar["size"] > 2000000){
            return "gambarOversize";
        } else {
            $gambar = uploadGambar($files);
            unlink("../../img/".$produk["gambar"]);
        }
        for($i=0; $i<count($produkDatabase); $i++){
            if($produkDatabase[$i]["id"] != $idProduk){
                if($produkDatabase[$i]["nama"] == $nama){
                    return "duplicateName";
                }
            }
        }
        $isSuccess = updateProduk($idProduk, $nama, $harga, $gambar, $kategori, $satuan, $deskripsi);
        return $isSuccess;
    }

    function uploadGambar($files){
        $ekstensiGambar = explode(".", $files["gambar"]["name"]);
        $ekstensiGambar = end($ekstensiGambar);
        $namaGambar = uniqid() . "." . $ekstensiGambar;
        move_uploaded_file($files["gambar"]["tmp_name"], "../../assets/img/".$namaGambar);
        return $namaGambar;
    }

?>