<?php

function outputTopGenre($song,$popularity){
    $sql = "SELECT title, popularity, artist_name from songs, artists WHERE songs.artist_id=artists.artist_id ORDER BY popularity LIMIT 10";
    return $sql;
}

function outputSingleSong($row) {
    echo $row['song_id']." By ".$row['artist_name']. " , ".$row['artist_type']. " , ". $row['genre_name']." (".$row['year'].") ".$row['duration'];
 }
?>

