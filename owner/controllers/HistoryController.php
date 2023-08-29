<?php
    require "../models/ProdukKeluarModel.php";
    require "../models/ProdukMasukModel.php";
    require "../models/ProdukModel.php";
    require "../models/AkunModel.php";

    function getProdukKeluarByRange($tanggal_awal, $tanggal_akhir){
        $produkKeluarByRange = selectProdukKeluarByRange($tanggal_awal, $tanggal_akhir);
        for ($i=0; $i<count($produkKeluarByRange); $i++ ){
            $produk = selectProdukById($produkKeluarByRange[$i]["id_produk"]);
            $admin = selectAkunById($produkKeluarByRange[$i]["id_akun"]);
            $produkKeluarByRange[$i]["nama_produk"] = $produk["nama"]; // memasukkan nama produk
            $produkKeluarByRange[$i]["gambar_produk"] = $produk["gambar"]; // memasukkan gambar produk
            $produkKeluarByRange[$i]["kategori"] = $produk["kategori"]; // memasukkan kategori
            $produkKeluarByRange[$i]["satuan"] = $produk["satuan"]; // memasukkan satuan
            $produkKeluarByRange[$i]["username_admin"] = $admin["username"]; // memasukkan username admin
        }
        return $produkKeluarByRange;
    }
    
    function getProdukMasukByRange($tanggal_awal, $tanggal_akhir){
        $produkMasukByRange = selectProdukMasukByRange($tanggal_awal, $tanggal_akhir);
        for ($i=0; $i<count($produkMasukByRange); $i++ ){
            $produk = selectProdukById($produkMasukByRange[$i]["id_produk"]);
            $admin = selectAkunById($produkMasukByRange[$i]["id_akun"]);
            $produkMasukByRange[$i]["nama_produk"] = $produk["nama"]; // memasukkan nama produk
            $produkMasukByRange[$i]["gambar_produk"] = $produk["gambar"]; // memasukkan nama produk
            $produkMasukByRange[$i]["kategori"] = $produk["kategori"]; // memasukkan kategori
            $produkMasukByRange[$i]["satuan"] = $produk["satuan"]; // memasukkan satuan
            $produkMasukByRange[$i]["username_admin"] = $admin["username"]; // memasukkan username admin
        }
        return $produkMasukByRange;
    }

    function getTotalPenjualanByRange($tanggal_awal, $tanggal_akhir){
        $allProdukKeluarByRange = getProdukKeluarByRange($tanggal_awal, $tanggal_akhir);
        $totalPenjualan = [
            "totalBuahKg" => 0, 
            "totalBuahBiji" => 0, 
            "totalBuahPcs" => 0, 
            "totalFrozenFoodPcs" => 0,
            "totalFrozenFoodKg" => 0,
            "totalFrozenFoodBiji" => 0,
            "totalHargaPenjualan" => 0    
        ];
        foreach ($allProdukKeluarByRange as $produkKeluarByRange){
            $totalPenjualan["totalHargaPenjualan"] += $produkKeluarByRange["harga_terjual"];
            if($produkKeluarByRange["kategori"] === "buah"){
                if($produkKeluarByRange["satuan"] === "kg"){
                    $totalPenjualan["totalBuahKg"] += $produkKeluarByRange["jumlah"];
                } else if($produkKeluarByRange["satuan"] === "biji"){
                    $totalPenjualan["totalBuahBiji"] += $produkKeluarByRange["jumlah"];
                } else{
                    $totalPenjualan["totalBuahPcs"] += $produkKeluarByRange["jumlah"];
                }
            } else if ($produkKeluarByRange["kategori"] === "frozen food") {
                if($produkKeluarByRange["satuan"]==="kg"){
                    $totalPenjualan["totalFrozenFoodKg"] += $produkKeluarByRange["jumlah"];
                }else if($produkKeluarByRange["satuan"]==="biji"){
                    $totalPenjualan["totalFrozenFoodBiji"] += $produkKeluarByRange["jumlah"];
                } else {
                    $totalPenjualan["totalFrozenFoodPcs"] += $produkKeluarByRange["jumlah"];
                }
            }
        }
        return $totalPenjualan;
    }

    function getTotalProdukMasukByRange($tanggal_awal, $tanggal_akhir){
        $allProdukMasukByRange = getProdukMasukByRange($tanggal_awal, $tanggal_akhir);
        $totalProdukMasuk = [
            "totalBuahKg" => 0, 
            "totalBuahBiji" => 0,
            "totalBuahPcs" => 0, 
            "totalFrozenFoodPcs" => 0,
            "totalFrozenFoodKg" => 0,
            "totalFrozenFoodBiji" => 0,
            "totalHargaBeli" => 0    
        ];
        foreach ($allProdukMasukByRange as $produkMasukByRange){
            $totalProdukMasuk["totalHargaBeli"] += $produkMasukByRange["harga_beli"];
            if($produkMasukByRange["kategori"] == "buah"){
                if($produkMasukByRange["satuan"] == "kg"){
                    $totalProdukMasuk["totalBuahKg"] += $produkMasukByRange["jumlah"];
                } else if($produkMasukByRange["satuan"] === "biji"){
                    $totalProdukMasuk["totalBuahBiji"] += $produkMasukByRange["jumlah"];
                } else{
                    $totalProdukMasuk["totalBuahPcs"] += $produkMasukByRange["jumlah"];
                }
            } else if($produkMasukByRange["kategori"] === "frozen food") {
                if($produkMasukByRange["satuan"]==="kg"){
                    $totalProdukMasuk["totalFrozenFoodKg"] += $produkMasukByRange["jumlah"];
                }else if($produkMasukByRange["satuan"]==="biji"){
                    $totalProdukMasuk["totalFrozenFoodBiji"] += $produkMasukByRange["jumlah"];
                } else {
                    $totalProdukMasuk["totalFrozenFoodPcs"] += $produkMasukByRange["jumlah"];
                }
            }
        }
        return $totalProdukMasuk;
    }
?>