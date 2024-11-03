<?php
include_once('user.php');
include_once('users_db.php'); 



class UserController {
    //helper function to convert a db row into a 
    //User object
    private static function rowToUser($row) {
        $user = new User($row['UserId'],
        $row['Password'],
        $row['FirstName'], 
            $row['LastName'],
            $row['HireDate'],
            $row['EMail'], 
            $row['Extension'],
            $row['UserLevelNo']);
        return $user;
    }

    //function to check login credentials - return true 
    //if user is valid, false otherwise
    public static function validUser($email, $password) { 
        $queryRes = UsersDB::getUserByEMail($email);

        if ($queryRes) {
            //process the user row
            $user = self::rowToUser($queryRes);
            if ($user->getPassword() === $password) {
                return $user->getUserLevelNo();
            } else{
                return false;
            }
        } else {
            //either no such user or db connect failed - 
            //either way, can't validate the user 
            return false;
        }
    }

    //function to get all people in the database 
    public static function getAllUsers() { 
        $queryRes = UsersDB::getUsers();

        if ($queryRes) {
        //process the results into an array with 
        //the RoleNo and the RoleName - allows the 
        //UI to not care about the DB structure 
        $user = array();
        foreach ($queryRes as $row) {
            //process each row into an array of 
            //Person objects (i.e. "people") 
            $user[] = self::rowToUser($row);
        }

            return $user;
        } else {
            return false;
        }
    }
    //function to get a specific person by their PersonNo 
    public static function getUser($userNo) {
        $queryRes = UsersDB::getUsersByNo($userNo);

        if ($queryRes) {
        //this query only returns a single row, so 
        //just process it
        return self::rowToUser($queryRes);
        } else {
            return false;
        }
    }

    //function to delete a person by their PersonNo 
    public static function deleteUser($userNo) { 
        //no special processing needed - just use the 
        //DB function
        return UsersDB::deleteUser($userNo);
    }
    //function to add a person to the DB
    public static function addUser($user) { 
        return UsersDB::addUser(
            $user->getUserId(),
            $user->getPassword(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getHireDate(),
            $user->getEMail(),
            $user->getExtension(),
            $user->getUserLevelNo());
    }

    //function to update a person's information 
    public static function updateUser($user) { 
        return UsersDB::updateUser(
            $user->getUserNo(),
            $user->getUserId(),
            $user->getPassword(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getHireDate(),
            $user->getEMail(),
            $user->getExtension(),
            $user->getUserLevelNo());
    }
}