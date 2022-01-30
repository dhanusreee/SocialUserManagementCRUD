<?php

include_once 'class.php';
$user = new User();

$nameErr  = "";
$emailErr = "";
$passErr  = "";
$phErr    = "";

if (isset($_POST['submit'])) {
    $name = $_POST["name"];

    $pass = $_POST["pass"];

    $email = $_POST["email"];

    $ph_no = $_POST["ph_no"];

    $date_num = $_POST["date_num"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        if (empty($_POST["pass"])) {
            $passErr = "Password is required";
        }

        if (empty($_POST["ph_no"])) {
            $phErr = "Number is required";
        } else {
            $ph_no = test_input($_POST["ph_no"]);
            if (preg_match("/^[6-9][0-9]{9}$/", $_POST["ph_no"]) == 0) {
                $phErr = "Phone Number should contain 10 digits";
            }
        }

    }
    $result = $user->Register($name, $pass, $email, $ph_no, $date_num);
    if ($result) {
        header("location:login.php");
    } else {
        echo "registration failed";
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Todo Signup</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="icon" href="https://www.myclientsplus.com/media/1007/task2fpractice-management.png" type="image/png" sizes="16x16">
  <style>
.error {color: #FF0000;}
  .tub{
  margin-left:  100px;
  padding-left: 15px;
  width: 105px;
  font-size: 20px;
  text-align: center;
  font-weight: bold;
}
.type{
  font-family:Times New Roman ,Georgia;
  font-size: 20px;
}

</style>
</head>
<body class="container">
<div id="login_form">
  <div class="type">
    <h1><center>Sign Up User</center></h1>
  
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="username"><b>Username:</b> </label>
      <input type="text" class="form-control" id="name" name="name">
       <span class="error">* <?php echo $nameErr; ?></span>
    </div>

     <div class="form-group">
      <label for="Password"><b>Password:</b></label>
      <input type="password" class="form-control" id="pass" name="pass" >
       <span class="error">* <?php echo $passErr; ?></span>
    </div>

    <div class="form-group">
      <label for="email"><b>Email:</b></label>
      <input type="email" class="form-control" id="email" name="email">
      <span class="error">* <?php echo $emailErr; ?></span>
    </div>

     <div class="form-group">
      <label for="Contact Number"><b>Contact Number:</b></label>
      <input type="text" class="form-control" id="ph_no" name="ph_no">
      <span class="error">* <?php echo $phErr; ?></span>
    </div>

    <div class="form-group">
      <label for="Contact Number"><b>Account Created:</b></label>
      <input type="Date" class="form-control" id="date_num" name="date_num">

    </div><br><br>
    <button type="submit" name="submit" id="submit" class="btn btn-primary tub">Register</button>
  </form>
</div>
</div>
</body>

</html>
