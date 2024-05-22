<?php
require_once __DIR__ . '/../inc/db.php';

switch(@$_POST['akce']){
    case 'add':
        addFavorite($_POST['id'], $_POST['nazevSouboru']);
        break;
    case 'remove':
        removeFavorite($_POST['id'], $_POST['nazevSouboru']);
        break;
}

function addFavorite($IdUzivatele, $nazevSouboru) {
    global $db;
    try{
        $stmt = $db->prepare("INSERT INTO favorites (fk_uzivatel, soubor) VALUES (?, ?)");
        $stmt->bind_param("is", $IdUzivatele, $nazevSouboru);
        $stmt->execute();
        $stmt->close();
        echo "200";
    }
    catch(PDOException $e) {
        echo "400";
    }
}

function removeFavorite($IdUzivatele, $nazevSouboru) {
    global $db;
    try{
        $stmt = $db->prepare("DELETE FROM favorites WHERE fk_uzivatel = ? AND soubor = ?");
        $stmt->bind_param("is", $IdUzivatele, $nazevSouboru);
        $stmt->execute();
        $stmt->close();
        echo "200";
    }
    catch(PDOException $e) {
        echo "400";
    }
}

