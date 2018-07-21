<?php
include('database_connection.php');
session_start();
if(!isset($_SESSION['user_id'])){
	header("location:login.php");
}
?>

<html>  
    <head>  
        <title>Live Chat Application 2018</title>  
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src='https://cdn.rawgit.com/admsev/jquery-play-sound/master/jquery.playSound.js'></script>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
		<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
		<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
    </head>  
	<body>  
		<br />
		<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				
				<h3 align="center">Live Chat Application 2018</a></h3><br />
				<h4><p align="right">Hi - <?php echo $_SESSION['username'];  ?> - <a href="logout.php">Logout</a></p></h4>
				<div class="table100 ver3 m-b-110">
				
					<div class="table100-head">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="cell100 column1">USERNAME</th>
									<th class="cell100 column3">STATUS</th>
									<th class="cell100 column4">ACTION</th>
								</tr>
							</thead>
						</table>
					</div>
					<div class="table100-body js-pscroll">
						<table>
							<tbody>
								<tr class="row100 body">
									<div id="user_details"></div>
									<div id="user_model_details"></div>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>  

<script>  
$(document).ready(function(){
 fetch_user();
 setInterval(function(){
	update_last_activity();
	fetch_user();
 }, 5000);
 function fetch_user() {
	$.ajax({
		url:"fetch_user.php",
		method:"POST",
		success:function(data){
			$('#user_details').html(data);
		}
	})
 }
 function update_last_activity() {
	$.ajax({
		url:"update_last_activity.php",
		success:function(){}
	})
 }
function make_chat_dialog_box(to_user_id, to_user_name) {
	var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" style="background-color:" title="You have chat with '+to_user_name+'">';
	modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
	modal_content += '</div>';
	modal_content += '<div class="form-group">';
	modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control xd"></textarea>';
	modal_content += '</div><div class="form-group" align="right">';
	modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
	$('#user_model_details').html(modal_content);
}
$(document).on('click', '.start_chat', function(){
	var to_user_id = $(this).data('touserid');
	var to_user_name = $(this).data('tousername');
	make_chat_dialog_box(to_user_id, to_user_name);
	
	$("#user_dialog_"+to_user_id).dialog({
		autoOpen:false,
		width:400
	});
	$('#user_dialog_'+to_user_id).dialog('open');
		setInterval(function(){ // set interval for take messages for every 1 seconds and show into chat 
			refreshMsg();
		}, 1000); // <---- here 
function refreshMsg() {
	var hvatajPoruke = $.ajax({
		  url: "take_msg.php",
		  method: "POST",
		  data:{to_user_id:to_user_id},
		  success: function(data) {
			  $('#chat_history_'+to_user_id).html(data);
		  }
	 })
}
});
 //abort ajax call if user close chat :) 
$( ".selector" ).on( "dialogclose", function( event, ui ) {
		//alert("todo - later");
});
$(document).on('click', '.send_chat', function(){
	$.playSound("mp3/click.mp3") // here we set MP3 SOUND FOR "send" button click
	var to_user_id = $(this).attr('id');
	var chat_message = $('#chat_message_'+to_user_id).val();
	$.ajax({
			url:"insert_chat.php",
			method:"POST",
			data:{to_user_id:to_user_id, chat_message:chat_message},
		success:function(data){
			$('#chat_message_'+to_user_id).val('');
			$('#chat_history_'+to_user_id).html(data);
		}
	})
 });
 
});  
</script>
