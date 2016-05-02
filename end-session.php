<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$_SESSION = array();
session_destroy();
echo "session ended. Go to <a href=\"index.php\">Home</a>";