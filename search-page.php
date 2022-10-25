<?php 
include_once 'includes/db-classes.inc.php';
require_once 'includes/config.inc.php';
include_once 'includes/browse-helper.inc.php';

try{
    $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
    $songGateway = new GenresDB($conn);
    $artistGateway = new ArtistsDB($conn);
    $song = $songGateway->getAll();
    $artist = $artistGateway->getAll();
}
  //  $sql = "SELECT title, artist_name, year, genre_name, popularity FROM songs, artist, genre ORDER BY title WHERE title LIKE '%$search%';
catch (Exception $e){ die($e->getMessage());}   
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <div class="header">
    <h2>Header </h2>
   </div> 
   <form class="" method="GET" class="main form" action="browse-search-result.php">
    <h2>Basic Song Search</h2>

    <div class="title">
        <label>Title</label> 
        <input type="text" name="title" title="title-search"> <br>
    </div>

    <div class="artist">
        <label>Artist</label>
        <select name="artistList" title="artist">
            <option value='0'>Choose An Artist</option>
                <?=outputArtistList($artist);?>
                <!--
                    stuff here
                -->
        </select>
    </div>

    <div class="genre">
        <label>Genre</label>
        <select name="genreList" title="genre">
            <option value='0'>Choose A Genre</option>
            <?=outputGenre($song)?>
        </select> <br>
    </div>
    
    <div class="year">
        <label>Year</label>
        <div class="year scale">
            <input type="radio" id="year-from" name="year" value="year-from">
            <label for="year-from">From
                <input type="text" for="year-from" name="year-from-value" title="text-year-from">
            </label>
            <input type="radio" id="year-to" name="year" value="year-to">
            <label for="year-to">To
                <input type="text" for="year-to" name="year-to-value" title="text-year-to">
            </label><br>
        </div>
    </div>

    <br>

    <div class="popularity">
        <label>Popularity</label>
        <div class="popularity scale">
            <input type="radio" id="pop-from" name="popularity" value="popularity-from">
            <label for="pop-from">From
                <input type="text" for="pop-from" name="pop-from-value" title="text-popularity-from">
            </label>
            <input type="radio" id="pop-to" name="popularity" value="popularity-to">
            <label for="pop-to">To
                <input type="text" for="pop-to" name="pop-to-value" title="text-popularity-to">
            </label></br>
        </div>
    </div>

    <input type="submit">
   </form>
</body>

<footer>
        <h2>Footer</h2>
    </footer>
</html>