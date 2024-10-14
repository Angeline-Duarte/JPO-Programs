<?php
//Class to represent an entry in the users table
class Student {
    //properties - match the columns in the users table
    private $studentNo;
    private $studentId;
    private $fName; 
    private $lName; 
    private $dob;
    private $programNo;
    private $programName;
    private $charges;
    private $grade;

    public function __construct($studentId, $fName, $lName, $dob, $programNo, $programName, $charges, $grade)
    {
        $this->studentId = $studentId;
        $this->fName = $fName;
        $this->lName = $lName;
        $this->dob = $dob;
        $this->programNo = $programNo;
        $this->programName = $programName;
        $this->charges = $charges;
        $this->grade = $grade;
    }

    //get and set the person properties
    public function getStudentNo() { 
        return $this->studentNo;
    }
    public function setStudentNo($value) {
        $this->studentNo = $value;
    }
    public function getStudentId() { 
        return $this->studentId;
    }
    public function setStudentId($value) {
        $this->studentId = $value;
    }
   
    public function getStudentFirstName() { 
        return $this->fName;
    }
    public function setStudentFirstName($value) { 
        $this->fName = $value;
    }
    public function getStudentLastName() {
        return $this->lName;
    }
    public function setStudentLastName($value) {
        $this->lName = $value;
    }
    public function getDOB() {
        return $this->dob;
    }
    public function setDOB($value) {
         $this->dob = $value;
    }
    public function getProgramNo() {
        return $this->programNo;
    }
    public function setProgramNo($value) {
        $this->programNo = $value;
    }
    public function getProgramName() { 
        return $this->programName;
    }
    public function setProgramName($value) { 
        $this->programName = $value;
    }
    public function getCharges() { 
        return $this->charges;
    }
    public function setCharges($value) { 
        $this->charges = $value;
    }
    public function getGrade() {
        return $this->grade;
    }
    public function setGrade($value) {
        $this->grade = $value;
    }
}