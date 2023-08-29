<?php 
     require "../models/ProdukKeluarModel.php";
     require "../models/ProdukMasukModel.php";
     require "../models/ProdukModel.php";
     require "../models/AkunModel.php";
     require_once "../utility/functionsUtil.php";

     function getTotalPenjualanByRange($tanggalAwal, $tanggalAkhir){
        $allProdukKeluar = selectProdukKeluarByRange($tanggalAwal, $tanggalAkhir);
        $totalPenjualan = [
            "totalBuahKg" => 0, 
            "totalFrozenFoodPcs" => 0,
            "totalPendapatan" => 0,    
            "totalKeuntungan" => 0    
        ];

        $totalPenjualan["totalKeuntungan"] = getKeuntunganByRange($tanggalAwal, $tanggalAkhir);

        foreach ($allProdukKeluar as $produkKeluar){
            $produk = selectProdukById($produkKeluar["id_produk"]);
            $totalPenjualan["totalPendapatan"] += $produkKeluar["harga_terjual"];
            if($produk["kategori"] === "buah"){
                if($produk["satuan"] === "kg"){
                    $totalPenjualan["totalBuahKg"] += $produkKeluar["jumlah"];
                }
            } else if ($produk["kategori"] === "frozen food") {
                if($produk["satuan"]==="pcs"){
                    $totalPenjualan["totalFrozenFoodPcs"] += $produkKeluar["jumlah"];
                }
            }
        }
        return $totalPenjualan;
    }

        function getKeuntunganByRange($tanggalAwal, $tanggalAkhir){
            $allProdukKeluar = selectProdukKeluarByRange($tanggalAwal, $tanggalAkhir);
            $totalKeuntungan = 0;
            foreach($allProdukKeluar as $produkKeluar){ // semua produk di loop
                $allProdukMasukById = selectProdukMasukById($produkKeluar["id_produk"]);
                $jumlahKgProdukMasukBefore = 0;
                $jumlahKgProdukMasuk = 0;
                $jumlahKgTerjualBeforeId = 0;
                $allProdukKeluarBeforeId = selectProdukKeluarBeforeIdByProdukId($produkKeluar["id"], $produkKeluar["id_produk"]);
                foreach($allProdukKeluarBeforeId as $produkKeluarBeforeId){ // untuk mengetahui jumlah produk keluar sebelumnya
                    $jumlahKgTerjualBeforeId += $produkKeluarBeforeId["jumlah"]; 
                }
                for($i=0; $i < count($allProdukMasukById); $i++){ // untuk mmangetahui memakai modal produk masuk yg mna
                    $jumlahKgProdukMasuk += $allProdukMasukById[$i]["jumlah"];
                    $modalPerKg = $allProdukMasukById[$i]["harga_beli"] / $allProdukMasukById[$i]["jumlah"];
                    $modalProduk = $modalPerKg * $produkKeluar["jumlah"];
                    if($jumlahKgTerjualBeforeId >= $jumlahKgProdukMasukBefore && $jumlahKgTerjualBeforeId < $jumlahKgProdukMasuk){ // di cek agar agar mengetahui produk masuk yang dipilih
                        if(($jumlahKgTerjualBeforeId + $produkKeluar["jumlah"]) > $jumlahKgProdukMasuk && $jumlahKgTerjualBeforeId < $jumlahKgProdukMasuk) { // 
                            $modalPerKgAfter = $allProdukMasukById[$i+1]["harga_beli"] / $allProdukMasukById[$i+1]["jumlah"];
                            $modalAfter = ($jumlahKgTerjualBeforeId + $produkKeluar["jumlah"] - $jumlahKgProdukMasuk) * $modalPerKgAfter ;
                            $modalBefore = ($jumlahKgProdukMasuk - $jumlahKgTerjualBeforeId) * $modalPerKg;
                            $totalKeuntungan += $produkKeluar["harga_terjual"] - ($modalAfter + $modalBefore);
                        } else {
                            $totalKeuntungan += $produkKeluar["harga_terjual"] - $modalProduk;
                        }
                    }
                    $jumlahKgProdukMasukBefore += $allProdukMasukById[$i]["jumlah"]; 
                }
            }
            return $totalKeuntungan;
        }

    function getKeuntunganKategoriByRange($tanggalAwal, $tanggalAkhir){
        $allProdukKeluar = selectProdukKeluarByRange($tanggalAwal, $tanggalAkhir);
        foreach($allProdukKeluar as &$productKeluar){
            $product = selectProdukById($productKeluar["id_produk"]);
            $productKeluar["kategori"] = $product["kategori"];
        }
        $totalKeuntungan = [
            "buah" => 0,
            "frozen food" => 0,
            "lainnya" => 0
        ];
        foreach($allProdukKeluar as $produkKeluar){ // semua produk di loop
            $allProdukMasukById = selectProdukMasukById($produkKeluar["id_produk"]);
            $jumlahKgProdukMasukBefore = 0;
            $jumlahKgProdukMasuk = 0;
            $jumlahKgTerjualBeforeId = 0;
            $allProdukKeluarBeforeId = selectProdukKeluarBeforeIdByProdukId($produkKeluar["id"], $produkKeluar["id_produk"]);
            foreach($allProdukKeluarBeforeId as $produkKeluarBeforeId){ // untuk mengetahui jumlah produk keluar sebelumnya
                $jumlahKgTerjualBeforeId += $produkKeluarBeforeId["jumlah"]; 
            }
            for($i=0; $i < count($allProdukMasukById); $i++){ // untuk mmangetahui memakai modal produk masuk yg mna
                $jumlahKgProdukMasuk += $allProdukMasukById[$i]["jumlah"];
                $modalPerKg = $allProdukMasukById[$i]["harga_beli"] / $allProdukMasukById[$i]["jumlah"];
                $modalProduk = $modalPerKg * $produkKeluar["jumlah"];
                if($jumlahKgTerjualBeforeId >= $jumlahKgProdukMasukBefore && $jumlahKgTerjualBeforeId < $jumlahKgProdukMasuk){ // di cek agar agar mengetahui produk masuk yang dipilih
                    if(($jumlahKgTerjualBeforeId + $produkKeluar["jumlah"]) > $jumlahKgProdukMasuk && $jumlahKgTerjualBeforeId < $jumlahKgProdukMasuk) { // 
                        $modalPerKgAfter = $allProdukMasukById[$i+1]["harga_beli"] / $allProdukMasukById[$i+1]["jumlah"];
                        $modalAfter = ($jumlahKgTerjualBeforeId + $produkKeluar["jumlah"] - $jumlahKgProdukMasuk) * $modalPerKgAfter ;
                        $modalBefore = ($jumlahKgProdukMasuk - $jumlahKgTerjualBeforeId) * $modalPerKg;
                        if($produkKeluar["kategori"] == "buah"){
                            $totalKeuntungan["buah"] += $produkKeluar["harga_terjual"] - ($modalAfter + $modalBefore);
                        } elseif ($produkKeluar["kategori"] == "frozen food"){
                            $totalKeuntungan["frozen food"] += $produkKeluar["harga_terjual"] - ($modalAfter + $modalBefore);
                        } else {
                            $totalKeuntungan["lainnya"] += $produkKeluar["harga_terjual"] - ($modalAfter + $modalBefore);
                        }
                    } else {
                        if($produkKeluar["kategori"] == "buah"){
                            $totalKeuntungan["buah"] += $produkKeluar["harga_terjual"] - $modalProduk;
                        } elseif ($produkKeluar["kategori"] == "frozen food"){
                            $totalKeuntungan["frozen food"] += $produkKeluar["harga_terjual"] - $modalProduk;
                        } else {
                            $totalKeuntungan["lainnya"] += $produkKeluar["harga_terjual"] - $modalProduk;
                        }
                    }
                }
                $jumlahKgProdukMasukBefore += $allProdukMasukById[$i]["jumlah"]; 
            }
        }
        return $totalKeuntungan;
    }

    function getKeuntunganByDate($tanggal){
        $allProdukKeluar = selectProdukKeluarByDate($tanggal);
        $totalKeuntungan = 0;
        foreach($allProdukKeluar as $produkKeluar){ // semua produk di loop
            $allProdukMasukById = selectProdukMasukById($produkKeluar["id_produk"]);
            $jumlahKgProdukMasukBefore = 0;
            $jumlahKgProdukMasuk = 0;
            $jumlahKgTerjualBeforeId = 0;
            $allProdukKeluarBeforeId = selectProdukKeluarBeforeIdByProdukId($produkKeluar["id"], $produkKeluar["id_produk"]);
            foreach($allProdukKeluarBeforeId as $produkKeluarBeforeId){ // untuk mengetahui jumlah produk keluar sebelumnya
                $jumlahKgTerjualBeforeId += $produkKeluarBeforeId["jumlah"]; 
            }
            for($i=0; $i < count($allProdukMasukById); $i++){ // untuk mmangetahui memakai modal produk masuk yg mna
                $jumlahKgProdukMasuk += $allProdukMasukById[$i]["jumlah"];
                $modalPerKg = $allProdukMasukById[$i]["harga_beli"] / $allProdukMasukById[$i]["jumlah"];
                $modalProduk = $modalPerKg * $produkKeluar["jumlah"];
                if($jumlahKgTerjualBeforeId >= $jumlahKgProdukMasukBefore && $jumlahKgTerjualBeforeId < $jumlahKgProdukMasuk){ // di cek agar agar mengetahui produk masuk yang dipilih
                    if(($jumlahKgTerjualBeforeId + $produkKeluar["jumlah"]) > $jumlahKgProdukMasuk && $jumlahKgTerjualBeforeId < $jumlahKgProdukMasuk) { // 
                        $modalPerKgAfter = $allProdukMasukById[$i+1]["harga_beli"] / $allProdukMasukById[$i+1]["jumlah"];
                        $modalAfter = ($jumlahKgTerjualBeforeId + $produkKeluar["jumlah"] - $jumlahKgProdukMasuk) * $modalPerKgAfter ;
                        $modalBefore = ($jumlahKgProdukMasuk - $jumlahKgTerjualBeforeId) * $modalPerKg;
                        $totalKeuntungan += $produkKeluar["harga_terjual"] - ($modalAfter + $modalBefore);
                    } else {
                        $totalKeuntungan += $produkKeluar["harga_terjual"] - $modalProduk;
                    }
                }
                $jumlahKgProdukMasukBefore += $allProdukMasukById[$i]["jumlah"]; 
            }
        }
        return $totalKeuntungan;
    }

    function getProdukTerlarisByRange($tanggalAwal, $tanggalAkhir){
        $products = selectAllProduk();
        $produkTerlaris = [];
        foreach($products as &$product){
            $jumlahTerjual = 0;
            $allProductKeluar = selectProdukKeluarRangeById($product["id"], $tanggalAwal, $tanggalAkhir); // produk keluar hari ini
            foreach($allProductKeluar as $productKeluar){
                $jumlahTerjual += $productKeluar["jumlah"];
            }
            $product["jumlahTerjual"] = $jumlahTerjual;
            if(!$product["jumlahTerjual"] == 0){
                $produkTerlaris[] = $product;       
            }
        }
        usort($produkTerlaris, function($productA, $productB) {
            if ($productA["jumlahTerjual"] == $productB["jumlahTerjual"]) {
                return 0;
            }
            return ($productA["jumlahTerjual"] > $productB["jumlahTerjual"]) ? -1 : 1;
        });
        return $produkTerlaris;
    }

    function getProdukPalingMenguntungkanByRange($tanggalAwal, $tanggalAkhir){
        $allProdukKeluar = selectProdukKeluarByRange($tanggalAwal, $tanggalAkhir);
        $produkMenguntungkan = [];
        foreach($allProdukKeluar as $produkKeluar){ // semua produk di loop
            $allProdukMasukById = selectProdukMasukById($produkKeluar["id_produk"]);
            $jumlahKgProdukMasukBefore = 0;
            $jumlahKgProdukMasuk = 0;
            $jumlahKgTerjualBeforeId = 0;
            $allProdukKeluarBeforeId = selectProdukKeluarBeforeIdByProdukId($produkKeluar["id"], $produkKeluar["id_produk"]);
            foreach($allProdukKeluarBeforeId as $produkKeluarBeforeId){ // untuk mengetahui jumlah produk keluar sebelumnya
                $jumlahKgTerjualBeforeId += $produkKeluarBeforeId["jumlah"]; 
            }
            for($i=0; $i < count($allProdukMasukById); $i++){ // untuk mmangetahui memakai modal produk masuk yg mna
                $keuntungan = 0;
                $jumlahKgProdukMasuk += $allProdukMasukById[$i]["jumlah"];
                $modalPerKg = $allProdukMasukById[$i]["harga_beli"] / $allProdukMasukById[$i]["jumlah"];
                $modalProduk = $modalPerKg * $produkKeluar["jumlah"];
                if($jumlahKgTerjualBeforeId >= $jumlahKgProdukMasukBefore && $jumlahKgTerjualBeforeId < $jumlahKgProdukMasuk){ // di cek agar agar mengetahui produk masuk yang dipilih
                    if(($jumlahKgTerjualBeforeId + $produkKeluar["jumlah"]) > $jumlahKgProdukMasuk && $jumlahKgTerjualBeforeId < $jumlahKgProdukMasuk) { // 
                        $modalPerKgAfter = $allProdukMasukById[$i+1]["harga_beli"] / $allProdukMasukById[$i+1]["jumlah"];
                        $modalAfter = ($jumlahKgTerjualBeforeId + $produkKeluar["jumlah"] - $jumlahKgProdukMasuk) * $modalPerKgAfter ;
                        $modalBefore = ($jumlahKgProdukMasuk - $jumlahKgTerjualBeforeId) * $modalPerKg;
                        $keuntungan += $produkKeluar["harga_terjual"] - ($modalAfter + $modalBefore);
                        $produk = selectProdukById($produkKeluar['id_produk']);
                        $produk["keuntungan"] = $keuntungan;
                        if (isset($produkMenguntungkan[$produkKeluar['id_produk']])) {
                            $produkMenguntungkan[$produkKeluar['id_produk']]['keuntungan'] += $keuntungan; 
                        }else {
                            $produkMenguntungkan[$produkKeluar['id_produk']] = $produk;
                        }
                    } else {
                        $keuntungan += $produkKeluar["harga_terjual"] - $modalProduk;
                        $produk = selectProdukById($produkKeluar['id_produk']);
                        $produk["keuntungan"] = $keuntungan;
                        if (isset($produkMenguntungkan[$produkKeluar['id_produk']])) {
                            $produkMenguntungkan[$produkKeluar['id_produk']]['keuntungan'] += $keuntungan; 
                        }else {
                            $produkMenguntungkan[$produkKeluar['id_produk']] = $produk;
                        }
                    }
                }
                $jumlahKgProdukMasukBefore += $allProdukMasukById[$i]["jumlah"]; 
            }
        }
        usort($produkMenguntungkan, function($a, $b) {
            return $b['keuntungan'] - $a['keuntungan'];
        });
        return $produkMenguntungkan;
    }

    function showStatistikPenjualan($tanggalAwal, $tanggalAkhir){
        $dataKeuntungan = array();
        $dataKeuntungan[] = ["Tanggal", "Keuntungan"];
    
        // Mengonversi tanggal awal dan akhir ke format yang sesuai dengan sumber data Anda
        $tanggalAwal = date('y-m-d', strtotime($tanggalAwal));
        $tanggalAkhir = date('y-m-d', strtotime($tanggalAkhir));
    
        // Menghitung jumlah hari antara tanggal awal dan akhir
        $jumlahHari = round((strtotime($tanggalAkhir) - strtotime($tanggalAwal)) / (60 * 60 * 24));
    
        // Menghitung interval antara dua tanggal
        $interval = max(1, ceil($jumlahHari / 20));
    
        // Mengambil data keuntungan berdasarkan rentang tanggal dengan interval yang ditentukan
        $currentDate = $tanggalAwal;
        while ($currentDate < $tanggalAkhir) {
            $keuntungan = getKeuntunganByDate($currentDate);
            $dataKeuntungan[] = [date('d-m-y', strtotime($currentDate)), $keuntungan];
            $currentDate = date('y-m-d', strtotime($currentDate . ' +'.$interval.' days'));
        }
    
        // Menambahkan data tanggal akhir secara eksplisit
        $keuntungan = getKeuntunganByDate($tanggalAkhir);
        $dataKeuntungan[] = [date('d-m-y', strtotime($tanggalAkhir)), $keuntungan];
    
        $chartData = json_encode($dataKeuntungan);
        echo "
        <script type='text/javascript'>
        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(drawKeuntungan);
    
        function drawKeuntungan() {
            var chartData = google.visualization.arrayToDataTable($chartData);
            var options = {
                title: 'Statistik Penjualan',
                curveType: 'function',
                legend: { position: 'bottom' },
                hAxis: { textStyle: { fontSize: 10 } },
                chartArea: { top: 20, bottom: 50 },
                titlePosition: 'out',   
                titleTextStyle: { color: 'black', opacity: '0.6', fontSize: 12 },
            };
            var chart = new google.visualization.LineChart(document.getElementById('st-keuntungan-penjualan'));
            chart.draw(chartData, options);
        }
        </script>
        ";
    }
    
    
    

    function showStatistikKeuntunganKategori($tanggalAwal, $tanggalAkhir){
        $totalKeuntungan = getKeuntunganKategoriByRange($tanggalAwal, $tanggalAkhir);
        $dataKeuntungan = array(
            array('Category', 'Profit'),
            array('Buah', $totalKeuntungan["buah"]),
            array('F.Food', $totalKeuntungan["frozen food"]),
            array('Lainnya', $totalKeuntungan["lainnya"])
        );
        $jsonData = json_encode($dataKeuntungan); // Mengonversi data ke format JSON
        echo "<script>
        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(drawTotalKeuntungan);
        function drawTotalKeuntungan() {
            var dataTotalKeuntungan = google.visualization.arrayToDataTable($jsonData);
            var pengaturan = {
                title: 'Persentase: ',
                pieHole: 0.4,
                slices: {
                    0: { color: '#ff7f50' },
                    1: { color: '#90ee90' },
                    2: { color: '#4682b4' },
                },
                legend: { position: 'bottom', alignment: 'center' },
                chartArea: { width: '65%', height: '65%' },
            };
            var statistik = new google.visualization.PieChart(document.getElementById('st-total-keuntungan'));
            statistik.draw(dataTotalKeuntungan, pengaturan);
        }
        </script>";
    }

?>