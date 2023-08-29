<?php 
    function getTanggalToday(){
        date_default_timezone_set('Asia/Makassar'); // set time zone WITA
        return date('Y-m-d'); // mengambil tanggal hari ini
    }

    function getTodayFormatted(){
        $hari = array('Sunday' => 'Minggu','Monday' => 'Senin','Tuesday' => 'Selasa','Wednesday' => 'Rabu','Thursday' => 'Kamis','Friday' => 'Jumat', 'Saturday' => 'Sabtu');
        $bulan = array('January' => 'Januari','February' => 'Februari','March' => 'Maret','April' => 'April','May' => 'Mei','June' => 'Juni','July' => 'Juli','August' => 'Agustus','September' => 'September','October' => 'Oktober','November' => 'November','December' => 'Desember');
        date_default_timezone_set('Asia/Makassar');
        $tanggal = date('j F Y');
        $namaHari = date('l');
        $namaHariIndonesia = $hari[$namaHari];
        $bulanIndonesia = $bulan[date('F', strtotime($tanggal))];
        return $namaHariIndonesia . ', ' . date('j') . ' ' . $bulanIndonesia . ' ' . date('Y'); // mengambil tanggal hari ini dengan format Selasa, 26 April 2023
    }
    
    function convertDateFormatted($tanggal){
        $hari = array('Sunday' => 'Minggu','Monday' => 'Senin','Tuesday' => 'Selasa','Wednesday' => 'Rabu','Thursday' => 'Kamis','Friday' => 'Jumat', 'Saturday' => 'Sabtu');
        $bulan = array('January' => 'Januari','February' => 'Februari','March' => 'Maret','April' => 'April','May' => 'Mei','June' => 'Juni','July' => 'Juli','August' => 'Agustus','September' => 'September','October' => 'Oktober','November' => 'November','December' => 'Desember');
        $tanggal = date_create_from_format('Y-m-d', $tanggal); // Mengubah format tanggal menjadi DateTime object
        $namaHari = date_format($tanggal, 'l'); // Mengambil nama hari dalam bahasa Inggris
        $namaHariIndonesia = $hari[$namaHari]; // Mengonversi nama hari menjadi bahasa Indonesia
        $bulanIndonesia = $bulan[date_format($tanggal, 'F')]; // Mengambil nama bulan dalam bahasa Indonesia
        $tanggalIndonesia = date_format($tanggal, 'j'); // Mengambil tanggal tanpa leading zero
        $tahun = date_format($tanggal, 'Y'); // Mengambil tahun
        $tanggalFormatIndonesia = $namaHariIndonesia . ', ' . $tanggalIndonesia . ' ' . $bulanIndonesia . ' ' . $tahun; // Menggabungkan semua komponen menjadi format tanggal yang diinginkan
        return $tanggalFormatIndonesia; // Mengembalikan tanggal dalam format "Sabtu, 8 Mei 2023"        
    }

    function convertTanggaldmy($date){
        return date('d/m/Y', strtotime($date));
    }

    function formatNumber($angka){
        if ($angka == (int)$angka) {
            return $angka = number_format($angka, 0, ',', '.');
        } else {
            $angka = number_format($angka, 2, ',', '.');
            return rtrim(rtrim($angka, '0'), ',');
        }      
    }

    function formatHarga($harga){
        $decimal_pos = strpos($harga, ".");
        if ($decimal_pos !== false && strlen(substr($harga, $decimal_pos + 1)) >= 3) {
            // jika ada tanda titik dan ada 3 angka nol di belakangnya
            $harga = str_replace(".", "", $harga); // hilangkan tanda titik
        }
        return $harga; 
    }

    function ifEmptyStrip($value){
        if(empty($value)){
            return "-";
        } else {
            return $value;
        }
    }

    function alertSuccess($text){
    return "
    <div id='success-alert' class='alert alert-success rounded-5 position-fixed top-50 start-50 translate-middle z-3 px-5 py-3 d-none' role='alert'>
        $text
    </div>
    <script>
        document.querySelector('#success-alert').classList.remove('d-none');
        setTimeout(function() {
        document.querySelector('#success-alert').classList.add('d-none');
      }, 1500);
    </script>";
    }

    function alertFailed($text){
        return "
        <div id='failed-alert' class='alert alert-danger rounded-5 position-fixed top-50 start-50 translate-middle z-3 px-5 py-3 d-none' role='alert'>
            $text
        </div>
        <script>
            document.querySelector('#failed-alert').classList.remove('d-none');
            setTimeout(function() {
            document.querySelector('#failed-alert').classList.add('d-none');
          }, 1500);
        </script>";
    }
?>