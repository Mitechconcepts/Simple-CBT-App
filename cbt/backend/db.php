<?php
$host= "localhost";
$pword= "";
$user= "root";
$db= "ded_cbt";
//CONNECT TO THE DATABASE
$conn= new mysqli($host, $user, $pword, $db);
if(!$conn){
    die($conn->connect_error);
}

//function to check logins
function loginAuth($conn, $user_id, $pword){
    $sql= "SELECT * FROM users WHERE user_id= ? AND auth_code=?";
    $query= mysqli_prepare($conn, $sql);
    if(!$query){
        die("Prepare Failed". mysqli_error());
    }
    else{
    mysqli_stmt_bind_param($query, 'ss', $user_id, $pword);
    mysqli_stmt_execute($query);  
    $result=mysqli_stmt_get_result($query);
    $num_row= mysqli_num_rows($result);
    return $num_row;
    }
   
}

//function to get current Academic Session 
function getAcadYear($conn){
$sql= "SELECT * FROM acad_session WHERE status= 'active'";
$query= mysqli_query($conn, $sql);
$row= mysqli_fetch_assoc($query);
return $row;
}
?>