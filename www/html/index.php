<?php require __DIR__ . '/../inc/header.php';?>
<? require "$INC/nav.php";?>

<h1 class="text-4xl font-bold text-center my-6">Vítejte v Osobním fitness trenérovi</h1>
<p class="text-lg text-gray-700 text-center mb-4">Plánujte a sledujte své cvičební plány snadno a efektivně.</p>
<div class="flex flex-col items-center space-y-3">
    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="addPlan.php">Přidat nový cvičební program</a>
    <a class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" href="workouts.php">Projděte si naše cvičební programy</a>
    <a class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" href="login.php">Nebo se přihlašte aby jste mohli dávat cvičení plány do oblíbených</a>
</div>
<?php
require "$INC/footer.php";
?>