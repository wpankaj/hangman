<?php
require_once 'config.php';// contains globals
include_once 'start-page.php'; // contains html start code/js/css/static

if(isset($_SESSION["game_started"]))
{
    //startGame();//from wrapper
    header("location:./index.php");
}

?>

<div class="container">
    
    <br>
    <div class="text-center">
        <a href="javascript:void(0);" class="btn btn-lg btn-danger" id="start_new_game">Start a new game</a>
        
    </div>
    
</div>

<?php
include_once 'end-page.php';
?>