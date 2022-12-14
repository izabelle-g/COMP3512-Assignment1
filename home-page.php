<?php
    require_once 'includes/db-classes.inc.php';
    require_once 'includes/config.inc.php';
    require_once 'includes/home-page-helper.inc.php';

    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        $songGateway = new SongsDB($conn);
        $artistGateway = new ArtistsDB($conn);
        $genreGateway = new GenresDB($conn);
    }
    catch (Exception $e){ die($e->getMessage());}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css-files/home-page.css" rel="stylesheet">
    <link type="text/css" href="css-files/main.css" rel="stylesheet">

    <title>Home | Song Bank</title>
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
    
    <h2>Top Music Categories</h2>

    <main class="body">
        <div class="desc">
            <p>COMP 3512 - PHP Assignment</p><p>Izabelle Guevarra, Kimberly Canon</p>
            <a href="https://github.com/izabelle-g/COMP3512-Assignment1.git">Access to Github Repository</a>
        </div>
        
    
        <div class="column top-genre "> 
            <h3>Top Genres</h3>
            <?php 
                $genres = $genreGateway->getTop10Genres();
                outputTop10Category($genres);
            ?>
        </div>
        <div class="column top-artist"> 
            <h3>Top Artists</h3>
            <?php 
                $artists = $artistGateway->getTop10Artists();
                outputTop10Category($artists);
            ?>
        </div>
        <div class="column popular"> 
            <h3>Most Popular Songs</h3>
            <?php 
                $popular = $songGateway->getTop10Popularity();
                outputTop10Songs($popular);
            ?>
        </div>
        <div class="column one-hit"> 
            <h3>One Hit Wonders</h3>
            <?php 
                $oneHit = $songGateway->getTop10OneHits();
                outputTop10Songs($oneHit);
            ?>
        </div>
        <div class="column acoustic"> 
        <h3>Longest Acoustic Songs</h3>
            <ul>
                <?php
                $song = $songGateway -> getTop10LongestAcoustic();
                foreach($song as $key){ ?>
                <li><span><a href="single-song.php?id=<?=$key['song_id']?>"><?=$key['title']?></a></span> by <?= $key['artist_name']?> (<?= $key['duration']?>)</li><br>

                <?php
                }
                ?>
           </ul>
        </div>
        <div class="column club"> 
            <h3>At The Club</h3>
            <?php 
                $club = $songGateway->getTop10AtTheClub();
                outputTop10Songs($club);
            ?>
        </div>
        <div class="column running"> 
            <h3>Running Songs</h3>
            <?php 
                $run = $songGateway->getTop10RunningSongs();
                outputTop10Songs($run);
            ?>
        </div>
        <div class="column studying"> 
            <h3>Studying</h3>
            <?php 
                $study = $songGateway->getTop10Studying();
                outputTop10Songs($study);
            ?>
        </div>
    </div>

    <footer>
        <p>COMP 3512</p><p>&copy;Izabelle Guevarra & Kimberly Canon</p><a href="https://github.com/izabelle-g/COMP3512-Assignment1.git">Access to Github Repository</a> 
    </footer>
</body>
</html>