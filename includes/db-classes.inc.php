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

    /* Add other table DB classes here with functions like getAll() or something */
    class SongsDB{
        private static $baseSQL = "SELECT title, artist_name, year, genre_name, popularity FROM artists INNER JOIN songs ON songs.artist_id = artists.artist_id INNER JOIN genres ON songs.genre_id = genres.genre_id";

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