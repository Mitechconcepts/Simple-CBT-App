<?php
include_once("../admin/db.php");
session_start();
if(!isset($_SESSION["user"])){header("Location:../index.php"); exit;}

//get all published exams from the exams table
$class= $_SESSION["user"]["class"];
$sql= "SELECT * FROM exams WHERE status='published' && class='$class'";
$query= mysqli_query($conn, $sql);
if($query){
    $num= mysqli_num_rows($query);
    if($num > 0){
        $student_exams= mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
    else{
        echo "No examinations available at this time";
        exit;
    }
}
else{
    die("An error was encountered". mysqli_error());
}

?>
<table class='table table-striped' id="qTable">
    <thead>
        <tr><th>Subject</th><th>Class</th><th>Total</th><th>Exam Type</th><th>Date Created</th><th>Due Date</th><th>Duration</th><th>Status</th><th>Action</th></tr>
    </thead>
    <tbody>
        <?php
        foreach($student_exams as $exams){
            $eid= $exams["exam_id"];
            $tq= $exams["num_quest"];
            $s= $exams["subjects"];
                echo "<tr><td>" .$exams['subjects']. "</a></td><td>".$exams['class'] ."</td><td>". $exams['num_quest']. "</td><td>".$exams['exam_type']."</td><td>" .$exams['date_created']. "</td><td>" .$exams['due_date']. "</td><td>".$exams['duration']."</td><td>".$exams['status']. "</td><td><a title='edit questions' class='btn btn-warning mx-1' href='../exams/take_exam.php?eid=" .$exams['exam_id']. "&s=$s&tq=$tq'>Take Exam</a><a title='view results' class='btn btn-success mx-1' href='../results/index.php?eid=$eid'>View Results</a></td></tr>";
        }
?>
    </tbody>
</table>

