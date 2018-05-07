<?php

function dd($variable){
    echo '<pre>' . print_r($variable, true) . '</pre>';
    die();
}



