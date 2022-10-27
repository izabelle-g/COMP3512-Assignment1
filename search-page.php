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
catch (Exception $e){ die($e->getMessage());}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css-files/search-page.css" rel="stylesheet">
    <link type="text/css" href="css-files/main.css" rel="stylesheet">

    <title>Search Song</title>
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

    <h2>Basic Song Search</h2>

    <main>
      
        <form method="GET" class="main form" action="browse-search-result.php">
            <div class="title">
                <label>Title</label> 
                <input type="text" name="title" title="title-search"> <br>
            </div>

            <div class="artist a1">
                <label>Artist</label>
                <select name="artistList" title="artist">
                    <option value='0'>Choose An Artist</option>
                    <?=outputArtistList($artist);?>
                </select>
            </div>

            <div class="genre a1">
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
                        <input type="text" for="pop-less" name="pop-less-value" title="text-popularity-less">
                    </label>
                    <label for="pop-greater">Greater
                        <input type="text" for="pop-greater" name="pop-greater-value" title="text-popularity-greater">
                    </label></br>
                </div>
            </div>
            <input class="btn" type="submit">
        </form>
    </main>

    <footer>
        <p>COMP 3512</p><p>&copy;Izabelle Guevarra & Kimberly Canon</p><a href="https://github.com/izabelle-g/COMP3512-Assignment1.git">Access to Github Repository</a>
    </footer>
</body>
</html>