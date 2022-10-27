<?php
/**
 * Function outputting the header of the favorites table for the view favorites PHP
 */
    function outputHeader(){
        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Artist</th>";
        echo "<th>Year</th>";
        echo "<th>Genre</th>";
        echo "<th>Popularity</th>";
        echo "<th></th>";
        echo "<th></th>";
        echo "</tr>";
    }

    /**
 * outputFavorites function.
 *
 * Outputs a table list of the songs, the aritst name, year, genre and popularity.
 * Also allows the user to remove or view details of the song. 
 */
    function outputFavorites($fav_id, $search){
        foreach($fav_id as $f){?>
            <tr>
                <td><a href='single-song.php?id=<?=$f['song_id']?>'><?=$f['title']?></a></td>
                <td><?=$f['artist_name']?></td>
                <td><?=$f['year']?></td>
                <td><?=$f['genre_name']?></td>
                <td><?=$f['popularity']?></td>
                <td><a href='remove-favorites.php?id=<?=$f['song_id']?>&<?=$search?>'><button class="rm">remove</button></a></td>
                <td><a href='single-song.php?id=<?=$f['song_id']?>'><button class="view">view</button></a></td>
            </tr>
        <?php }   
    }
?>
