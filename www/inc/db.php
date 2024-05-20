<?php
    $db = mysqli_connect("database","admin","heslo","strongout") or die("Nelze se připojit k databázi");

    function ziskej_uziv($email){
        global $db;
        $user = $db->query("SELECT * FROM uzivatele WHERE email = '$email'")->fetch_object();
        return $user;
    }
    function uloz_uziv( $email, $prezdivka, $heslo ){
        global $db;
        $hashovaneHeslo = password_hash($heslo, PASSWORD_BCRYPT);
        $db->query("INSERT INTO uzivatele (email, prezdivka, heslo) VALUES ('$email', '$prezdivka', '$hashovaneHeslo')");
    }

