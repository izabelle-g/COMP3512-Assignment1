<?php
    require_once 'includes/config.inc.php';
    require_once 'includes/db-classes.inc.php';
    require_once 'includes/favorites-helper.inc.php';

    session_start();

    if( ! isset($_SESSION["favorites"]) ){
        $_SESSION["favorites"] = [];
    }

    $favorites = $_SESSION["favorites"];

    $conn = DatabaseHelper::createConnection( array(DBCONNSTRING, DBUSER, DBPASS) );
    $songsGateway = new SongsDB($conn);

    // creates a query string containing the filtered search results
    if( !empty($_GET["name"]) && !empty($_GET[$_GET["name"]]) )
        $str = "name=" . $_GET['name'] . "&" . $_GET['name'] . "=" . $_GET[$_GET['name']];
    else
        $str = "";
?>

<!DOCTYPE html>
<html lang=en>
<head>
    <title>Browse/Search Results</title>
    <meta charset=utf-8>
    <!--<link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet">-->
</head>
<body>
    <header>
        <h2>Header</h2>
    </header>

    <main>
        <h2>Favorites</h2>
        <a href='remove-favorites.php?<?=$str?>' class= 'button'>Remove All</a>

        <!--Returns user to filtered search results-->
        <a href='browse-search-result.php?<?=$str?>' class= 'button'>Return to Browse/Result Page</a>

        <article>
            <section>
                <?php
                    // echoes a message saying that the song is already in favorites
                    if( !empty($_GET["text"]) ){
                        echo $_GET["text"]; 
                    }

                    echo "<table>";
                    outputHeader();

                    // output each favorite song
                    foreach($favorites as $fav_id){
                        outputFavorites($songsGateway->getSong($fav_id), $str);
                    }

                    echo "</table>";
                ?>
            </section>
        </article> 
    </main>

    <footer>
        <h2>Footer</h2>
    </footer>
</body>