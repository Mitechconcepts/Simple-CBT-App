<?php
include("../admin/db.php");
session_start();
//check if exam questions has been fully submitted.
if(isset($_SESSION["user"]["user_id"]) && isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]==="POST"){
$total= $_POST["total_quest"];
$question= $_POST["question"];
$optA= $_POST["opt_A"];
$optB= $_POST["opt_B"];
$optC= $_POST["opt_C"];
$optD= $_POST["opt_D"];
$correct_opt= $_POST["correct_answer"];
$exam_id= $_POST["exam_id"];
$subject= $_POST["subject"];
$quest_num= $_POST["quest_num"];
$acad_info= getAcadYear($conn);
$sess= $acad_info["year"];
$term= $acad_info["term"];
$acad_year= $term. " " . $sess;
$_SESSION["quest_data"]["exam_id"]=$exam_id;
if($quest_num <= $total){
   $check= mysqli_query($conn, "select * from questions where exam_id='$exam_id' && quest_num= $quest_num");
   if(!$check){
      die ("Query operation failed". mysqli_connect_error());
   }
   else{
      if(mysqli_num_rows($check) > 0){
         header("Location:add_quest.php?res=duplicate");
         exit;
      }
      else{
         $sql= "insert into questions (exam_id, quest_num, question, option_a, option_b, option_c, option_d, correct_answer, acad_year, subject) values ('$exam_id', '$quest_num', '$question', '$optA', '$optB', '$optC', '$optD', '$correct_opt', '$acad_year', '$subject')";
         $query= mysqli_query($conn, $sql);
            if(!$query) {
               return mysqli_connect_error();
            }
            else{
               header("Location:add_quest.php?$eid=$exam_id&res=success");
            }
         }
      }
}
//if user tried to access the link directly, redirect to login page
else{
   header("Location:/cbt/errors/404.html");
   exit;
}
}
?>