<?php   
    require_once 'includes/db-classes.inc.php';
    require_once 'includes/config.inc.php';

    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        $songGateway = new SongsDB($conn);

        if( !empty($_GET['id']) ){
            $song = $songGateway->getSong($_GET['id']);
        }
    }
    catch (Exception $e){ die($e->getMessage());}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css-files/single-song.css" rel="stylesheet">
    <link type="text/css" href="css-files/main.css" rel="stylesheet">
    <title><?=$song[0]['title']?> by <?=$song[0]['artist_name']?></title>
</head>
<body>
    <header>
        <h1>COMP 3512 - PHP Assignment</h1>
        <h3>Izabelle Guevarra, Kimberly Canon<h3>
            <hr>
            <br>
            
        

        <nav>
            <ul>
                <li><a href="home-page.php">HOME</a><img src="" alt= "home icon"/></li>
                <li><a href="view-favorites.php">VIEW FAVORITES</a><img src="" alt= "favorites icon"/></li>
                <li><a href="search-page.php">SEARCH</a><img src="" alt= "search icon"/></li>
                <li><a href="browse-search-result.php">BROWSE/SEARCH</a><img src="" alt= "browse/search icon"/></li>
            </ul>
        </nav>
    </header>
    <hr>

    <main class="body">
        <h1>Song Information</h1>
        <div class="list">
            <?php
                foreach($song as $s){
                    echo "<div class='title'><b>".$s['title']."</b> by ". $s['artist_name']."<br></div>";
                    echo "<br>";
                    echo "Genre: ". $s['genre_name']."<br>";
                    echo "Year: ". $s['year']."<br>";
                    echo "Duration: ". $s['duration']."<br>";
                } 
                echo "</div>";

                echo "<p><b>Analysis Data</b></p>";
                echo "<div class='data'><ul>";
                foreach($song as $s){ ?>
                    <li><?= 'BPM: ' . $s['bpm'];?></li>
                    <li><?= 'Energy: ' . $s['energy'];?></li>
                    <li><?= 'Liveness: ' . $s['liveness'];?></li>
                    <li><?= 'Danceability: ' . $s['danceability'];?></li>
                    <li><?= 'Valence: ' . $s['valence'];?></li>
                    <li><?= 'Acousticness: ' . $s['acousticness'];?></li>
                    <li><?= 'Popularity: ' . $s['popularity'];?></li>
                <?php }
                echo "</div></ul>";
            ?>
        
    </main>

    <footer>
        <p>COMP 3512</p><p>&copy;Izabelle Guevarra & Kimberly Canon</p><a href="https://github.com/izabelle-g/COMP3512-Assignment1.git">Access to Github Repository</a>
    </footer>
</body>
</html>