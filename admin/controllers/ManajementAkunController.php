<?php
    require "../models/AkunModel.php";
    require_once "../utility/functionsUtil.php";
    
    function getAllAkun(){
        $accounts = selectAllAkun();
        return $accounts;
    }

    function addAkun($post){
        $accounts = getAllAkun();
        $level = htmlspecialchars(formatHarga($post["level"]));
        $username = htmlspecialchars($post["username"]);
        $password = htmlspecialchars($post["password"]);
        $konfirmasiPassword = htmlspecialchars($post["konfirmasiPassword"]);
        $email = htmlspecialchars($post["email"]);
        $status = "aktif";
        $waktu_dibuat = getTanggalToday();
        $nama = null;
        $noTelp = null;
        $alamat = null;
        for($i=0; $i<count($accounts); $i++){
            if($accounts[$i]["username"] == $username){
                return "duplicateUsername";
            } else if($accounts[$i]["email"] == $email && $email != ""){
                return "duplicateEmail";
            }
        }
        if(!($password === $konfirmasiPassword)){
            return "passwordNotSame";
        } 
        $password = password_hash($password, PASSWORD_DEFAULT); // enkripsi password
        $isSuccess = insertAkun($nama, $level, $username, $password, $status, $waktu_dibuat, $email, $noTelp, $alamat);
        return $isSuccess;
    }

    function editAkun($post){
        $accounts = getAllAkun();
        $idAkun = $post["id_akun"];
        $account = selectAkunById($idAkun);
        $username = htmlspecialchars(strtolower($post["username"]));
        $password = htmlspecialchars($post["password"]);
        $konfirmasiPassword = htmlspecialchars($post["konfirmasiPassword"]);
        $noTelp = htmlspecialchars($post["noTelp"]);
        $email = htmlspecialchars($post["email"]);
        $level = htmlspecialchars($post["level"]);
        $alamat = htmlspecialchars(strtolower($post["alamat"]));
        $nama = null;
        if($level === 'owner' && count(selectAllAkunAdmin()) === 1){
            return "adminKurangDari1";
        } elseif (!preg_match("/^08/", $noTelp) && $noTelp != ""){
            return "invalidNoTelp";
        }
        if(!($password === $konfirmasiPassword)){
            return "passwordNotSame";
        }  else if (empty($password)){
            $password = $account["password"];
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT); // enkripsi password
        }
        for($i=0; $i<count($accounts); $i++){
            if($accounts[$i]["id"] != $idAkun){
                if($accounts[$i]["username"] == $username){
                    return "duplicateUsername";
                } else if($accounts[$i]["email"] == $email && $email != ""){
                    return "duplicateEmail";
                }
            }
        }
        $isSuccess = updateAkun($idAkun, $nama, $level, $username, $password, $email, $noTelp, $alamat);
        return $isSuccess;
    }

    function removeAkun($post){
        $akun = selectAkunById($post["id_akun"]);
        if($akun['level'] === 'admin' && count(selectAllAkunAdmin()) === 1){
            return "adminKurangDari1";
        }
        $isSuccess = deleteAkunById($post["id_akun"]);
        return $isSuccess;
    }
?>