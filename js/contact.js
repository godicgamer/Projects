$(document).ready(function() {
    $("#submit_btn").click(function() { 

        //get input field values
        var user_name       = $('input[name=name]').val(); 
        var user_email      = $('input[name=email]').val();
        var user_message    = $('textarea[name=message]').val();

        $.ajaxSetup({cache: false});
        //simple validation at client's end
        //we simply change border color to red if empty field using .css()
        var proceed = true;


        //everything looks good! proceed...
        if(proceed) 
        {
            //data to be sent to server
            post_data = {
                'userName':user_name,
                'userEmail':user_email,
                'userMessage':user_message,
            };
            
            //Ajax post data to server
            $.post('contact_me.php', post_data, function(response){  

                //load json data from server and output message     
				if(response.type == 'error')
				{
                    $('.modal-title').html('Form Error');
					output = '<div class="error">'+response.text+'</div>';
				}else{
                    $('.modal-title').html('Message sent!');
				    output = '<div class="success">'+response.text+'</div>';
					
					//reset values in all input fields
					$('input').val(''); 
					$('textarea').val('');
                    $('checkbox').checked = false;
				}
                $(".modal-body").html(output);
				$('#result').modal();
            }, 'json');
			
        }
    });
    
});