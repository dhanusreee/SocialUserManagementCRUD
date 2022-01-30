<?php
include 'class.php';
session_start();
if (!isset($_SESSION["username"])) {
    header("location: login.php");
}
$user = new User();
$id   = $_GET['id'];

$edit = $user->Edit_task($id);

$country = $user->Country();

if (isset($_POST['update'])) {
    $target = "/uploads";
    $image      = $_FILES['fileToUpload']['name'];
    $file       = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "uploads/$image");
    $name       = $_POST['name'];
    $id         = $_POST['user_details_id'];
    $email      = $_POST['email'];
    $address    = $_POST['address'];
    $dob        = $_POST['dob'];
    $status     = $_POST['status'];
    $education  = $_POST['education'];
    $pincode    = $_POST['pincode'];

     $update = $user->Update($name, $email, $address, $dob, $status, $image, $education, $pincode,$id);
        if ($update) {
        header('location:addTask.php');
        }
}


?>
<html>
<head>
  <title>Edit Details</title>
  <style type="text/css">

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 75%;
  margin-left: 90px;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
  font-family: bold;
}

.user-container{
  width: 200px;
  height: 150px;
  padding: 10px;
  background-color: white;
  margin:10px;
  overflow: hidden;
}
.user-container img{
  float: left;
  width:60px;

}
.buu{
  height:40px;
  width:60px;
}
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
   <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
  <link rel="icon" href="https://www.myclientsplus.com/media/1007/task2fpractice-management.png" type="image/png" sizes="16x16">
</head>
<body>

<div id="myDIV" class="header">
  <h2 style="margin:5px">My To-Do List</h2>
  <table>
   <form method="POST" action="" enctype="multipart/form-data">
  
   <tr><th>ID : </th><Td><input type="text" class="form-control" name="user_details_id" value="<?php echo $edit['user_details_id']; ?>" hidden></Td></tr><br>
   <tr><th>Name : </th><Td><input type="text" style="width:70%"class="form-control" name="name" value="<?php echo $edit['name']; ?>"></Td></tr><br>
   <tr><th>Email ID : </th><Td><input type="email" style="width:70%"class="form-control" name="email" value="<?php echo $edit['email']; ?>"></Td></tr><br>
   <tr><th>Address : </th><td>
   <textarea name="address" style="width:70%" class="form-control"><?php echo $edit['address']; ?>
   </textarea>
   </td><br>
   <tr><th>DOB : </th><td><input type="Date" class="form-control" style="width:70%" name="dob" value="<?php echo $edit['dob']; ?>"></td></tr><br>
   <tr><th>Status: </th><Td>
    <input type="radio" name="status" value="Active" checked> <b>Active</b><br> 
    <input type="radio" name="status" value="InActive"><b>InActive</b>
  </td></tr><br>

  <tr><th>Education : </th><Td>
  <select name="education" id="education">

  <option value="SSLC"<?php if($edit['education'] == 'SSLC') { ?> selected="selected"<?php } ?>>SSLC</option>
  <option value="HSC"<?php if($edit['education'] == 'HSC') { ?> selected="selected"<?php } ?>>HSC</option>
  <option value="UG"<?php if($edit['education'] == 'UG') { ?> selected="selected"<?php } ?>>UG</option>
  <option value="PG"<?php if($edit['education'] == 'PG') { ?> selected="selected"<?php } ?>>PG</option>
  </select>
   
  </td></tr><br>
   <tr><th>Pincode : </th><td><input type="text" class="form-control"style="width:70%" name="pincode" value="<?php echo $edit['pincode']; ?>"></td></tr><br>
  
   <tr><th>Profile Image : </th><td><input type="file" class="form-control" style="width:70%"name="image" value="<?php echo $edit['fileToUpload']; ?>"><img src="uploads/<?php echo $edit['image']; ?>" height="70" width="60" ></td></tr><br>

  </td></tr><br>
   <Button type="Submit" name="update" value="Update" class="btn btn-success">Update</Button>
   </form>
</table>


</body>

</html>
