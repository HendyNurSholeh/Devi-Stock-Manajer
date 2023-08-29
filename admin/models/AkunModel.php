<?php
    $conn = mysqli_connect("localhost", "root", "", "toko_buah"); // koneksi ke database
    
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

    function selectAllAkunAdmin(){
        global $conn;
        $query = "SELECT * FROM akun WHERE level='admin' AND status='aktif'";
        $result = mysqli_query($conn, $query); // hasilnya object
        // mengubah data object menjadi array asosiatif
        $accounts = [];
        while ($akun = mysqli_fetch_assoc($result)){
            $accounts[] = $akun;
        }
        return $accounts;    
    }

    function selectAkunById($id){
        global $conn;
        $query = "SELECT * FROM akun WHERE id=$id";
        $result = mysqli_query($conn, $query); // hasilnya object
        // mengubah data object menjadi array asosiatif
        $akun = mysqli_fetch_assoc($result);
        return $akun;    
    }

    function insertAkun($nama, $level, $username, $password, $status, $waktu_dibuat, $email, $no_telp, $alamat){
        global $conn;
        $query = "INSERT INTO akun(nama, level, username, password, status, waktu_dibuat, email, no_telp, alamat) 
                  VALUES('$nama', '$level', '$username', '$password', '$status', '$waktu_dibuat', '$email', '$no_telp', '$alamat')";
        mysqli_query($conn, $query);
        $isSuccess = mysqli_affected_rows($conn);
        return $isSuccess;
    } 

    function updateAkun($idAkun, $nama, $level, $username, $password, $email, $noTelp, $alamat){
        global $conn;
        $query = "UPDATE akun SET nama='$nama', level='$level', username='$username', password='$password', 
                  email='$email', no_telp='$noTelp', alamat='$alamat' WHERE id=$idAkun";
        mysqli_query($conn, $query);
        $isSuccess = mysqli_affected_rows($conn);
        return $isSuccess;
    } 

    function updateAkunProfil($idAkun, $nama, $email, $noTelp, $alamat){
        global $conn;
        $query = "UPDATE akun SET nama='$nama', email='$email', no_telp='$noTelp', alamat='$alamat' WHERE id=$idAkun";
        mysqli_query($conn, $query);
        $isSuccess = mysqli_affected_rows($conn);
        return $isSuccess;
    } 

    function deleteAkunById($idAkun){
        global $conn;
        $query = "UPDATE akun SET status='tidak aktif' WHERE id=$idAkun";
        mysqli_query($conn, $query);
        $isSuccess = mysqli_affected_rows($conn);
        return $isSuccess;
    }


    
?>