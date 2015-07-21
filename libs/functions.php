<?php

function redirect_to($location = NULL){
    if($location != NULL){
        header("Location: $location");
        exit; //why do we have to exit?
    }
}

