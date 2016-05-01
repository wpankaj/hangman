<?php
require_once 'config.php';// contains globals
include_once 'start-page.php'; // contains html start code/js/css/static

$num_allowed = $num_allowed;//frm config

if(!isset($_SESSION["game_started"]))
{
    $hangman->startGame();//from wrapper
}

$word = isset($_SESSION["word"])?$_SESSION["word"]:null;
?>

<div class="container">
    
    <h1 class="text-center">Play Hangman</h1>
    <hr>
    
    <!--mystery word div starts-->
    <div class="text-center">
        <nav>
            <ul class="pagination well">
                <?php

                    for($i=0;$i<=strlen($word)-1;$i++)
                    {
                        $display_val = (isset($_SESSION["attempts"]) and in_array($word[$i], $_SESSION["attempts"])) ? $word[$i] : "_";
                ?>
                    
                    <li><h1 style="display:inline;" id="word-<?php echo $i;?>"><?php echo $display_val; ?></h1></li>
                <?php
                    }
                ?>
            </ul>
        </nav>
    </div>
    <!--mystery word div ends-->
    
    
    <br>
    
    <!--alphabets/clickable controls starts here-->
    <div class=" text-center">
        <?php
            foreach($alphabets as $alphabet)
            {
                $display_class = (isset($_SESSION["attempts"]) and in_array($alphabet, $_SESSION["attempts"])) ? " disabled" : "";
        ?>
            <a class="btn btn-success alphabets <?php echo $display_class?>"><?php echo $alphabet;?></a>
        <?php
            }
        ?>
        
    </div>
    <br>
    <div id="msg_div" class="text-success text-center"></div>

    <!--alphabets/clickable controls ends -->
    
    <br>
    
    <!--
        I have substituted the classic hangman image with "Chances Left control", 
        this is for the sake of making the chances configurable.
    -->
    <div class="text-center">
        <h3>Number of Chances Left</h3> 
        <?php
            for($i=1;$i<=$num_allowed;$i++)
            {
        ?>
            <i class="fa fa-thumbs-o-up fa-3x"></i>
        <?php
            }
        ?>
        
    </div>
    
    <hr>
    <!--Start New Game Control-->
    <div class="text-center">
        <a href="javascript:void(0);" class="btn btn-lg btn-danger" id="start_new_game">Start a new game</a>
        
    </div>
    <!--Start game control ends-->
    
    
    
    <!--Debug Control-->
    <div id="debug_div" class="text-sm text-danger"></div>
    <!--Debug control ends -->
    
    
</div>

<?php
include_once 'end-page.php';
?>