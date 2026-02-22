<?php
include("../backend/db.php");
session_start();
if (isset($_SESSION["user"]["user_id"]) && isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]==="POST"){
    $qs= $_GET["qs"];
    if($qs="add"){
        $session= $_POST["session"];
        $term= $_POST["term"];
        $class= $_POST["class"];
        $subject= $_POST["subject"];
        $num_quest= $_POST["num_quest"];
        $due_date= $_POST["due_date"];
        $author= $_POST["author"];
        $duration= $_POST["duration"];
        $exam_type=$_POST["exam_type"];
        $exam_id= uniqid();
        $date_created= date("Y-m-d");
        $check_id= "SELECT * FROM exams where subjects='$subject' AND exam_type='$exam_type' AND term='$term' AND class='$class' AND session='$session'";
        $query= mysqli_query($conn, $check_id);
        $num= mysqli_num_rows($query);
        if($num > 0){
            echo "<p class='text-danger'>Entries already exists in the database</p>";
        }
        else{
            $sql="INSERT INTO exams (exam_id, session, term, class, subjects, num_quest, due_date, author, duration, date_created, exam_type) values(?,?,?,?,?,?,?,?,?,?,?)";
            $stmt= mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssssisssss", $exam_id, $session, $term, $class, $subject, $num_quest, $due_date, $author, $duration, $date_created, $exam_type);
            mysqli_stmt_execute($stmt);
                if(mysqli_stmt_affected_rows($stmt) > 0){
                    //$sql= "UPDATE exams SET status='ready' WHERE exam_id=$exam_id";
                    //if(!mysqli_query($conn, $sql)){
                       // die(mysqli_error());
                  //  }
                   // else{
                    echo "Entries submitted Successfully";//}
                 }
                else{
                    echo "<p class='text-danger'>Entries cannot be submitted owing to Data manipulation</p>";
                }
        }
    }
   
}
else{
    $qs= $_GET["qs"];
    if(isset($qs) && isset($_SESSION["user"]["user_id"]) && $qs=="view_exams"){
        if($_SESSION["user"]["user_role"]=="staff"){
            $author=$_SESSION["user"]["user_id"];
            $sql= "SELECT * FROM exams WHERE author='$author'";
            $query= mysqli_query($conn, $sql);
            $num= mysqli_num_rows($query);
            if($num > 0){
                $result=mysqli_fetch_all($query, MYSQLI_ASSOC);
                $_SESSION["exam_data"]= $result;
            }
           else{
            $_SESSION["exam_data"]= "";
          }
        }
        else{
        $sql= "SELECT * FROM exams";
        $query= mysqli_query($conn, $sql);
        $num= mysqli_num_rows($query);
        if($num > 0){
            $result=mysqli_fetch_all($query, MYSQLI_ASSOC);
            $_SESSION["exam_data"]= $result;
        }
    }
    }
}
?>
