<?php
    require_once 'includes/config.inc.php';
    require_once 'includes/db-classes.inc.php';
    require_once 'includes/browse-helper.inc.php';

    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
        $songsGateway = new SongsDB($conn);

        //TODO: make it work when all pages are done
        if( ! empty($_GET['title']) ){
            $songs = $songsGateway->getAllWithTitle($_GET['title']);
            $message = "Showing all songs with " . $_GET['title'] . " in Title";
        } else if( ! empty($_GET['artist_name']) ){
            $songs = $songsGateway->getAllForArtist($_GET['artist_name']);
            $message = "Showing all songs by " . $_GET['artist_name'];
        } else if( ! empty($_GET['genre_name']) ){
            $songs = $songsGateway->getAllForGenre($_GET['genre_name']);
            $message = "Showing all " . $_GET['genre_name'] . " songs in Genre";
        } else if( ! empty($_GET['year']) && ! empty($_GET['choice']) ){
            if($_GET['choice'] == "less"){
                $songs = $songsGateway->getAllBeforeYear($_GET['year']);
                $message = "Showing all songs on and before " . $_GET['year'];
            } else if($_GET['choice'] == "greater"){
                $songs = $songsGateway->getAllAfterYear($_GET['year']);
                $message = "Showing all songs on and after " . $_GET['year'];
            }
        } else if( ! empty($_GET['popularity']) && ! empty($_GET['choice']) ){
            if($_GET['choice'] == "less"){
                $songs = $songsGateway->getAllPopularityLess($_GET['popularity']);
                $message = "Showing all songs with popularity of " . $_GET['popularity'] . " or less";

            } else if($_GET['choice'] == "greater"){
                $songs = $songsGateway->getAllPopularityGreat($_GET['popularity']);
                $message = "Showing all songs with popularity of " . $_GET['popularity'] . " or greater";
            }
        }
        else{
            $songs = $songsGateway->showAllSongs();
            $message = "Showing all songs";
        }
    } catch(Exception $e){
        die($e->getMessage());
    }
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
        <h2>Browse / Search Results</h2>
        <h3><?php echo $message; ?></h3>

        <a href='browse-search-result.php' class= 'button'>Show All</a>

        <article>
            <section>
                <?php
                    outputSearchResults($songs);
                ?>
            </section>
        </article> 
    </main>

    <footer>
        <h2>Footer</h2>
    </footer>
</body>