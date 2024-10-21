<?php
require_once('database.php');

//class for users table queries
class UsersDB {
    //function to get a user by their e-mail address 
    public static function getUserByEMail($email) { 
        //get the DB connection
        $db = new Database(); 
        $dbConn = $db->getDbConn(); 
        if ($dbConn) {
            //create the query string
            $query = "SELECT * FROM users
            WHERE users.EMail = '$email'";

            //execute the query - returns false if 
            //no such email found
            $result = $dbConn->query($query); 
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public static function getUsers() {
        //get the DB connection
        $db = new Database();  
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            //create the query string; join the person 
            //table with the roles table to get the role 
            //info for the person object
            $query = 'SELECT * FROM users';
                    
            //execute the query
            return $dbConn->query($query);
        } else {
        return false;
        }
    }

    //function to get a specific person by their PersonNo 
    public static function getUsersByNo($userNo) {
        //get the database connection
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            //create the query string
            $query = "SELECT * FROM users
                WHERE UserNo = '$userNo'";

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
    public static function deleteUser($userNo) { 
        //get the database connection
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            //create the query string
            $query = "DELETE FROM users
                WHERE UserNo = '$userNo'";
            //execute the query, returning status 
            return $dbConn->query($query) === TRUE;
        } else {
            return false;
        }
    }
    //function to add a person to the DB; returns
    //true on success, false on failure or DB connection 
    //failure
    public static function addUser($userId, $password, $fName, $lName, $hireDate, $email, $extension, $userLevelNo)
    {
        //get the database connection
        $db = new Database();
        $dbConn = $db->getDbConn();
        if ($dbConn) {
            //create the query string - PersonNo is an 
            //auto-increment field, so no need to 
            //specify it
            $query =
            "INSERT INTO users (UserId, Password, FirstName, LastName, HireDate, EMail, Extension, UserLevelNo)
            VALUES ('$userId, $password, $fName, $lName, $hireDate, $email, $extension, $userLevelNo)";
            //execute the query, returning status
            return $dbConn->query($query) === TRUE;
        } else {
            return false;
        }
    }

    //function to update a person's information; returns 
    //true on success, false on failure or DB connection 
    //failure
    public static function updateUser($uNo, $userId, $password, $fName, $lName, $hireDate, $email, $extension, $userLevelNo)
    {
        //get the database connection
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            //create the query string
            $query =
            "UPDATE users SET
                UserId = '$userId',
                Password = '$password',
                FirstName = '$fName',
                LastName = '$lName',
                HireDate = '$hireDate',
                EMail = '$email',
                Extension = '$extension',
                UserLevelNo = '$userLevelNo',
            WHERE UserNo = '$uNo'";

            //execute the query, returning status 
            return $dbConn->query($query) === TRUE; 
        } else {
            return false;
        }
    }
}