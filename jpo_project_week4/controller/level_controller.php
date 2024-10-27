<?php
include_once('level.php');
include_once('../model/level_db.php');

class LevelController {
    public static function getAllLevels() { 
        $queryRes = LevelDB::getLevel();

        if ($queryRes) {
        //process the results into an array of 
        //Role objects
        $level = array();
        foreach ($queryRes as $row) {
            $levels[] = new Level($row['UserLevelNo'],
                $row['LevelName']);
        }

            //return the array of Role information
            return $levels;
        } else {
            return false;
        }
    }
}