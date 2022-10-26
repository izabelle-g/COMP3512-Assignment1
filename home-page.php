<?php
    include_once 'includes/db-classes.inc.php';
    require_once 'includes/config.inc.php';

    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        $songGateway = new SongsDB($conn);
        $artistGateway = new ArtistsDB($conn);
        $genreGateway = new GenresDB($conn);
        $song = $songGateway->showAllSongs();
        $artist = $artistGateway->getAll();
        $genre = $genreGateway->getAll();
    }
    catch (Exception $e){ die($e->getMessage());}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css-files/home-page.css" rel="stylesheet">
    <title>Home | Song Bank</title>
</head>
<body>
    <header class="header">
        <h1>Header</h1>

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
            <ul>
                <?php
                $genre = $genreGateway -> topGenres();
                foreach($genre as $key){ ?>
                <li><span><?= $key['genre_name'];?> - <?= $key['COUNT(songs.genre_id)'];?> </span> </li>
                <?php
                }
                ?>
           </ul>
        </div>
        <div class="column top-artist"> 
            <h3>Top Artists</h3>
            <ul>
                <?php
                $artist = $artistGateway -> getTop10Artists();
                foreach($artist as $key){ ?>
                <li><span><?= $key['artist_name']?> </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div class="column popular"> 
            <h3>Most Popular Songs</h3>
            <ul>
                <?php
                $song = $songGateway -> getTop10Popularity();
                foreach($song as $key){ ?>
                <li><span><?= $key['title'];?> </span> - <?= $key['artist_name']?>  - <?= $key['popularity']?> </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div class="column one-hit"> 
            <h3>One Hit Wonders</h3>
            <ul>
                <?php
                $song = $songGateway -> get10OneHits();
                foreach($song as $key){ ?>
                <li><span><?= $key['title'];?> </span> - <?= $key['artist_name']?> </li>
                <?php
                }
                ?>
           </ul>
        </div>
        <div class="column acoustic"> 
            <h3>Longest Acoustic Songs</h3>
            <ul>
                <?php
                $song = $songGateway -> longestAcoustic();
                foreach($song as $key){ ?>
                <li><span><?= $key['title'];?> </span> - <?= $key['artist_name']?> Duration: <?= $key['duration']?></li>
                <?php }
                ?>
           </ul>
        </div>
        <div class="column club"> 
        <h3>At The Club</h3>
            <ul>
                <?php
                $song = $songGateway -> AtTheClub();
                foreach($song as $key){ ?>
                <li><span><?= $key['title'];?> </span> - <?= $key['artist_name']?> Calc: <?= $key['danceability']?></li>
                <?php }
                ?>
           </ul>
        </div>
        <div class="column running"> 
            <ul>
                <li>Running Songs</li>
            </ul>
        </div>
        <div class="column studying"> 
            <ul>
                <li>Studying</li>
            </ul>
        </div>
    </div>

    <footer>
        <p>COMP 3512 - PHP Assignment</p><p>Izabelle Guevarra, Kimberly Canon</p><a href="https://github.com/izabelle-g/COMP3512-Assignment1.git">Access to Github Repository</a> 
    </footer>
</body>
</html>