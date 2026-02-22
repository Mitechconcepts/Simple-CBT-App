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

//function to get current Academic Current Academic Term
function getAcadYear($conn){
    $sql= "SELECT * FROM sessions WHERE status='active'";
    $query= mysqli_query($conn, $sql);
        if ($query){
            $result= mysqli_fetch_assoc($query);
            return $result;
            exit;
        }
        else{
            die("Get staff data failed". mysqli_error());
            exit;
        }
}



//function to check logins
function loginAuth($conn, $user_id, $pword){
    $sql= "SELECT * FROM users WHERE user_id= ? AND auth_code=?";
    $query= mysqli_prepare($conn, $sql);
    if(!$query){
        die("Prepare Failed". mysqli_error());
        exit;
    }
    else{
    mysqli_stmt_bind_param($query, 'ss', $user_id, $pword);
    mysqli_stmt_execute($query);  
    $result=mysqli_stmt_get_result($query);
    return mysqli_num_rows($result);
    exit;
    }
   
}
//function to get all staff
function getAllStaff($conn){
    $sql= "SELECT * FROM users WHERE user_role='staff'";
    $query= mysqli_query($conn, $sql);
        if ($query){
            $result= mysqli_fetch_all($query, MYSQLI_ASSOC);
            return $result;
            exit;
        }
        else{
            die("Get staff data failed". mysqli_error());
            exit;
        }
}

//function to get all students
function getAllStudents($conn){
    $sql= "SELECT * FROM users WHERE user_role='student'";
    $query= mysqli_query($conn, $sql);
        if ($query){
            $result= mysqli_fetch_all($query, MYSQLI_ASSOC);
            return $result;
        }
        else{
            die("Get staff data failed". mysqli_error());
        }
}

//function to check if a user has been enrolled already
function checkUser($conn, $user_id){
$sql= "SELECT * FROM users WHERE user_id='$user_id'";
$query= mysqli_query($conn, $sql);
if($query){
    $num= mysqli_num_rows($query);
    if ($num > 0){ return "true";}
    else {return "false";}
}
else {die ("Query failed". mysqli_error());} 
}


//function set exam status
function checkd($conn){
$sql= "SELECT * FROM exams";
$query= mysqli_query($conn, $sql);
if($query){
    $num= mysqli_num_rows($query);
    if ($num > 0){ 
        $record= mysqli_fetch_assoc($query);
        $expiry_date= $record["due_date"];
        echo $expiry_date;
        if(date("Y-m-d")>$expiry_date){echo "exam expired";}
        else echo "exam active";
        
    }
    else {return "false";}
}
else {die ("Query failed". mysqli_error());} 
}

//function to check if a score has been submitted for a particular exam
function checkScore($conn, $user_id, $exam_id){
$sql= "SELECT * FROM results WHERE user_id='$user_id' && exam_id='$exam_id' ";
$query= mysqli_query($conn, $sql);
if($query){
    if(mysqli_num_rows($query) > 0){
       return 1;
    }
    else{
        return 0;
    }
}
else{
    die("Query not executed". mysqli_errno($conn));
}

}

//function to check if a score has been submitted for a particular exam
function checkSubject($conn, $exam_id){
$sql= "SELECT subjects FROM exams WHERE exam_id='$exam_id' ";
$query= mysqli_query($conn, $sql);
if($query){
    if(mysqli_num_rows($query) > 0){
       $row= mysqli_fetch_assoc($query);
       return $row["subjects"];
    }
    else{
        return "NULL";
    }
}
else{
    die("Query not executed". mysqli_errno($conn));
}

}


?>