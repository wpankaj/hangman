/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){

    //startGame();
   
    $(".alphabets").click(function(){
        
        var selected_character = ($(this).html());
        $.ajax({
            url: "wrapper.php", 
            type:"GET",
            cache:false,
            async:true,
            data:"func=addAttempt&char="+selected_character,
            success: function(result){
                if(result == "-1")
                {
                    $("#msg_div").html(selected_character+" not found");
                    
                }
                else if(result=="-2")
                {
                    $("#msg_div").html("Invalid Click(Seems you already clicked "+selected_character+")");
                }
                    
                else
                {
                    var all_indexes= result.split("|");
                    for(i=0;i<all_indexes.length;i++)
                    {
                        //alert(all_indexes.length);
                        var placeholder = all_indexes[i]; 
                        $("#word-"+placeholder).html(selected_character);
                    }
                    $("#msg_div").html(selected_character+" found");
                    
                }
                
            }
        });
        $(this).addClass('btn-default').addClass('disabled');
        // so that you cant click a button twice
        fillDebugDiv();
        checkResult();
    });
   
     $("#start_new_game").click(function(){
        
        $.ajax({
            
            url: "wrapper.php", 
            type:"GET",
            cache:false,
            async:true,
            data:"func=startGame",
            success: function(result){
                location.reload();
                $("#msg_div").html(result);
            }
        });
    });
   
});//documet.ready


function fillDebugDiv()
{
    $.ajax({
            url: "wrapper.php", 
            type:"GET",
            cache:false,
            async:true,
            data:"func=debugDiv",
            success: function(result){
                $("#debug_div").html(result);
            }
        });
}

function checkResult()
{
    $.ajax({
        url: "wrapper.php", 
        type:"GET",
        cache:false,
        async:true,
        data:"func=checkResult",
        success: function(result){
            $("#debug_div").html(result);
        }
    });
}