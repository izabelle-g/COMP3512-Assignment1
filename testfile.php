<?php
    /* This file just checks if we could access the database initially. */

    require_once('includes/config.inc.php');  
?>
<!DOCTYPE html>
<html>
<body>
<h1>Database Tester (PDO)</h1>
<?php
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select * from artists";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $row) {
            echo $row['artist_id'] . " - " . $row['artist_name'] . "<br/>";
        }
        $pdo = null;
    } catch (PDOException $e) {
        die( $e->getMessage() );
    }
?>