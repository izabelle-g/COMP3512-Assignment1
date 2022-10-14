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
?>