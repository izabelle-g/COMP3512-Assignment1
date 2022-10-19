<?php
    require_once 'includes/config.inc.php';
    require_once 'includes/db-classes.inc.php';

    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
        $songsGateway = new SongsDB($conn);

        //FIXME: temporary, for testing
        $songs = $songsGateway->showAllSongs();

    } catch(Exception $e){
        die($e->getMessage());
    }
    
    //TODO: move function to include file later
    function outputSearchResults($songs){
        echo "<table>";
        //TODO: add two columns for add to favorites and view later
        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Artist</th>";
        echo "<th>Year</th>";
        echo "<th>Genre</th>";
        echo "<th>Popularity</th>";
        echo "</tr>";
        foreach($songs as $s){
            echo "<tr>";
            echo "<td>" . $s['title'] . "</td>";
            echo "<td>" . $s['artist_name'] . "</td>"; 
            echo "<td>" . $s['year'] . "</td>";
            echo "<td>" . $s['genre_name'] . "</td>"; 
            echo "<td>" . $s['popularity'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
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