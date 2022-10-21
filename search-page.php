<?php 
include_once 'includes/db-classes.inc.php';
require_once('includes/config.inc.php');
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
        <input type="text" title="title search"> <br>
    </div>

    <label>Artist</label>
    <select name="artistList" title="artist">
        <option value='0'>Choose An Artist</option>
        <?=outputArtistList($artist);?>
        <!--
            stuff here
        -->
    </select>

    <div class="genre">
        <input type="radio" name="genre" title="genre">
        <label>Genre</label>
        <select name="artistList" title="artist">

            <option value='0'>Choose A Genre</option>
            <?=outputGenre($song)?>

        </select> <br>
    </div>
    
    <div class="year">
        <label>Year</label>
        <div class="year scale">
            <input type="radio" title="year-from" name="year-from"> From 
            <input type="text" name="text-from" title="text-year-from">
            <input type="radio" title="year-to" name="year-to"> To
            <input type="text" name="text-to" title="text-year-to">
        </div>
    </div>

    <br>

    <div class="popularity">
        <label>Popularity</label>
        <div class="popularity scale">
            <input type="radio" title="year-from" name="popularity-from"> From 
            <input type="text" name="text-from" title="text-popularity-from">
            <input type="radio" title="year-to" name="popularity-to"> To
            <input type="text" name="text-to" title="text-popularity-to">
        </div>
    </div>

    <input type="submit" >


   





   </form>
</body>
</html>