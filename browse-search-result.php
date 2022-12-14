<?php
    require_once 'includes/config.inc.php';
    require_once 'includes/db-classes.inc.php';
    require_once 'includes/browse-helper.inc.php';

    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
        $songsGateway = new SongsDB($conn);
        $artistGateway = new ArtistsDB($conn);
        $genreGateway = new GenresDB($conn);

        $name="";

        if( !empty($_GET['title']) ){
            $songs = $songsGateway->getAllWithTitle($_GET['title']);
            $message = "Showing all songs with '" . $_GET['title'] . "' in Title";
            $name = "title";
        }
        else if( !empty($_GET['artistList']) && $_GET['artistList'] > 0){
            $artist_data = $artistGateway->getArtist($_GET['artistList']);
            $songs = $songsGateway->getAllForArtist($artist_data[0]['artist_name']);
            $message = "Showing all songs by " . $artist_data[0]['artist_name'];
            $name = "artistList";
        }
        else if( !empty($_GET['genreList']) && $_GET['genreList'] > 0 ){
            $genre_data = $genreGateway->getGenre($_GET['genreList']);
            $songs = $songsGateway->getAllForGenre($genre_data[0]['genre_name']);
            $message = "Showing all " . $genre_data[0]['genre_name'] . " songs in Genre";
            $name = "genreList";
        }
        else if( !empty($_GET['year-before-value']) ){
            $songs = $songsGateway->getAllBeforeYear($_GET['year-before-value']);
            $message = "Showing all songs before the year " . $_GET['year-before-value'];
            $name = "year-before-value";
        }
        else if( !empty($_GET['year-after-value']) ){
            $songs = $songsGateway->getAllAfterYear($_GET['year-after-value']);
            $message = "Showing all songs after the year " . $_GET['year-after-value'];
            $name = "year-after-value";
        }
        else if( !empty($_GET['pop-less-value']) ){
            $songs = $songsGateway->getAllPopularityLess($_GET['pop-less-value']);
            $message = "Showing all songs with popularity less than " . $_GET['pop-less-value'];
            $name = "pop-less-value";
        }
        else if( !empty($_GET['pop-greater-value']) ){
            $songs = $songsGateway->getAllPopularityGreat($_GET['pop-greater-value']);
            $message = "Showing all songs with popularity greater than " . $_GET['pop-greater-value'];
            $name = "pop-greater-value";
        }
        else{
            $songs = $songsGateway->showAllSongs();
            $message = "Showing all songs";
        }
        // get query strings
        $search = $_GET[$name];
    } catch(Exception $e){
        die($e->getMessage());
    }
?>

<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css-files/browse-search.css" rel="stylesheet">
    <link type="text/css" href="css-files/main.css" rel="stylesheet">

    <title>Browse/Search</title>
</head>
<body>
    <header class="header">
        <h1>COMP 3512 - PHP Assignment</h1>
        <h3>Izabelle Guevarra, Kimberly Canon<h3>
        <hr>
        <nav>
            <ul>
                <li><img src="icons/home.PNG" alt= "home icon"/><a href="home-page.php">HOME</a></li>
                <li><img src="icons/fav.PNG" alt= "favorites icon"/><a href="view-favorites.php">VIEW FAVORITES</a></li>
                <li><img src="icons/search.PNG" alt= "search icon"/><a href="search-page.php">SEARCH</a></li>
                <li><img src="icons/browse.PNG" alt= "browse/search icon"/><a href="browse-search-result.php">BROWSE/SEARCH</a></li>
            </ul>
        </nav>
        <hr>
    </header>

    <h2>Browse / Search Results</h2>

    <main>
        <h3><?php echo $message; ?></h3>

        <a href='browse-search-result.php' class= 'button'>Show All</a>

        <article>
            <section>
                <?php
                /*
                * outputs the songs that contains the requirements the user is seraching for
                */
                    outputSearchResults($songs, $name, $search);
                ?>
            </section>
        </article> 
    </main>

    <footer>
        <p>COMP 3512</p><p>&copy;Izabelle Guevarra & Kimberly Canon</p><a href="https://github.com/izabelle-g/COMP3512-Assignment1.git">Access to Github Repository</a>
    </footer>
</body>
</html>