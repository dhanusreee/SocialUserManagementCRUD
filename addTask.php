<?php
include_once 'class.php';
session_start();
if (!isset($_SESSION["username"])) {
    header("location: login.php");
}
$user   = new User();

$result = "";
$errors = "";


if (isset($_POST['submit'])) {
    $target = "/uploads";

    $image      = $_FILES['fileToUpload']['name'];
    $file       = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "uploads/$image");
    $name       = $_POST['name'];
    $email      = $_POST['email'];
    $address    = $_POST['address'];
    $dob        = $_POST['dob'];
    $status     = $_POST['status'];
    $education  = $_POST['education'];
    $pincode    = $_POST['pincode'];
    $country    = $_POST['country'];
    $city       = $_POST['city'];


        $result = $user->addTask($name, $email, $address, $dob, $status, $image, $education, $pincode,$country,$city);
        if ($result) {
            header("location:addTask.php");
        } else {
            echo "failed";
        }
    
}

?>
<html>
<head>
   <title>Add Tasks</title>
  <style type="text/css">

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 75%;
  margin-left: 90px;
}

td,th,tr{
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

.avatar {
   position: absolute;

  left: 1246px;
  bottom: 550px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
}
.addBtn-container{

   padding-top: 60px;
   margin-left: 600px;
   margin-top: 88px;
  padding: 8px;
  width: 10%;
  background: #d9d9d9;
  color: red;
  float: left;
  font-weight: bold;
  text-align: center;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
  border-radius: 0;
}
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 800px;
  padding: 20px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text]{
  width: 75%;
  padding: 10px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}
.form-container input[type=email]{
  width: 75%;
  padding: 10px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}
.form-container input[type=dob]{
  width: 75%;
  padding: 10px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}
