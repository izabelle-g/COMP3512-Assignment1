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
            <label for="year-before">Before
                <input type="text" for="year-before" name="year-before-value" title="text-year-before">
            </label>
            <label for="year-after">After
                <input type="text" for="year-after" name="year-after-value" title="text-year-after">
            </label><br>
        </div>
    </div>

    <br>

    <div class="popularity">
        <label>Popularity</label>
        <div class="popularity scale">
            <label for="pop-less">Less
                <input type="text" for="pop-less" name="pop-before-less" title="text-popularity-less">
            </label>
            <label for="pop-greater">Greater
                <input type="text" for="pop-greater" name="pop-greater-value" title="text-popularity-greater">
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