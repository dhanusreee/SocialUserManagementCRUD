
<?php

include_once 'class.php';

$user = new User();

if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $pass = md5($_POST['pass']);
    session_start();
    $_SESSION['username'] = $name;
    $result = $user->login($name, $pass);
    if ($result) {
        header("location:addTask.php");
    } else {
       echo "<script>confirm('Login Failed!! Please Enter correct username and password');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.tub{
	margin-left:  100px;
	padding-left: 95px;
	width: 105px;
	font-size: 20px;

}
.type{
	font-family:Times New Roman ,Georgia;
	font-size: 20px;
}
	</style>
	<title>Todo Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" href="https://www.myclientsplus.com/media/1007/task2fpractice-management.png" type="image/png" sizes="16x16">
</head>
<body class="container">
<div id="login_form">
	<div class="type">
		<h1>Todo Login</h1>
	
	<form action="" method="POST">
	  <div class="form-group">
	    <label for="username"><b>Username: </b></label>
	    <input type="text" class="form-control" id="name" name="name" autofocus="on">
	  </div><Br>
	  <div class="form-group">
	    <label for="password"><b>Password: </b></label>
	    <input type="password" class="form-control" id="pass" name="pass">
	  </div><br><br>
	  	  	<button type="submit" name="submit" class="btn btn-primary tub">Login</button>
	  	</form><br>
		
		<a href="sign_up.php">Create an account!!</a>	
		
</div>
</div>
</body>
</html>