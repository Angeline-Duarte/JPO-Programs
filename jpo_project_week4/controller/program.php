<?php
//Class to represent an entry in the users table
class Program {
    //properties - match the columns in the users table
    private $programNo;
    private $name; 
    private $address;
    private $treatments;
    private $beds;

    public function __construct($name, $address, $treatments, $beds)
    {
        $this->name=$name;
        $this->address = $address;
        $this->treatments = $treatments;
        $this->beds = $beds;
    }

    //get and set the person properties
    public function getProgramNo() { 
        return $this->programNo;
    }
    public function setProgramNo($value) {
        $this->programNo = $value;
    }
   
    public function getName() { 
        return $this->name;
    }
    public function setName($value) { 
        $this->name = $value;
    }
    public function getAddress() {
        return $this->address;
    }
    public function setAddress($value) {
        $this->address = $value;
    }
    public function getTreatments() {
        return $this->treatments;
    }
    public function setTreatments($value) {
         $this->treatments = $value;
    }
    public function getBeds() {
        return $this->beds;
    }
    public function setBeds($value) {
        $this->beds = $value;
    }
   
}