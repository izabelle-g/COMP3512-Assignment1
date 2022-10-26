<?php
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

    function outputFavorites($fav_id, $search){
        foreach($fav_id as $f){?>
            <tr>
                <td><a href='single-song.php?id=<?=$f['song_id']?>'><?=$f['title']?></a></td>
                <td><?=$f['artist_name']?></td>
                <td><?=$f['year']?></td>
                <td><?=$f['genre_name']?></td>
                <td><?=$f['popularity']?></td>
                <td><a href='remove-favorites.php?id=<?=$f['song_id']?>&<?=$search?>' class='button'>remove</a></td>
                <td><a href='single-song.php?id=<?=$f['song_id']?>' class='button'>View "button"</a></td>
            </tr>
        <?php }   
    }
?>
