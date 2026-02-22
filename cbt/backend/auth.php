<?php
include("db.php");
if(!empty($_POST["login"])){
$username= filter_var($_POST["username"]);
$password= filter_var($_POST["password"]);
    if(empty($username) || empty($password)){
        $res="All fields are required";
    }
    else{
    $stmt= "SELECT * FROM users WHERE user_id='$username' && auth_code='$password'";
    $query= mysqli_query($conn, $stmt);
    $num= mysqli_num_rows($query);
    if($num>0){
        $row_data= mysqli_fetch_assoc($query);
        session_start();
        $_SESSION["user"]= $row_data;
        $role= $_SESSION["user"]['user_role'];
        if($role=="student"){
            $res= "student";
            }
            elseif($role=="admin"){
                $res="admin";
            }
            else{
                $res="staff"; 
        }
    }
        else{
            $res= "Incorrect login credentials";
        }
       
    }
}
echo $res;
?>