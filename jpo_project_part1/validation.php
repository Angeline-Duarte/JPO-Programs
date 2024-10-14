<?php
namespace Validation;

//Validate the length of a string, returning an error message //or a blank string; parameters passed by value
function stringValid($val, $len) {
    if (strlen($val) < $len)
        return 'Must be at least ' . $len. ' characters.';
    else
        return '';
}


//Validate that a value is numeric; throw an exception if 
//the value is not numeric - note the use of \Exception to 
//indicate the Exception class is not from the Validation 
//namespace
function numericValue($val) {
    if (!is_numeric($val)) {
        throw new \Exception('Invalid Zip Code - 5 digits only.');
    }
}

//Validate the length of a string, returning an error message //or a blank string; parameters passed by value
function NotesValid($val, $len) {
    if (strlen($val) < $len)
        return 'Maximum string length is ' . $len. ' characters.';
    else
        return '';
}