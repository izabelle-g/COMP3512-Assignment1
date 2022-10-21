<?php
    session_start();

    // check if session already exists, if not, initialize an empty array
    if( !isset($_SESSION["favorites"]) ){
        $_SESSION["favorites"] = [];
    }

    // retrieve current favorites and resave the modified array to the session
    $favorites = $_SESSION["favorites"];
    $favorites[] = $_GET["id"];
    $_SESSION["favorites"] = $favorites;

    // re-direct to view favorites
    header('Location: view-favorites.php');
?>