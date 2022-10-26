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
    <link type="text/css" href="css-files/main.css" rel="stylesheet" />
    <title>Home | Song Bank</title>
</head>
<body>
    <header class="header">
        <h1>COMP 3512 - PHP Assignment</h1>
        <h3>Izabelle Guevarra, Kimberly Canon<h3>

        <nav>
            <ul>
                <li><a href="home-page.php">HOME</a><img src="" alt= "home icon"/></li>
                <li><a href="view-favorites.php">VIEW FAVORITES</a><img src="" alt= "favorites icon"/></li>
                <li><a href="search-page.php">SEARCH</a><img src="" alt= "search icon"/></li>
                <li><a href="browse-search-result.php">BROWSE/SEARCH</a><img src="" alt= "browse/search icon"/></li>
            </ul>
        </nav>
    </header>

    <main class="body">
        <div class="desc">
            <h2>Top Music Categories</h2>
            <p>COMP 3512 - PHP Assignment</p><p>Izabelle Guevarra, Kimberly Canon</p><a href="https://github.com/izabelle-g/COMP3512-Assignment1.git">Access to Github Repository</a>
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
            <?php 
                $acoustic = $songGateway->getTop10LongestAcoustic();
                outputTop10Songs($acoustic);
            ?>
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