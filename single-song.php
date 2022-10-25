<?php   
    /* TODO: remove after testing
    if(! empty($_GET['id']) ){
        echo $_GET['id'];
    }
    */
    include_once 'includes/db-classes.inc.php';
    require_once('includes/config.inc.php');
    include_once 'includes/home-page-helper.php';

    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        $songGateway = new SongsDB($conn);
        // $artistGateway = new ArtistsDB($conn);
        // $genreGateway = new GenresDB($conn);
         //$song = $songGateway->showAllSongs();

        // take this comment out: put the song_id from browe or whatever page into a variable
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
    <title>Document</title>
</head>
<body>
    <div class="header">
        <h1>Header</h1>
    </div>
    <div class="body">
        <h1>Song Information</h1>
        <?php 
        echo $song['title']." by ".$song['artist_name']."<br>";
        echo "Genre: ".$song['genre_name']."<br>";
        echo "Year: ".$song['year']."<br>";
        echo "Duration: ". $song['duration']."<br>";
        /*
        foreach($song as $key){ ?>
        <p><?=$key['title']?></p>
        <?php } */
        ?>
        <p> Analysis data</p>
        

            <li><?= 'BPM: '. $song['bpm'];?></li>
            <li><?= 'Energy: '. $song['energy'];?></li>
            <li><?= 'Liveness: '. $song['liveness'];?></li>
            <li><?= 'Danceability: '. $song['danceability'];?></li>
            <li><?= 'Valence: '. $song['valence'];?></li>
            <li><?= 'Acousticness: '. $song['acousticness'];?></li>
            <li><?= 'Popularity: '. $song['popularity'];?></li>
        </ul>  
    </div>
    <div class="footer">
        <h1>Footer</h1>
    </div>

</body>
</html>