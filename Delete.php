<?php

include 'class.php';
// include 'addTask.php';
session_start();
if(!isset($_SESSION["username"])){
 header("location: login.php");
 }
$id = $_POST['id'];
$user = new User();
$del=$user->Delete_task($id);
print_r($del);
if($del>0)
{
	header('location:addTask.php');
}			
else
{
	echo "error";
}
?>