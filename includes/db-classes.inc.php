<?php
    /* 
        A class to reduce repeat code whenever we deal with a database. 

        Code from Lab14a.
    */
    class DatabaseHelper{
        /* 
            This function returns a connection object to a specified database.  
            Use this whenever a new connection to a database is needed.
        */
        public static function createConnection($values = array()){
            $connString = $values[0];
            $user = $values[1];
            $pass = $values[2];

            // create new connection
            $pdo = new PDO($connString, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;
        }


        /*
            This function runs the SQL query passed to it using the specified connection and parameters.
            If there are no parameters, use 'null'.
        */
        public static function runQuery($connection, $sql, $parameters){
            $statement = null;
        
            // if there are parameters then fdo a prepared statement
            if(isset($parameters)){
                // Ensure parameters are in an array
                if(!is_array($parameters)){
                    $parameters = array($parameters);
                }

                // Use a prepared statement if parameters
                $statement = $connection->prepare($sql);
                $executedOk = $statement->execute($parameters);
                if(!$executedOk) throw new PDOException;
            } else{
                // If no parameters, execute the query
                $statement = $connection->query($sql);
                if(!$statement) throw new PDOException;
            }

            return $statement;
        }
    }

    class SongsDB{
        private static $baseSQL = "SELECT song_id, bpm, energy, danceability, liveness, valence, acousticness, speechiness, popularity, title,duration, artist_name, year, genre_name, popularity FROM artists INNER JOIN songs ON songs.artist_id = artists.artist_id INNER JOIN genres ON songs.genre_id = genres.genre_id";

        public function __construct($connection){
            $this -> pdo = $connection;
        }

        public function showAllSongs(){
            $sql = self::$baseSQL . " ORDER BY title";
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
            return $statement->fetchAll();
        }

        public function getAllWithTitle($title){
            $sql = self::$baseSQL . " WHERE title LIKE ? ORDER BY title";
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array('%' . $title . '%'));
            return $statement->fetchAll();
        }

        public function getAllForArtist($artist_name){
            $sql = self::$baseSQL . " WHERE artist_name=? ORDER BY title";
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($artist_name));
            return $statement->fetchAll();
        }

        public function getAllForGenre($genre_name){
            $sql = self::$baseSQL . " WHERE genre_name=? ORDER BY title";
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($genre_name));
            return $statement->fetchAll();
        }

        public function getAllBeforeYear($year){
            $sql = self::$baseSQL . " WHERE year<=? ORDER BY year";
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($year));
            return $statement->fetchAll();
        }

        public function getAllAfterYear($year){
            $sql = self::$baseSQL . " WHERE year>=? ORDER BY year";
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($year));
            return $statement->fetchAll();
        }

        public function getAllPopularityLess($popularity){
            $sql = self::$baseSQL . " WHERE popularity<=? ORDER BY popularity";
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($popularity));
            return $statement->fetchAll();
        }

        public function getAllPopularityGreat($popularity){
            $sql = self::$baseSQL . " WHERE popularity>=? ORDER BY popularity";
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($popularity));
            return $statement->fetchAll();
        }

        public function getSong($song_id){
            $sql = self::$baseSQL . " WHERE song_id=?";
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($song_id));
            return $statement->fetch();
        }

        public function getTop10Popularity(){
            $sql = self::$baseSQL . ' ORDER BY popularity DESC LIMIT 10';
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
            return $statement->fetchAll();
        }

        public function get10OneHits(){

            $sql = "SELECT song_id, title, artist_name, year, genre_name, popularity FROM artists INNER JOIN songs ON songs.artist_id = artists.artist_id INNER JOIN genres ON songs.genre_id = genres.genre_id GROUP BY artist_name HAVING COUNT(artist_name) < 2 ORDER BY artist_name ASC LIMIT 10";
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
            return $statement->fetchAll();
        }

        public function longestAcoustic(){
            $sql = "SELECT title, duration,acousticness, artist_name FROM artists INNER JOIN songs ON songs.artist_id = artists.artist_id WHERE acousticness > 40 ORDER BY duration DESC LIMIT 10";
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
            return $statement->fetchAll();
        }

        public function AtTheClub(){
            $sql = "SELECT title, danceability, danceability, artist_name FROM artists INNER JOIN songs ON songs.artist_id = artists.artist_id WHERE danceability > 80 ORDER BY danceability DESC LIMIT 10";
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
            return $statement->fetchAll();
        }


    }

    class ArtistsDB{
        private static $baseSQL = "SELECT artist_id, artist_name FROM artists ORDER BY artist_name";

        public function __construct($connection){
            $this -> pdo = $connection;
        }

        public function getAll(){
            $sql = self::$baseSQL;
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
            return $statement->fetchAll();
        }
        public function getTop10Artists(){
           // $sql = "SELECT COUNT(artist_id), artist_name FROM songs,artists WHERE artist.artist_id=songs.artist_id ";
           $sql = "SELECT artist_name, COUNT(artists.artist_id) FROM songs INNER JOIN artists ON songs.artist_id=artists.artist_id ORDER BY artist_name LIMIT 10";
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
            return $statement->fetchAll();
        }


    }

    class GenresDB{
        private static $baseSQL = "SELECT genre_id, genre_name FROM genres ORDER BY genre_name";

        public function __construct($connection){
            $this -> pdo = $connection;
        }

        public function getAll(){
            $sql = self::$baseSQL;
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
            return $statement->fetchAll();
        }

        public function topGenres(){
            $sql = "SELECT COUNT(songs.genre_id), genres.genre_name FROM SONGS INNER JOIN genres ON songs.genre_id = genres.genre_id GROUP BY songs.genre_id ORDER BY COUNT(songs.genre_id) DESC LIMIT 10";
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
            return $statement->fetchAll();
        }


    }

    class TypesDB{
        private static $baseSQL = "SELECT type_id, type_name FROM types ORDER BY type_name";

        public function __construct($connection){
            $this -> pdo = $connection;
        }

        public function getAll(){
            $sql = self::$baseSQL;
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
            return $statement->fetchAll();
        }
    }
?>