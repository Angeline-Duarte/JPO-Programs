<?php
require_once('database.php');

//class for users table queries
class StudentsDB {

    public static function getStudents() {
        //get the DB connection
        $db = new Database(); 
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            //create the query string; join the person 
            //table with the roles table to get the role 
            //info for the person object
            $query = 'SELECT * FROM students';
                    
            //execute the query
            return $dbConn->query($query);
        } else {
        return false;
        }
    }

    //function to get a specific person by their PersonNo 
    public static function getStudentByNo($studentNo) {
        //get the database connection
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            //create the query string
            $query = "SELECT * FROM students
                WHERE StudentNo = '$studentNo'";

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
    public static function deleteStudent($studentNo) { 
        //get the database connection
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            //create the query string
            $query = "DELETE FROM students
                WHERE StudentNo = '$studentNo'";
            //execute the query, returning status 
            return $dbConn->query($query) === TRUE;
        } else {
            return false;
        }
    }
    //function to add a person to the DB; returns
    //true on success, false on failure or DB connection 
    //failure
    public static function addStudent($studentId, $fName, $lName, $dob, $programNo, $programName, $charges, $grade)
    {
        //get the database connection
        $db = new Database();
        $dbConn = $db->getDbConn();
        if ($dbConn) {
            //create the query string - PersonNo is an 
            //auto-increment field, so no need to 
            //specify it
            $query =
            "INSERT INTO students (StudentId, FirstName, LastName, DOB, ProgramNo, ProgramName, Charges, Grade)
            VALUES ('$studentId, $fName, $lName, $dob, $programNo, $programName, $charges, $grade)";

            //execute the query, returning status
            return $dbConn->query($query) === TRUE;
        } else {
            return false;
        }
    }

    //function to update a person's information; returns 
    //true on success, false on failure or DB connection 
    //failure
    public static function updateStudent($sNo, $studentId, $fName, $lName, $dob, $programNo, $programName, $charges, $grade)
    {
        //get the database connection
        $db = new Database();
        $dbConn = $db->getDbConn();  
 
        if ($dbConn) {
            //create the query string
            $query =
            "UPDATE students SET
                StudentId = '$studentId',
                FirstName = '$fName',
                LastName = '$lName',
                DOB = '$dob',
                ProgramNo = '$programNo',
                ProgramName = '$programName',
                Charges = '$charges',
                Grade = '$grade'
            WHERE StudentNo = '$sNo'";

            //execute the query, returning status 
            return $dbConn->query($query) === TRUE; 
        } else {
            return false;
        }
    }
}