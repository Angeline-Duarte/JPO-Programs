<?php
require_once('database.php');

//class for users table queries
class ProgramsDB {
    public static function getPrograms() {
        //get the DB connection
        $db = new Database(); 
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            //create the query string; join the person 
            //table with the roles table to get the role 
            //info for the person object
            $query = 'SELECT * FROM programs';
                    
            //execute the query
            return $dbConn->query($query);
        } else {
        return false;
        }
    }

    //function to get a specific person by their PersonNo 
    public static function getProgramsByNo($programNo) {
        //get the database connection
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            //create the query string
            $query = "SELECT * FROM programs
                WHERE ProgramNo = '$programNo'";

            //execute the query
            $result = $dbConn->query($query);
            //return the associative array 
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    //function to delete a person by their PersonNo 
    //returns True on success, False on failure or 
    //datbase connection failure
    public static function deleteProgram($programNo) { 
        //get the database connection
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            //create the query string
            $query = "DELETE FROM programs
                WHERE ProgramNo = '$programNo'";
            //execute the query, returning status 
            return $dbConn->query($query) === TRUE;
        } else {
            return false;
        }
    }
    //function to add a person to the DB; returns
    //true on success, false on failure or DB connection 
    //failure
    public static function addProgram($name, $address, $treatments, $beds)
    {
        //get the database connection
        $db = new Database();
        $dbConn = $db->getDbConn();
        if ($dbConn) {
            //create the query string - PersonNo is an 
            //auto-increment field, so no need to 
            //specify it
            $query =
            "INSERT INTO programs (ProgramName, ProgramAddress, TreatmentsAvailable, BedsAvailable)
            VALUES ('$name, $address, $treatments, $beds)";

            //execute the query, returning status
            return $dbConn->query($query) === TRUE;
        } else {
            return false;
        }
    }

    //function to update a person's information; returns 
    //true on success, false on failure or DB connection 
    //failure
    public static function updateProgram($pNo, $name, $address, $treatments, $beds)
    {
        //get the database connection
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            //create the query string
            $query =
            "UPDATE programs SET
                ProgramName = '$name',
                ProgramAddress = '$address',
                TreatmentsAvailable = '$treatments',
                BedsAvailable= '$beds',
            WHERE ProgramNo = '$pNo'";

            //execute the query, returning status 
            return $dbConn->query($query) === TRUE; 
        } else {
            return false;
        }
    }
}