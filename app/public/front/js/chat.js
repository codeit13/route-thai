function getChatBody(){
	var chat_to = $('#chat_to').val();
	var chat_from = $('#chat_from').val();
	$.ajax({
        url: message_url,
        type:'post',
        dataType:'json',
        data:{_token: token,to_user:chat_to,from_user:chat_from},
        beforeSend:function(){
        },
        complete:function(){
        },
        success:function(res){
        	if (res.success == true) {
        		$('#chat_body').html(res.chat_body);
        	}
        }
    });
}

getChatBody()
setInterval(getChatBody,1000);

$('#content_button').click(function(){
	var content = $('#content_message').val();
	var chat_to = $('#chat_to').val();
	var chat_from = $('#chat_from').val();
    if (content != '') {
    	$.ajax({
            url: message_save_url,
            type:'post',
            dataType:'json',
            data:{_token: token,to_user:chat_to,from_user:chat_from,content:content},
            beforeSend:function(){
            },
            complete:function(){
            },
            success:function(res){
            	if (res.success == true) {
            		$('#chat_body').html(res.chat_body);
                    $('#content_message').val('');
            	}
            }
        });
    }
});