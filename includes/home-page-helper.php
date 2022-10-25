<?php

function outputTopGenre($song,$popularity){
    $sql = "SELECT title, popularity, artist_name from songs, artists WHERE songs.artist_id=artists.artist_id ORDER BY popularity LIMIT 10";
    return $sql;
}
?>