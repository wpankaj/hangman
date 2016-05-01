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
        startGame();
    });
    
    $('#result_modal').on('hidden.bs.modal', function () {
        startGame();
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
    $("#result_div").html("");
    $.ajax({
        url: "wrapper.php", 
        type:"GET",
        dataType: "json",
        cache:false,
        async:true,
        data:"func=checkResult",
        success: function(result){
            $("#chance-"+result.Fail).addClass("fa-thumbs-o-down").removeClass("fa-thumbs-o-up");
            $.each(result, function( key, val ) {
                $("#result_div").append(key+":"+val+"&nbsp;&nbsp;");
                
            });
            
            if(result.Result=="WON")
            {
                $("#result_modal_title").html("Congratulations!");
                $("#result_modal_body").html("You won this game. Click Close to start New Game");
                $('#result_modal').modal('show');
            }
            if(result.Result=="LOST")
            {
                $("#result_modal_title").html("Sorry! ");
                $("#result_modal_body").html("Seems like you ran out of chances. Better luck next time. Close Dialog to Start New Game");
                $('#result_modal').modal('show');
            }
             
        }
    });
}


function startGame()
{
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
}


//function explode()