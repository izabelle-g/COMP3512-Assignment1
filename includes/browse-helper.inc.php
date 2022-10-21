<?php
    function outputSearchResults($songs){
        echo "<table>";
        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Artist</th>";
        echo "<th>Year</th>";
        echo "<th>Genre</th>";
        echo "<th>Popularity</th>";
        echo "<th></th>";
        echo "<th></th>";
        echo "</tr>";

        foreach($songs as $s){ ?>
            <tr>
                <td><a href='single-song.php?id=<?=$s['song_id']?>'><?=$s['title']?></a></td>
                <td><?=$s['artist_name']?></td>
                <td><?=$s['year']?></td>
                <td><?=$s['genre_name']?></td>
                <td><?=$s['popularity']?></td>
                <!--TODO: replace the song id back to + or an image-->
                <td><a href='add-to-favorites.php?id=<?=$s['song_id']?>' class='button'><?=$s['song_id']?></a></td>
                <!--TODO: style "button"-->
                <td><a href='single-song.php?id=<?=$s['song_id']?>' class='button'>View "button"</a></td>
            </tr>
        <?php }
        echo "</table>";
    } 
?>