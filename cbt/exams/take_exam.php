<!doctype html5>
<html lang="en">
<body style='background:#fff;'>
<?php
include("../header.php");
include("../admin/db.php");
session_start();
$eid= $_GET["eid"];
$tq= $_GET["tq"];
$sub= $_GET["s"];
$user_id= $_SESSION["user"]["user_id"];
date_default_timezone_set("Africa/Lagos");
//get some exam info
$query= mysqli_query($conn, "select * from exams where exam_id= '$eid'") or die(mysqli_connect_error);
$row= mysqli_fetch_assoc($query);
$exam_duration= $row["duration"] * 60;

//check student already has a result.
$sql= "SELECT * FROM results WHERE user_id='$user_id' AND exam_id='$eid' ";
$query= mysqli_query($conn, $sql);
$query_result= mysqli_fetch_assoc($query);
if(mysqli_num_rows($query)>0){
    if($query_result["score"] >0)
        echo "<script>alert('You have already taken this Examination.'); window.location.href='../student/index.php';</script>";
    else{
         $to_start= time();   $start_time= date("Y-m-d H:i:s", $to_start);
         mysqli_query($conn, "UPDATE results SET start_time= '$start_time' where exam_id='$eid' AND user_id='$user_id'");
        $duration= strtotime($query_result["end_time"]) - strtotime($query_result["start_time"]);
        if($duration < 0){$duration= 0;} else {$duration= $duration;}
        }
}
else{
    $to_start= time();
    $start_time= date("Y-m-d H:i:s", $to_start);
    $to_end = $to_start + $exam_duration;
    $end_time= date("Y-m-d H:i:s", $to_end);
    mysqli_query($conn, "INSERT INTO results (user_id, exam_id, start_time, end_time, score, total) VALUES ('$user_id', '$eid', '$start_time', '$end_time', 0, '$tq')");
     $duration= $to_end - $to_start;
     
}


?>

<nav class="p-2 text-dark text-center bg-secondary-subtle">
    <h2>DED CBT EXAMINATION PAGE</h2>
</nav>

<div class='container py-3 px-2'>
    <div class="row">
        <div class="col-lg-6">
            <h4><?=strtoupper($sub); ?></h4>
        </div>
        <div class="col-lg-6">
           <h4> Time Left: <span id="timer" class="ms-2"></span></h4>
        </div>
    </div>
    
<?php
if(empty($_SESSION["user"]["user_id"])){
    header("Location: ../index.php");
}
else{
if(isset($_GET["eid"])){
    $eid= $_GET["eid"];
    $sql= "SELECT * FROM questions WHERE exam_id=?";
    $query= mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($query, 's', $eid);
    mysqli_stmt_execute($query);
    $res= mysqli_stmt_get_result($query);
    $tq= mysqli_num_rows($res);
 
    echo "<form method='post' action='submit_exam.php?eid=$eid&tq=$tq' id='examform'>";
    while($row=mysqli_fetch_assoc($res)){
    echo "<div class='row bg-light p-2 my-2'><h6>Question". $row['quest_num']. "</h6><div class='col-lg-12 my-1'>". $row['question']. "</div><div class='col-lg-6' style='display:flex; align-items:center;'><span class='fw-bold'>A. </span><input class='mx-2'type='radio' name='".$row['quest_num']. "' value='A' /><label for='obtion_a'>". $row['option_a']. "</label></div><div class='col-lg-6 d-flex' style='display:flex; align-items:center;'><span class='fw-bold'>B. </span><input class='mx-2' type='radio' name='".$row['quest_num']. "' value='B'><label for='option_b'>". $row['option_b']. "</label></div><div class='col-lg-6 d-flex' style='display:flex; align-items:center;'><span class='fw-bold'>C. </span><input class='mx-2' type='radio' name='".$row['quest_num']. "' value='C' /><label for='option_c'>". $row['option_c']. "</label></div><div class='col-lg-6 d-flex' style='display:flex; align-items:center;'><span class='fw-bold'>D. </span><input class='mx-2' type='radio' name='".$row['quest_num']. "' value='D' /><label for='option_d'>". $row['option_d']. "</label></div></div>";
       
    }
    
  
}

}
?>
<button type="submit" class="btn btn-md btn-primary">Submit Exam </button>
</form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
    const form = document.getElementById("examform");
    const duration= parseInt('<?=$duration;?>'); //get the time allocated for the exam from the database
    let time= duration; //convert duration into seconds
    let countdown = setInterval(function(){
    let minutes= Math.floor(time / 60);
    let seconds = time % 60;
    //format time properly into two digits
    minutes= minutes.toString().padStart(2, '0');
    seconds= seconds.toString().padStart(2, '0');
    $("#timer").text(minutes + " : " + seconds);
    if(time <= 120){
        $("#timer").addClass("text-danger fw-bold");
    }
    if (time <= 0){
        clearInterval(countdown);
        alert("Time is up! Your exam will be submitted automatically. ");
        form. submit();
    }
    time--;
    }, 1000);
    });
</script>


</body>
</html>