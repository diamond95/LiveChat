<?php
include('database_connection.php');
session_start();

$query = "SELECT * FROM login WHERE user_id != '".$_SESSION['user_id']."'";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$output = '<table class="table table-bordered table-striped">';
	foreach($result as $row){
		$status = '';
		$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
		$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
		$user_last_activity = fetch_user_last_activity($row['user_id'], $connect);
		if($user_last_activity > $current_timestamp){
			$status = '<h2><span class="label label-success">Online</span></h2>';
		} else {
			$status = '<h2><span class="label label-danger">Offline</span></h2>';
		}
	$output .= '
	 <tr>
	  <td><h2><font color="white">'.$row['username'].' '.count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect).'</font></h2></td>
	  <td>'.$status.'</td>
	  <td><button type="button" style="width:80px" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'"><h4>Start Chat</h4></button></td>
	 </tr>
	 ';
	}
$output .= '</table>';

echo $output;

?>
