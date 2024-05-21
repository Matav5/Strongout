<?php
require __DIR__ ."/../inc/dirs.php";
// Zkontrolujte, zda je parametr 'workout' nastaven
if (isset($_GET['workout'])) {
    $workout = $_GET['workout'];
    $filePath = "$WORKOUT/$workout.xml";

    // Zkontrolujte, zda soubor existuje
    if (file_exists($filePath)) {
        // Smažte soubor
        if (unlink($filePath)) {
            // Přesměrujte zpět na stránku s workouty s úspěšnou zprávou
            header("Location: workouts.php?message=Trénink úspěšně smazán");
            exit;
        } else {
            // Přesměrujte zpět na stránku s workouty s chybovou zprávou
            header("Location: workouts.php?error=Nepodařilo se smazat trénink");
            exit;
        }
    } else {
        // Přesměrujte zpět na stránku s workouty s chybovou zprávou
        header("Location: workouts.php?error=Trénink nenalezen");
        exit;
    }
} else {
    // Přesměrujte zpět na stránku s workouty s chybovou zprávou
    header("Location: workouts.php?error=Nebyl specifikován žádný trénink");
    exit;
}