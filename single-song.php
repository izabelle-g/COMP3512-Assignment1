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

    <h2>Song Information</h2>

    <main class="body">
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
        </div>
    </main>

    <footer>
        <p>COMP 3512</p><p>&copy;Izabelle Guevarra & Kimberly Canon</p><a href="https://github.com/izabelle-g/COMP3512-Assignment1.git">Access to Github Repository</a>
    </footer>
</body>
</html>