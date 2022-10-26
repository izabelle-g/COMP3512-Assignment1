<?php
    function outputTop10Category($category){
        echo "<ul>";
        foreach($category as $c){
            echo "<li><span>" . $c['name'] . "</span> with " . $c['num'] . " songs</li>";
        }
        echo "</ul>";
    }

    function outputTop10Songs($song){
        echo "<ul>";
        foreach($song as $s){ ?>
            <li><span><a href="single-song.php?id=<?=$s['song_id']?>"><?=$s['title']?></a></span> by <?=$s['artist_name']?></li>
        <?php }
        echo "</ul>";
    }
?>

