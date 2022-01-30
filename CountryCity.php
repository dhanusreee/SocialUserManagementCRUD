<?php
 $servername='localhost';
    $username='root';
    $password='';
    $dbname = "todo";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
      if(!$conn){
          die('Could not Connect MySql Server:' .mysql_error());
        }

$country_id = $_POST["country_id"];
$result = mysqli_query($conn,"SELECT * FROM city where country_id = $country_id");
?>
<option value="">Select City</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["id"];?>"><?php echo $row["city_name"];?></option>
<?php
}
?>