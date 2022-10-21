<?php
    session_start();

    if(! empty($_GET['id']) ){
        $favorites = $_SESSION["favorites"];
        
        // remove the single song
        unset($favorites[array_search($_GET["id"], $favorites)]);

        // resave to the sessions
        $_SESSION["favorites"] = $favorites;
    } else{
        // Clear all favorites from session
        $_SESSION["favorites"] = [];
    }

    // re-direct back to the view favorites page
    header("Location: view-favorites.php");
?>