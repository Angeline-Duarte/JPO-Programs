<?php
include_once('program.php');
include_once('programs_db.php'); 



class ProgramController {
    //helper function to convert a db row into a 
    //User object
    private static function rowToProgram($row) {
        $program = new Program( $row['ProgramName'],
            $row['ProgramAddress'],
            $row['TreatmentsAvailable'], 
            $row['BedsAvailable']);
        return $program;
    }

    //function to get all people in the database 
    public static function getAllPrograms() { 
        $queryRes = ProgramsDB::getPrograms();

        if ($queryRes) {
        //process the results into an array with 
        //the RoleNo and the RoleName - allows the 
        //UI to not care about the DB structure 
        $program = array();
        foreach ($queryRes as $row) {
            //process each row into an array of 
            //Person objects (i.e. "people") 
            $program[] = self::rowToProgram($row);
        }

            return $program;
        } else {
            return false;
        }
    }
    //function to get a specific person by their PersonNo 
    public static function getProgram($programNo) {
        $queryRes = ProgramsDB::getProgramsByNo($programNo);

        if ($queryRes) {
        //this query only returns a single row, so 
        //just process it
        return self::rowToProgram($queryRes);
        } else {
            return false;
        }
    }

    //function to delete a person by their PersonNo 
    public static function deleteProgram($programNo) { 
        //no special processing needed - just use the 
        //DB function
        return ProgramsDB::deleteProgram($programNo);
    }
    //function to add a person to the DB
    public static function addProgram($program) { 
        return ProgramsDB::addProgram(
            $program->getName(),
            $program->getAddress(),
            $program->getTreatments(),
            $program->getBeds());
    }

    //function to update a person's information 
    public static function updateProgram($program) { 
        return ProgramsDB::updateProgram(
            $program->getProgramNo(),
            $program->getName(),
            $program->getAddress(),
            $program->getTreatments(),
            $program->getBeds());
    }
}