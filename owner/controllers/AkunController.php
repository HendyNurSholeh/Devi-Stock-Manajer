<?php 
    require "../models/AkunModel.php";
    function getAkunById($id_akun){
        $akun = selectAkunById($id_akun);
        return $akun;
    }

    function editAkun($post){
        $accounts = selectAllAkun();
        $idAkun = $post['idAkun'];
        $nama = htmlspecialchars(strtolower($post["nama"]));
        $email = htmlspecialchars($post["email"]);
        $noTelp = htmlspecialchars($post["telepon"]);
        $alamat = htmlspecialchars(strtolower($post["alamat"]));

        if (!preg_match("/^08/", $noTelp) && $noTelp != ""){
            return "invalidNoTelp";
        }

        for($i=0; $i<count($accounts); $i++){
            if($accounts[$i]["id"] != $idAkun){
                if($accounts[$i]["email"] == $email && $email != ""){
                    return "duplicateEmail";
                }
            }
        }

        updateAkunProfil($idAkun, $nama, $email, $noTelp, $alamat);
    }
?>