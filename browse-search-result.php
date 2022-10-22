<?php
    require_once 'includes/config.inc.php';
    require_once 'includes/db-classes.inc.php';
    require_once 'includes/browse-helper.inc.php';

    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
        $songsGateway = new SongsDB($conn);

        // TODO: works, just needs the search page
        if( !empty($_GET['name']) ){
            switch($_GET['name']){
                case 'title':
                    $songs = $songsGateway->getAllWithTitle($_GET['title']);
                    $message = "Showing all songs with " . $_GET['title'] . " in Title";
                    break;
                case 'artist_name':
                    $songs = $songsGateway->getAllForArtist($_GET['artist_name']);
                    $message = "Showing all songs by " . $_GET['artist_name'];
                    break;
                case 'genre_name':
                    $songs = $songsGateway->getAllForGenre($_GET['genre_name']);
                    $message = "Showing all " . $_GET['genre_name'] . " songs in Genre";
                    break;
                case 'year': // TODO: change after getting search
                    $message = "Under Construction";
                    break;
                case 'popularity': // TODO: change after getting search
                    $message = "Under Construction";
                    break;
                default:
                    $songs = $songsGateway->showAllSongs();
                    $message = "Showing all songs";
                    break;
            }
        } else{
            $songs = $songsGateway->showAllSongs();
            $message = "Showing all songs";
        }

        // get query strings
        $name = $_GET['name'];
        $search = $_GET[$name];
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
                    outputSearchResults($songs, $name, $search);
                ?>
            </section>
        </article> 
    </main>

    <footer>
        <h2>Footer</h2>
    </footer>
</body>