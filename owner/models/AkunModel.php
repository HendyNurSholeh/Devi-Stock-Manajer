<?php
    $conn = mysqli_connect("localhost", "root", "", "toko_buah"); // koneksi ke database

    function selectAkunById($id){
        global $conn;
        $query = "SELECT * FROM akun WHERE id=$id";
        $result = mysqli_query($conn, $query); // hasilnya object
        // mengubah data object menjadi array asosiatif
        $akun = mysqli_fetch_assoc($result);
        return $akun;    
    }

    function selectAllAkun(){
        global $conn;
        $query = "SELECT * FROM akun WHERE status='aktif'";
        $result = mysqli_query($conn, $query); // hasilnya object
        // mengubah data object menjadi array asosiatif
        $allAkun = [];
        while ($akun = mysqli_fetch_assoc($result)){
            $allAkun[] = $akun;
        }
        return $allAkun;    
    }

    function updateAkunProfil($idAkun, $nama, $email, $noTelp, $alamat){
        global $conn;
        $query = "UPDATE akun SET nama='$nama', email='$email', no_telp='$noTelp', alamat='$alamat' WHERE id=$idAkun";
        mysqli_query($conn, $query);
        $isSuccess = mysqli_affected_rows($conn);
        return $isSuccess;
    } 

?>