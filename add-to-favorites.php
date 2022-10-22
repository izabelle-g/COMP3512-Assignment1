<?php
    session_start();

    // check if session already exists, if not, initialize an empty array
    if( !isset($_SESSION["favorites"]) ){
        $_SESSION["favorites"] = [];
    }

    // retrieve current favorites and resave the modified array to the session
    $favorites = $_SESSION["favorites"];
    
    if( !empty($_GET["name"]) && !empty($_GET[$_GET["name"]]) )
        $str = "name=" . $_GET['name'] . "&" . $_GET['name'] . "=" . $_GET[$_GET['name']];
    else
        $str = "";

    // checks if song is already in favorites
    if( !array_search($_GET["id"], $favorites) ){
        $favorites[] = $_GET["id"];
        $_SESSION["favorites"] = $favorites;

        // re-direct to view favorites
        header("Location: view-favorites.php?$str");
    } else{
        $message = "Song already in favorites";
        header("Location: view-favorites.php?text=$message&$str");
    }
?>