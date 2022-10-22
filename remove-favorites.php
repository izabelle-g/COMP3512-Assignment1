<?php
    session_start();

    if( !empty($_GET['id']) ){
        //remove the single song and resave to sesisons
        $favorites = $_SESSION["favorites"];
        unset($favorites[array_search($_GET["id"], $favorites)]);
        $_SESSION["favorites"] = $favorites;
    } else{
        // Clear all favorites from session
        $_SESSION["favorites"] = [];
    }

    if( !empty($_GET["name"]) && !empty($_GET[$_GET["name"]]) )
        $str = "name=" . $_GET['name'] . "&" . $_GET['name'] . "=" . $_GET[$_GET['name']];
    else
        $str = "";

    // re-direct back to the view favorites page
    header("Location: view-favorites.php?$str");
?>