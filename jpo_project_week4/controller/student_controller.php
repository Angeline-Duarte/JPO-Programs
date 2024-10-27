<?php
include_once('students.php');
include_once('students_db.php'); 



class StudentController {
    //helper function to convert a db row into a 
    //User object
    private static function rowToStudent($row) {
        $student = new Student($row['StudentId'],
            $row['FirstName'], 
            $row['LastName'],
            $row['DOB'],
            $row['ProgramNo'], 
            $row['ProgramName'],
            $row['Charges'],
            $row['Grade']);
        return $student;
    }


    //function to get all people in the database 
    public static function getAllStudents() { 
        $queryRes = StudentsDB::getStudents();

        if ($queryRes) {
        //process the results into an array with 
        //the RoleNo and the RoleName - allows the 
        //UI to not care about the DB structure 
        $student= array();
        foreach ($queryRes as $row) {
            //process each row into an array of 
            //Person objects (i.e. "people") 
            $student[] = self::rowToStudent($row);
        }

            return $student;
        } else {
            return false;
        }
    }
    //function to get a specific person by their PersonNo 
    public static function getStudent($studentNo) {
        $queryRes = StudentsDB::getStudentByNo($studentNo);

        if ($queryRes) {
        //this query only returns a single row, so 
        //just process it
        return self::rowToStudent($queryRes);
        } else {
            return false;
        }
    }

    //function to delete a person by their PersonNo 
    public static function deleteStudent($studentNo) { 
        //no special processing needed - just use the 
        //DB function
        return StudentsDB::deleteStudent($studentNo);
    }
    //function to add a person to the DB
    public static function addStudent($student) { 
        return StudentsDB::addStudent(
            $student->getStudentId(),
            $student->getStudentFirstName(),
            $student->getStudentLastName(),
            $student->getDOB(),
            $student->getProgramNo(),
            $student->getProgramName(),
            $student->getCharges(),
            $student->getGrade());
    }

    //function to update a person's information 
    public static function updateStudent($student) { 
        return StudentsDB::updateStudent(
            $student->getStudentNo(),
            $student->getStudentId(),
            $student->getStudentFirstName(),
            $student->getStudentLastName(),
            $student->getDOB(),
            $student->getProgramNo(),
            $student->getProgramName(),
            $student->getCharges(),
            $student->getGrade());
    }
}