.form-container textarea[name=address]{
  width: 75%;
  padding: 10px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 75%;
  margin-bottom:20px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
.buu{
  height:40px;
  width:60px;
}
.mime{
  height:40px;
  width: 200px;
  color: black;
    text-align: center;
     background-color: pink; 
     color: black; 
}
.vibe{
  height:40px;
  width: 200px;
  color: black;
  text-align: center;
  background-color: green; 
  color: black; 
}
.avatar {

  top: 21px;
  bottom: 600px;
  width: 57px;
  height: 55px;
  border-radius: 50%;
  float: left;
}
.loo
{
  margin-left: 1200px; 
}
.img {
    width: 45px;
    border-radius: 20px;
    float: left;
}

.tub{
  margin-left:  2px;
 /* padding-left: 95px;*/
  text-align: center;
  font-family: bold;
}
.disable{
  cursor:not-allowed;
  text-decoration: none;
  pointer-events: none;
  opacity: .4;

}
.page {
    display: inline-block;
    padding-left: 532px;
    margin: 20px 0;
    border-radius: 4px;
}
</style>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
<link rel="icon" href="https://www.myclientsplus.com/media/1007/task2fpractice-management.png" type="image/png" sizes="16x16">
</head>
<body>

  <h2 style="margin:7px;text-align: center;">User Management List</h2>
  <div class="img">
        <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar" class="avatar">

        <div class="loo">
                  <?php
         print_r($_SESSION['username']);?>
        <a href="logout.php" input type="Submit" name="LOGOUT" class="btn btn-success">LOGOUT</a>
      </div>
      </div>

<button class="open-button" onclick="openForm()">New Task</button>

  <div class="form-popup" id="myForm">
  <form action="" class="form-container" method="POST" enctype="multipart/form-data">
          <label>Name:</label>
          <input type="text" placeholder="Enter your Name" name="name" ><br>
          <label>Email ID:</label>
          <input type="email" placeholder="Enter your Email" name="email" ><br>
          <label>Address:</label>
          <textarea name="address" id="address" placeholder="Enter your Address..."></textarea><br>
          <label for="Date" ><b>DOB</b></label>
          <input type="Date" id="dateSelector" name="dob"><br>
          <label>Status:</label><br>
          <input type="radio" name="status" value="Active">
          <label for="Active">Active</label><br>
          <input type="radio" name="status" value="InActive">
          <label for="InActive">InActive</label><br>
          <label for="education">Education:</label>
          <select name="education" id="education">
            <option value="SSLC">SSLC</option>
            <option value="HSC">HSC</option>
            <option value="UG">UG</option>
            <option value="PG">PG</option>
          </select><br>
          <label>Pin Code:</label>
         <input type="text" placeholder="Enter your PINCODE" name="pincode" >
         <div class="form-group">
            <label for="country">Country</label>
            <select class="form-control" id="country-dropdown" name="country">
                <option value="">Select Country</option>
            <?php
            $result = $user->Country();
            while($row = mysqli_fetch_array($result)) {
            ?>
            <option value="<?php echo $row['id'];?>"><?php echo $row["name"];?></option>
            <?php
            }
            ?>
            </select>
            </div>
        <div class="form-group">
            <label for="city">City</label>
            <select class="form-control" name="city" id="city-dropdown">
            </select>
        </div>   
         <input type="file" name="fileToUpload"> <br>


    <button type="submit" name="submit" class="btn btn-success tub">ADD task</button>

    </form>
  <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

</div>
</table>
</form>
</div>
</div>

<!-- filter the datas -->

 <form method='post' action=''>
      <table style="width: 80%; height: 10%">
        <tr>    

    <td><b>Choose DOB: </b> <input type='date' class='form-control' name='dob'></td>

    <td><b>Search: </b> <input type="text" class='form-control' name="value" placeholder="Search the values"></td>

    <td><b>Status By:</b>
    <?php
echo "<html>";
echo "<body>";
echo "<select name='status' class='form-control'>";
echo '<option value="">--Status--</option>';
echo '<option value="Active">Active</option>';
echo '<option value="InActive">InActive</option>';

echo "</select>";
echo "</body>";
echo "</html>";
?></td><td><Button type="Submit" name="filter" class="btn btn-danger">Filter</Button></td><br><br><Br><br>


    <?php
    if (isset($_POST['filter'])) {
    
    $status      = $_POST['status'];
    $value  = (!empty($_POST['value'])) ? $_POST['value'] : '';
    $Dob    = $_POST['dob'];
    $filter    = $user->Task($value,$status,$Dob);

    echo "
       <table style='width: 70%; height:40%; text-align:center;'>
     <tr>
                         <th style='height:20%;width:3%;text-align:center;'>ID</th>
                         <th style='text-align:center;'>Profile Image</th>
                         <th style='text-align:center;'>Name</th>
                         <th style='text-align:center;'>Age</th>
                         <th style='text-align:center;'>Status</th>
                         <th colspan = '2' style='text-align: center;'>Action</th>

     </tr><br>";

    $i = 1;
    while ($row = mysqli_fetch_array($filter)) {

        echo "<tr>";
        echo "<td>" . $i . "</td>";           
        ?><td><img src="uploads/<?php echo $row['image']; ?>" ></img> </td><?php
        echo "<td>" . $row['name'] . "</td>";
        $today = date("Y-m-d");
        $diff = date_diff(date_create($row['dob']), date_create($today));
        echo "<td>" . $diff->format('%y') . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>" . '<a href="Edit.php?id=' . $row['user_details_id'] . '"><Button type="Submit" value="Edit" class="btn btn-primary" >Edit</Button></a>' . "</td>";
        echo "<td>" . '<Button type="Submit" value=' . $row['user_details_id'] . ' class="btn btn-success" onClick="display_alert(this.value);">Delete</Button>' . "</td>";
        echo "</tr>";
        $i++;
    }


} else {

    ?>
    </tr>
 <script src="jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>

                function display_alert(val) {
                    if (confirm('Are you sure you want to delete?')) {
                    console.log(val);
                    $.ajax({
                    type: "POST",
                    url: "Delete.php",
                    data:'id='+val,
                    success: function(){
                    location.reload();
                    }
                });

                } else {
                    console.log(0);
                }

                }

        </script>
   </table>

   </form>


<table style="width: 70% ; height:40%; text-align:center;">
     <tr>
                         <th style='height:20%;width:3%;text-align:center;'>ID</th>
                         <th style='text-align:center;'>Profile Image</th>
                         <th style='text-align:center;'>Name</th>
                         <th style='text-align:center;'>Age</th>
                         <th style='text-align:center;'>Status</th>
                         <th colspan = '2' style='text-align: center;'>Action</th>

     </tr>
<?php

    $status   = '';
    $value  = "";
    $Dob = "";
    $filter = $user->Task($value,$status,$Dob);

    $i = 1;

                       

    while ($row = mysqli_fetch_array($filter)) {

        echo "<tr>";
        echo "<td>" . $i . "</td>";           
        ?><td><img src="uploads/<?php echo $row['image']; ?>" width ="90px" height="70px"></img> </td><?php
        echo "<td>" . $row['name'] . "</td>";
       
        $today = date("Y-m-d");
        $diff = date_diff(date_create($row['dob']), date_create($today));
        echo "<td>" . $diff->format('%y') . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>" . '<a href="Edit.php?id=' . $row['user_details_id'] . '"><Button type="Submit" value="Edit" class="btn btn-primary" >Edit</Button></a>' . "</td>";
        echo "<td>" . '<Button type="Submit" value=' . $row['user_details_id'] . ' class="btn btn-success" onClick="display_alert(this.value);">Delete</Button>' . "</td>";
        echo "</tr>";
        $i++;
    }
}
?>
<script src="jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>

                function display_alert(val) {
                    if (confirm('Are you sure you want to delete?')) {
                    console.log(val);
                    $.ajax({
                    type: "POST",
                    url: "Delete.php",
                    data:'id='+val,
                    success: function(){
                    location.reload();
                    }
                });

                } else {
                    console.log(0);
                }

                }

        </script>
 </table>
</body><br><br>
     

<script>
$(document).ready(function() {
$('#country-dropdown').on('change', function() {
var country_id = this.value;
$.ajax({
url: "CountryCity.php",
type: "POST",
data: {
country_id: country_id
},
cache: false,
success: function(result){
$("#city-dropdown").html(result);
}
});
});    
});
</script>
</html>
