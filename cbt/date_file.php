<?php
date_default_timezone_set("Africa/Lagos");
// a snippet to test run PHP dates functions
$start_time= time();
echo "$start_time <br/>";
$duration= 30 * 60;
$end_time= $start_time + $duration;
echo "$end_time <br/>";
 $diff= $end_time - $start_time;
 $t= date("Y/m/d H:i:s", $end_time);
 echo "<br/>$t<br/>";
 echo date("Y/m/d H:i:s", $start_time) . "<br/> $diff<br/>";

 echo strtotime(date("Y-m-d H:i:s", $diff));
 //echo $t;
//$diff= $time1 -$time2;
//echo $time1/(60);
//$end_date = $current_date + strtotime("30 minutes");
//$diff= $future_date - $current_date;
//$time_in_days = $diff / (24*60*60*365);
//echo $current_date;


echo "<script>alert('You have already taken this Examination.'); window.location.href='../student/index.php';</script>";




//echo "There are ". $time_in_days. " year(s) between " .$current_date. " and ". $future_date;

include("admin/db.php");
$check= checkScore($conn, "DIS/S/LA/001", "687c14b47e751");
//echo $check;
?>

    //check if student has not started the exam.
        if($query_res["start_time"]==""){
        //insert records in Results table to track exam information
        $to_start= time();
        echo $to_start(); exit;
        $start_time= strtotime("Y-m-d H:i:s", $to_start);
        $to_end = $start_time + $exam_duration;
        $duration= strtotime($to_end) - $to_start;
        $end_time= date("Y-m-d H:i:s", $to_end);
        mysqli_query($conn, "INSERT INTO results (user_id, exam_id, start_time, end_time, score, total) VALUES ('$user_id', '$eid', '$start_time', '$end_time', 0, '$tq')");
        }
        else{
        $start_time= strtotime($query_res["start_time"]);
        $end_time = strtotime($query_res["end_time"]);
        $duration= $end_time- $start_time;
        }