<?php
// for online / offline status  every few seconds refreshing 
include('database_connection.php');
session_start();
$query = "UPDATE login_details SET last_activity = now() WHERE login_details_id = '".$_SESSION["login_details_id"]."'";
$statement = $connect->prepare($query);
$statement->execute();

    //check for messages every 5 seconds - > notifications
	$query2 = "SELECT * FROM chat_message WHERE from_user_id = '$from_user_id' AND to_user_id = '$to_user_id' AND status = '1'";
	$statement2 = $connect->prepare($query2);
	$statement2->execute();
	$count2 = $statement2->rowCount();
	$output2 = '';
	if($count > 0){
		$output2 = '<span class="label label-success">'.$count2.'</span>';
	}
	return $output;

?>
