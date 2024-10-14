<?php
require_once('database.php');

//class for doing roles table queries; only gets all 
//existing roles for now
class LevelDB {
    //Get all roles in the DB; returns false if the 
    //database connection fails 
    public static function getLevel() { 
        //get the DB connection
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            //create the query string 
            $query = 'SELECT * FROM user_levels';
            
            //execute the query
            return $dbConn->query($query);
        } else {
            return false;
        }
    }
}