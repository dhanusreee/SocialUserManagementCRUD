<?php

class User
{

    public function __construct()
    {

        $this->con = mysqli_connect("localhost", "root", "", "todo");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

    }
    // Login
    public function login($name, $pass)
    {
//       $password = md5($pass);
      $c = "Select s.name,s.pass from sign_up as s where name='" . $name . "' and pass='" . $pass . "' ";
        $sql = mysqli_query($this->con, $c);
        $res   = mysqli_fetch_array($sql);
        $count = mysqli_num_rows($sql);
        if ($count > 0) {
            echo $count;
        } 
        return $count;
    }
    // Create an account
    public function Register($name, $pass, $email, $ph_no, $date_num)
    {
        $password = md5($pass);
        $sql = mysqli_query($this->con, "INSERT into sign_up (name, pass, email, ph_no, date_num) VALUES('" . $name . "','".$password."','" . $email . "','" . $ph_no . "',NOW())");

        return $sql;
    }
    // Adding new task
    public function addTask($name, $email, $address, $dob, $status, $image, $education, $pincode,$country,$city)
    {

        $sql = mysqli_query($this->con, "INSERT into user_details (name,email,address,dob,status,image,education,created_date,pincode,country,city) VALUES('" . $name . "','" . $email . "','" . $address . "','" . $dob . "','" . $status . "','" . $image . "','" . $education . "',NOW(),'" . $pincode . "','" . $country . "','" . $city . "') ");


        return $sql;
    }
    // Showing task,pagination,filter
    public function Task($value,$status,$Dob)
    {
        $query[] = "";
        $stm = "";
        
        if ($value!= '') {
            $query[] = "AND CONCAT(`name`, `email`) LIKE '%" . $value . "%'";
        }
                                    
        if ($status!= '') {
            $query[] = "AND `status` = '".$status."'";
        }

        if ($Dob!= '') {
            $query[] = "AND `dob` = '".$Dob."'";
        }

        if (count($query) > '0') {
            $stm = implode("", $query);
        }
       

        $que = "SELECT * from user_details where 1=1 $stm";
        $re = mysqli_query($this->con, $que);
        return $re;
    }
   
    // Delete task
    public function Delete_task($id)
    {

        $result = mysqli_query($this->con, "DELETE from user_details where user_details_id=$id");
        return $result;
    }
    // Edit task
    public function Edit_task($id)
    {
        $sql    = "SELECT * from user_details where user_details_id='" . $id . "' ";
        $result = mysqli_query($this->con, $sql);

        $count  = mysqli_fetch_array($result);
        if ($count > 0) {
           
        } else {
            echo "error";
        }

        return $count;

    }
    // Update user task
    public function Update($name, $email, $address, $dob, $status, $image, $education, $pincode,$id)
    {
        $stm="";
        $query[]="";
  /*     if($a_id != '' && $a_id >'0'){
                 $query[] = ",a_id = '".$a_id."'";
                }
        
        if($s_id != '' && $s_id >'0'){
                 $query[] = ",s_id = '".$s_id."'";
                }*/

       if($image != ''){
                 $query[] = ",fileToUpload = '".$image."'";
                }

        if (count($query) > '0') {
            $stm = implode("", $query);
        }
            $sql = "UPDATE user_details SET name='$name',email='$email',address='$address',dob='$dob',status='$status',created_date='NOW()',education='$education',pincode='$pincode' $stm WHERE user_details_id='$id' ";

            $result = mysqli_query($this->con, $sql);
            return $result;

    }

    public function Status()
    {
        $re = mysqli_query($this->con, "SELECT * from status ");

        return $re;
    }

    public function Country()
    {
        $re = mysqli_query($this->con, "SELECT * from countries ");
        return $re;
    }
}
