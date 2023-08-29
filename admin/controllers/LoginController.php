<?php 
    require "../models/AkunModel.php";
    function isSuccessLogin($username, $password){
        $accounts = selectAllAkun();
        foreach($accounts as $account){
            if($username === $account["username"] || $username === $account["email"]){
                if(password_verify($password, $account["password"])){
                    if($account["level"] === "admin"){
                        $_SESSION["loginAdmin"] = true;
                        $_SESSION["idAkun"] = $account["id"];
                        header("Location: ../views/home.php");
                        return "success";
                    } 
                    $_SESSION["loginOwner"] = true;
                    $_SESSION["idAkun"] = $account["id"];
                    header("Location: ../../owner/views/home.php");
                    return "success";
                } else{
                    return "invalidPassword";
                }
            }
        }
        return 'invalidUsername';
    }
?>