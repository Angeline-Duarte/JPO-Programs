<?php
//Role class to represent a single entry in the
//Roles table
class Level {
    //class properties- match the columns in the
    //Roles table; control access via get/set
    //methods and the constructor
    private $userLevelNo;
    private $levelName;

    public function __construct($userLevelNo, $levelName) {
        $this->roleNo = $userLevelNo; 
        $this->roleName = $levelName;
    }

    //get and set the roleNo property 
    public function getUserLevelNo() {
        return $this->userLevelNo;
    }
    public function setUserLevelNo($value) {
        $this->userLevelNo = $value;
    }

    //get and set roleName property 
    public function getLevelName() {
        return $this->levelName;
    }

    public function setLevelName($value) {
        $this->levelName = $value;
    }
}