<?php

/* 
* Outputs a table list of the songs, the aritst name, year, genre and popularity.
*/

    function outputSearchResults($songs, $name, $search){
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
                <td class='song-title'><a href='single-song.php?id=<?=$s['song_id']?>'><?=$s['title']?></a></td>
                <td><?=$s['artist_name']?></td>
                <td><?=$s['year']?></td>
                <td><?=$s['genre_name']?></td>
                <td><?=$s['popularity']?></td>
                <td><a href='add-to-favorites.php?id=<?=$s['song_id']?>&name=<?=$name?>&<?=$name?>=<?=$search?>' ><button class='button'>Add</button></a></td>
                <td><a href='single-song.php?id=<?=$s['song_id']?>' class='button'><button>View</button></a></td>
            </tr>
        <?php }
        echo "</table>";
    } 
/*
* Function outputs the genre of the songs selected
*/
    function outputGenre($songs){
        foreach($songs as $key){
            echo "<option value='".$key['genre_id']."'>".$key['genre_name']."</option>";
        }

    }

/*
* Function outputs the aritst of the songs selected
*/
    function outputArtistList($artist){
        foreach($artist as $key){
            echo "<option value='".$key['artist_id']."'>".$key['artist_name']."</option>";
        }
    }
?>