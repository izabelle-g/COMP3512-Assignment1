<?php


    // function outputGenre($genre_name){
    //     foreach($genre_name as $key){
    //         echo '<option value='.$key.'>';
    //         echo utf8_encode()
    //     }
    // }
    function outputSearchResults($songs){
        echo "<table>";
        //TODO: add two columns for add to favorites later
        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Artist</th>";
        echo "<th>Year</th>";
        echo "<th>Genre</th>";
        echo "<th>Popularity</th>";
        echo "<th>Add to Favorites</th>";
        echo "<th>View</th>";
        echo "</tr>";
        foreach($songs as $s){ ?>
            <tr>
                <!--TODO: replace testfile.php with: "single-song-page.php?id=<?//$s['song_id']?>"-->
                <td><a href='testfile.php'><?=$s['title']?></a></td>
                <td><?=$s['artist_name']?></td>
                <td><?=$s['year']?></td>
                <td><?=$s['genre_name']?></td>
                <td><?=$s['popularity']?></td>
                <!--TODO: replace testfile.php with: "favorites.php" <- figure out how to do sessions-->
                <td><a href='testfile.php' class='button'>+</a></td>
                <!--TODO: replace testfile.php with: "single-song-page.php?id=<?//$s['song_id']?>"-->
                <!--TODO: style "button"-->
                <td><a href='testfile.php' class='button'>View "button"</a></td>
            </tr>
        <?php }
        echo "</table>";
    } 

    function outputGenre($songs){
        foreach($songs as $key){
            echo "<option value='".$key['genre_id']."'>".$key['genre_name']."</option>";
        }

    }
    function outputArtistList($artist){
        foreach($artist as $key){
            echo "<option value='".$key['artist_id']."'>".$key['artist_name']."</option>";
        }
    }

    // function findSongs($search){
    //     try{
    //         $conn = DatabaseHelper::creatConnection(array(DBCONNSTRING, DBUSER,DBPASS))
    //     }
    // }
?>