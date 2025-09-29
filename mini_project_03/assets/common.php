<?php

function pwd_checker($password){
    $rules = array();

    $rules["1"] = lenchecker($password);
    $rules["2"] = capchecker($password);

    if (!preg_match('/[a-z]/', $password)) {
        $rules["3"] = "Your password must contain at least 1 lowercase letter";
    }
    if (!preg_match('/[a-zA-Z0-9]/', $password)) {
        $rules["4"] = "Your password must contain at least 1 Special Character";
    }
    if (!preg_match('/[0-9]/', $password)) {
        $rules["5"] = "Your password must contain at least 1 number";
    }

    return $rules;
}


function capchecker($password){
    if (!preg_match('/[A-Z]/', $password)) {
        return "Rule 2 - Fail: Your password must contain at least 1 uppercase letter";
    } else {
        return "Rule 2 - Pass: Your password must contain at least 1 uppercase letter";
    }
}

function lenchecker($password){
    if(strlen($password) < 8){
        return "Rule 1 - FAIL: Your password is less than 8 characters";
    }
    else{
        return "Rule 1 - Pass: Your password is longer than 8 characters";
    }
}