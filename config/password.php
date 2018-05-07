<?php 

function str_random($lenght){
    $alphabet = "13283309HDGDHD4253DjhhsdckbkshgazDHftyahsdiiu634RJKBSKCJ";
    return substr(str_shuffle(str_repeat($alphabet, $lenght)), 0, $lenght);
}