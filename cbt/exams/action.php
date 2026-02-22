<?php
session_start();
include("../admin/db.php");
if(!isset($_SESSION["user"])){
    header("Location:../index.php");
}
else{
if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]==="GET"){
    $action= $_GET["q"];
    $exam_id= $_GET["eid"];
    if($action=="publish"){
        $sql="UPDATE exams SET status='published' WHERE exam_id='$exam_id'";
        $query= mysqli_query($conn, $sql);
        if($query){
            echo "Exam has been successfully published";
        }
        else{
            die(mysqli_error());
        }
    }
    elseif($action=="delete"){
        $sql="DELETE FROM exams WHERE exam_id='$exam_id'";
        $query= mysqli_query($conn, $sql);
        if($query){
            echo "Exam has been Deleted";
        }
        else{
            die(mysqli_error());
        }           
    }
    else{
        echo "You are doing something else";
    }
}


}