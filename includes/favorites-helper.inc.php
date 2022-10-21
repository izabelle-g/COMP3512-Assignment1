<?php
    function outputFavorites($favorites){
        echo "<table>";
        //TODO: remove header names for remove and view
        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Artist</th>";
        echo "<th>Year</th>";
        echo "<th>Genre</th>";
        echo "<th>Popularity</th>";
        echo "<th></th>";
        echo "<th></th>";
        echo "</tr>";

        foreach($favorites as $f){ ?>
            <tr>
                <!--TODO: replace testfile.php with: "single-song-page.php?id=<?//$f['song_id']?>"-->
                <td><a href='testfile.php'><?=$f['title']?></a></td>
                <td><?=$f['artist_name']?></td>
                <td><?=$f['year']?></td>
                <td><?=$f['genre_name']?></td>
                <td><?=$f['popularity']?></td>
                <!--TODO: replace testfile.php with: "favorites.php" <- figure out how to do sessions-->
                <td><a href='testfile.php' class='button'>remove</a></td>
                <!--TODO: replace testfile.php with: "single-song-page.php?id=<?//$f['song_id']?>"-->
                <!--TODO: style "button"-->
                <td><a href='testfile.php' class='button'>View "button"</a></td>
            </tr>
        <?php }
        echo "</table>";
    } 
?>