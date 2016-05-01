<?php

require_once 'config.php';
$function_name = $_GET["func"];


//if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
    if($function_name=="startGame") {
        if(startGame())
        {
            $out="Game Started";
        }
        else
        {
            $out="Something went wrong starting the game";
        }
    }

    //2.
    if($function_name=="addAttempt") 
    {
        //this fnction is called when any character button is pressed
        //it further checks charater in a perticular word. 
        // if char found, returns the index numners, else -1
        $returned_val = addAttempt($_GET["char"]);
        $out = isset($returned_val)? $returned_val:"-1";
        
    }
    
    if($function_name=="debugDiv") 
    {
        //for appending the debug control and shows you all the session values
        $out = "<b>Debug Text</b><br><i>This is not and error, it displays all the game/session values:</i><br> ".print_r($_SESSION, true);
        
    }
    
    if($function_name=="checkResult") 
    {
        $out="NR";//no result by default and game will continue
        if($_SESSION["num_fail"]>=$num_allowed)
        {
            $out = "LOST";
        }
        else
        {
            $word = $_SESSION["word"];
            $fail=0;
            $pass=0;
            for($i=0;$i<=strlen($word)-1;$i++)
            {
                if(in_array( trim(strtoupper($word[$i])), $_SESSION["attempts"]) )
                {
                   $pass++;
                }
                else
                {
                    $fail++;
                }
            }
            
            if($pass==strlen($word) and $fail==0)
            {
                $out = "WON";
            }
        }
        
        $out=Array("Result"=>$out, "Pass"=>$_SESSION["num_pass"], "Fail"=>$_SESSION["num_fail"]);
        $out=json_encode($out);
        
    }
    
    echo $out;
//}
//else
//{
//    exit("No Kidding with this Page");
//}
    
    
    
function getWord()
{
    GLOBAL $db_words;
    return $db_words[array_rand($db_words)];
}

function startGame()
{
    $_SESSION=ARRAY();
    $_SESSION["game_started"]=true;
    $_SESSION["game_ended"]=false;
    $_SESSION["num_attempts"] = 0;
    $_SESSION["num_fail"] = 0;
    $_SESSION["num_pass"]=0;
    $_SESSION["word"] = getWord();
    $_SESSION["attempts"]=Array();
    return true;
}

function addFailStep()
{
    $_SESSION["num_fail"]++;
}
function addPassStep()
{
    $_SESSION["num_pass"]++;
}
function addAttempt($char)
{
    if(!in_array($char, $_SESSION["attempts"]))
    {
        $_SESSION["num_attempts"]++;
        array_push($_SESSION["attempts"], $char);
        $return_val= checkCharacter($char);
        //returns index number if the correct charater, else returns -1 for not found
        
        if($return_val=="-1")
        {
            addFailStep();
        }
        else {
            addPassStep();
        }
        
        return $return_val;
    }
    else
    {
        return "-2";
    }
}


function checkCharacter($char)
{
    $out_arr=Array();
           
    if(isset($_SESSION["word"]) and isset($_SESSION["game_started"]))
    {
        $word = $_SESSION["word"];

        for($i=0;$i<=strlen($word)-1;$i++)
        {
            if(trim(strtoupper($char))==trim(strtoupper($word[$i])))
            {
                array_push($out_arr, $i);
            }
        }
    }
    if(is_array($out_arr) and count($out_arr)>0)
    {
        return implode("|", $out_arr);
    }
    else
    {
        return "-1";
    }
        //$out = $hangman->getName();
}

function debugDiv()
{
    if(is_array($_SESSION) and count($_SESSION)>0)
    {
        foreach($_SESSION as $k =>$v)
        {
            
        }
    }
}