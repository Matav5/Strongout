<?php session_start() ?>
<?php
include "dirs.php";
$prezdivka = @$_SESSION['prezdivka'];
$jePrihlaseny = isset($_SESSION['prezdivka'])

?>


<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strongout</title>
    <link rel="stylesheet" href="<?=$CSS?>/style.css">
    <script src="<?=$JS?>/script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
