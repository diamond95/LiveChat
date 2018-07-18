<?php
include('database_connection.php');
session_start();
$message = '';

if(isset($_SESSION['user_id'])) {
	header('location:index.php');
}

if(isset($_POST["login"])) {
	if(isset($_POST['username']) != "") {
		$query = "SELECT * FROM login WHERE username = :username";
		$statement = $connect->prepare($query);
		$statement->execute(array(':username' => $_POST["username"]));
		$count = $statement->rowCount();
			if($count > 0) {
					$result = $statement->fetchAll();
				foreach($result as $row){
					if(password_verify($_POST["password"], $row["password"])){
						$_SESSION['user_id'] = $row['user_id'];
						$_SESSION['username'] = $row['username'];
						$sub_query = "INSERT INTO login_details (user_id) VALUES ('".$row['user_id']."')";
						$statement = $connect->prepare($sub_query);
						$statement->execute();
						$_SESSION['login_details_id'] = $connect->lastInsertId();
						header("location:index.php");
						sleep(2); // to show gif loading icon
					} else {
						$message = "<label>Wrong Password</label>";
					}
				}
			} else {
				$message = "<label>Wrong Username</labe>";
			}
	} else {
		$message = "<label>Enter Username</labe>";
	}
}
?>

<html> 

	<head>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<link rel="stylesheet" href="css/style.css">
	</head>
	
<body>
	<br /><br /><br /><br /><br />
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<h1 class="text-center login-title font">Sign in to continue to Chat</h1>
				<div class="account-wall">
					<img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
						alt="">
					<form method="POST" class="form-signin">
						
					<input type="text" name="username" class="form-control" placeholder="Username"  autofocus autocomplete="off">
					<input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
					<button class="btn btn-lg btn-primary btn-block" id="login" name="login" type="submit">
						Sign in</button>
					
					<label class="checkbox pull-left">
						<input type="checkbox" value="remember-me">
						Remember me
					</label>
					<a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
					</form>
					<center><font size="4"><p class="text-danger font"><?php echo $message; ?></p></font></center>
					<br />
					<br /> 
					<center><b>Login details:</b> <br />
					username: admin <br />
					password: admin <br />
					--- <br />
					username: user <br />
					password: admin <br />
					--- <br />
					username: test <br />
					password: admin <br />
					
					</center>
				</div>
				<a href="#" class="text-center new-account">Create an account </a>
			</div>
		</div>
	</div>
</body>
<script>
		$(function(){
			$("#login").click(function(){
				$(this).after("<br /><br /><center><img src='images/prijava.gif' width='25px' alt='loading' />").fadeIn();   // loader icon
			});
		});
</script>  
</html>
