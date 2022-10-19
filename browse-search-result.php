<?php
    require_once 'includes/config.inc.php';
    require_once 'includes/db-classes.inc.php';
    require_once 'includes/browse-helper.inc.php';

    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
        $songsGateway = new SongsDB($conn);

        //FIXME: temporary, for testing, also see if empty() will work here, check email
        if( ! empty($_GET['title']) ){
            $songs = $songsGateway->getAllWithTitle($_GET['title']);
        } else if( ! empty($_GET['artist_name']) ){
            $songs = $songsGateway->getAllForArtist($_GET['artist_name']);
        } else if( ! empty($_GET['genre_name']) ){
            $songs = $songsGateway->getAllForGenre($_GET['genre_name']);
        } else if( ! empty($_GET['year']) && ! empty($_GET['choice']) ){ //TODO: edit function to pass the choice into after search page is done
            if($_GET['choice'] == "less"){
                $songs = $songsGateway->getAllBeforeYear($_GET['year']);
            } else if($_GET['choice'] == "greater"){
                $songs = $songsGateway->getAllAfterYear($_GET['year']);
            }
        } else if( ! empty($_GET['popularity']) && ! empty($_GET['choice']) ){ //TODO: edit function to pass the choice into after search page is done
            if($_GET['choice'] == "less"){
                $songs = $songsGateway->getAllPopularityLess($_GET['popularity']);
            } else if($_GET['choice'] == "greater"){
                $songs = $songsGateway->getAllPopularityGreat($_GET['popularity']);
            }
        }
        else{
            $songs = $songsGateway->showAllSongs();
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
        <h3>Current filter/search criteria (if any)</h3> <!--Place in the php if statement-->

        <article>
            <section>
                <?php
                    //test table output, using songs for now
                    outputSearchResults($songs);
                ?>
            </section>
        </article> 
    </main>

    <footer>
        <h2>Footer</h2>
    </footer>
</body>