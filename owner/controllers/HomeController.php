<?php 
     require "../models/ProdukKeluarModel.php";
     require "../models/ProdukMasukModel.php";
     require "../models/ProdukModel.php";
     require "../models/AkunModel.php";
     require_once "../utility/functionsUtil.php";

     function getTotalPenjualanToday(){
        $allProdukKeluarToday = selectProdukKeluarByRange(getTanggalToday(), getTanggalToday());
        $totalPenjualan = [
            "totalBuahKg" => 0, 
            "totalFrozenFoodPcs" => 0,
            "totalPendapatan" => 0,    
            "totalKeuntungan" => 0    
        ];

        $totalPenjualan["totalKeuntungan"] = getKeuntunganByDate(getTanggalToday());

        foreach ($allProdukKeluarToday as $produkKeluarToday){
            $produk = selectProdukById($produkKeluarToday["id_produk"]);
            $totalPenjualan["totalPendapatan"] += $produkKeluarToday["harga_terjual"];
            if($produk["kategori"] === "buah"){
                if($produk["satuan"] === "kg"){
                    $totalPenjualan["totalBuahKg"] += $produkKeluarToday["jumlah"];
                }
            } else if ($produk["kategori"] === "frozen food") {
                if($produk["satuan"]==="pcs"){
                    $totalPenjualan["totalFrozenFoodPcs"] += $produkKeluarToday["jumlah"];
                }
            }
        }
        return $totalPenjualan;
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

    function getKeuntunganKategoriByDate($tanggal){
        $allProdukKeluar = selectProdukKeluarByDate($tanggal);
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

    function getProdukTerlaris(){
        $products = selectAllProduk();
        $produkTerlaris = [];
        foreach($products as &$product){
            $jumlahTerjual = 0;
            $allProductKeluar = selectProdukKeluarTodayById($product["id"]); // produk keluar hari ini
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

    function getProdukHabis(){
        $products = selectAllProduk();
        $produkHabis = [];
        foreach($products as $product){
            if($product["stok"] == 0){
                $produkHabis[] = $product;
            }
        }
        return $produkHabis;
    }

    function showStatistikPenjualan(){
        $dataKeuntungan = array();
        $dataKeuntungan[] = ["Tanggal", "Keuntungan"];
        for ($i = 9; $i >= 0; $i--) {
            $date = date("Y-m-d", strtotime("-$i days"));
            $keuntungan = getKeuntunganByDate($date);
            $dataKeuntungan[] = [$date, $keuntungan];
        }
        $chartData = json_encode($dataKeuntungan);
        echo "
        <script type='text/javascript'>
        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(drawKeuntungan);
      
        function drawKeuntungan() {
          var chartData = google.visualization.arrayToDataTable($chartData);
          var options = {
            title: '10 hari terakhir',
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

    function showStatistikKeuntunganKategori(){
        $totalKeuntungan = getKeuntunganKategoriByDate(getTanggalToday());
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