<?php

function pwd_checker($password){
    $rules = array();

    $rules["1"] = lenchecker($password);
    $rules["2"] = capchecker($password);
    $rules["3"] = lowerchecker($password);
    $rules["4"] = specialchecker($password);
    $rules["5"] = "Rule 5 - " . numchecker($password). "Your Password must contain a number";
    $rules["6"] = "Rule 6 - " . specialcheckerfirst($password[0]). "First character cannot be a special character";
    $rules["7"] = "Rule 7 - " . specialcheckerfirst($password[strlen($password)]). "Last character cannot be a special character";
    $rules["8"] = pwdcontains($password);
    $rules["9"] = "Rule 9 - " . numchecker($password[0]). "Your password cannot start with a number";
    return $rules;
}

function pwdcontains($password){
    if(str_contains($password, "password") OR str_contains($password,"Password") OR str_contains($password, "PASSWORD")){
        return "Rule 8 - Fail: Your password should not contain the word password";
    } else {
        return "Rule 8 - Pass: Your password should not contain the word password";
    }
}

function specialcheckerfirst($password){
    if (preg_match('/[^a-zA-Z0-9]/', $password)) {
            return "Fail: ";
    } else {
        return "Pass: ";
    }
}

function numchecker($password){
    if (!preg_match('/[0-9]/', $password)) {
        if(strlen($password)==1){
            return "Pass: ";
        } else {
            return "Fail: ";
        }
    } else {
        return "Pass: ";
    }
}

function specialchecker($password){
    if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        return "Rule 4 - Fail: Your password must contain at least 1 Special Character";
    } else {
        return "Rule 4 - Pass: Your password must contain at least 1 Special Character";
    }
}

function lowerchecker($password){
    if (!preg_match('/[a-z]/', $password)) {
        return "Rule 3 - Fail: Your password must contain at least 1 lowercase letter";
    } else {
        return "Rule 3 - Pass: Your password must contain at least 1 lowercase letter";
    }
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