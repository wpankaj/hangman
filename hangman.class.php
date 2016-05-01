<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class hangman
{
    
    public function __construct() {
        
    }
    
    public function startGame(){
        
        $this->word = $this->getWord();
        $_SESSION["word"]=  $this->word;
        
        $this->game_started = true;
        $_SESSION["game_started"]=  $this->game_started;
    }
    
    public function addFailStep()
    {
        $this->num_fail ++;
        $_SESSION["num_fail"] =  $this->num_fail;
    }

    public function addPassStep()
    {
        $this->num_pass ++;
        $_SESSION["num_pass"] =  $this->num_pass;
    }
    
    public function hasWon(){}

    public function attempt(){}

    public function getWord()
    {
        
    }
}