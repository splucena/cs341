<?php

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}

function checkString($stringValue) {
    $valString = filter_var($stringValue, FILTER_SANITIZE_STRING);
    return $valString;
}

function checkFloat($floatValue) {
    // sanitize float
    $valFloat = filter_var($floatValue, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    return $valFloat;
}

function checkInt($intValue) {
    // sanitize integer
    $valInt = filter_var($intValue, FILTER_SANITIZE_NUMBER_INT);
    return $valInt;
}