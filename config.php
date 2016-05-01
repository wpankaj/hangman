<?php

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$root_dir = $protocol.$_SERVER["HTTP_HOST"]."/";
//make it webpath of directory where game exist


//one can use and create this array from the backend
session_start();
$alphabets = range('A', 'Z');

$db_words = Array(
                    "ENGLISH", "DICTIONARY", "EASY", "COMPLEX", 
                    "THIS", "THAT", "MEDIUM","ENCYCLOPEDIA", "ENGLAND", "APPLE"
            );

$num_allowed = 6;
//max chances to be given in the game (or in how many steps does hangman hangs himself)

$show_debug_text=true;