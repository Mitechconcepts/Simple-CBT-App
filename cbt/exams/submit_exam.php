<?php
session_start();
var_dump($_POST);
include("../admin/db.php");
$user_id= $_SESSION["user"]["user_id"];
$surname= $_SESSION["user"]["surname"];
$other_names = $_SESSION["user"]["other_names"];
$names= "$surname $other_names";
$eid= $_GET["eid"];
//check if student answers already existed to avoid duplicate;\
$q= "SELECT * from student_answers where exam_id= '$eid' && user_id='$user_id'";
$query=mysqli_query($conn, $q); 
if($query){
if (mysqli_num_rows($query) > 0){
    echo "<script>alert('Page can not be re-submitted because this examination has already been taken.'); window.location.href='../student/index.php';</script>";
}

else{
//store student response in the table
 foreach($_POST as $quest_num => $selected_answer){
    $sql = "INSERT INTO student_answers (exam_id, quest_num, user_id, selected_answer) VALUES ('$eid', '$quest_num', '$user_id', '$selected_answer')";
    $query= mysqli_query($conn, $sql) or die(mysqli_error());
    if($query){   echo "<script>alert('Exam completed Successfully. Click OK to view your result'); window.location.href='../results/index.php?eid=$eid';</script>";}
 }


}
}

else{
die(mysqli_connect_error());
}
?>