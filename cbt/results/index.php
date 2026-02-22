<?php
include("../header.php");
include_once("../admin/db.php");
session_start();
if(!isset($_SESSION["user"])){
    header("Location:../index.php");
    exit;
}

else{
if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]==="GET"){
$eid= $_GET["eid"];

if(isset($_GET["r"])){ 
    if($_GET["r"]==="admin"){
            echo "admin will view results";
        }

        else{
            echo "staff will view results";
        }
    }
    else{
        $user_id= $_SESSION["user"]["user_id"];
        //run a query to determine the score and update the result table
        $sql= "SELECT questions.correct_answer, student_answers.selected_answer FROM questions JOIN student_answers ON questions.exam_id= student_answers.exam_id AND questions.quest_num = student_answers.quest_num AND questions.correct_answer= student_answers.selected_answer AND student_answers.user_id='$user_id'";
        $query= mysqli_query($conn, $sql);
        $results= mysqli_fetch_all($query, MYSQLI_ASSOC);
        $num_rows= mysqli_num_rows($query);
        if($num_rows >0){
        $score= $num_rows;
        $upd_score= mysqli_query($conn, "UPDATE results SET score='$score' WHERE exam_id= '$eid' AND user_id= '$user_id'") or die(mysqli_error());
        $total= mysqli_query($conn, "SELECT * FROM results where user_id='$user_id' AND exam_id='$eid' ");
        $row_total= mysqli_fetch_assoc($total);
        $total= $row_total["total"];
        }
        else{    
            echo "<script>alert('No Result available for this Examination. Make sure you sit for this Subject'); window.location.href='../student/index.php';</script>";
        }

        //run a query to get the questions to be displayed along with their answers

        $sql= "SELECT questions. quest_num, questions.question, questions.option_a, questions.option_b, questions.option_c, questions.option_d, questions.correct_answer, student_answers.selected_answer FROM questions JOIN student_answers ON questions.exam_id=student_answers.exam_id AND questions.quest_num = student_answers.quest_num AND student_answers.user_id= '$user_id'";

        $query= mysqli_query($conn, $sql);
        $result= mysqli_fetch_all($query, MYSQLI_ASSOC);
        $_SESSION["results_data"]= $result;
      
        $username= strtoupper($_SESSION["user"]["surname"]. " ". $_SESSION["user"]["other_names"]);
        $subject= strtoupper(checkSubject($conn, $eid));
        $content= '<body class="p-0">
                    <div class="container-fluid">
                        <div class="row text-light p-2 bg-success">
                            <div class="col-lg-3" >
                                <h5 class="p-1">CBT RESULT PAGE</h5>
                            </div>
                            <div class="col-lg-3">
                                <h5 class="p-1"><?=$username ?></h5>
                            </div>
                            <div class="col-lg-3">
                                <h5 class="p-1"><?=$user_id ?></h5>
                            </div>
                            <div class="col-lg-3">
                                <h5 class="p-1"><?=$subject?></h5>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table class="table">
                            <thead>
                                <tr><h3>SCORE: </span>'. $score .'/' .$total. '</tr>
                                <tr class="text-center">
                                    <th> S/N </th><th>Questions</th><th>A</th><th>B</th><th>C</th><th>D</th>
                                </tr>
                            </thead>
                            <tbody>';
                        
                            foreach($_SESSION["results_data"] as $row){
                               $correct= $row["correct_answer"]; $select= $row["selected_answer"]; 
                                // colour scheme for correct and wrong answers
                                if($correct==="A" && $select==="A"){$class_a= 'bg-success text-light'; $class_b=''; $class_c=''; $class_d='';}
                                elseif($correct==="A" && $select==="B"){$class_a= 'bg-success text-light'; $class_b='bg-danger text-light'; $class_c=''; $class_d='';}
                                elseif($correct==="A" && $select==="C"){$class_a= 'bg-success text-light'; $class_b=''; $class_c='bg_danger'; $class_d='';}
                                elseif($correct==="A" && $select==="D"){$class_a= 'bg-success text-light'; $class_b=''; $class_c=''; $class_d='bg-danger text-light';}
                                elseif($correct==="B" && $select==="B"){$class_a=''; $class_b= 'bg-success text-light'; $class_c=''; $class_d='';}
                                elseif($correct==="B" && $select==="A"){$class_a= 'bg-danger text-light'; $class_b='bg-success text-light'; $class_c=''; $class_d='';}
                                elseif($correct==="B" && $select==="C"){$class_a= ''; $class_b='bg-success text-light'; $class_c='bg-danger text-light'; $class_d='';}
                                elseif($correct==="B" && $select==="D"){$class_a= ''; $class_b='bg-success text-light'; $class_c=''; $class_d='bg-danger text-light';}
                                elseif($correct==="C" && $select==="C"){$class_a=''; $class_b=''; $class_c= 'bg-success text-light'; $class_d='';}
                                elseif($correct==="C" && $select==="A"){$class_a='bg-danger text-light'; $class_b=''; $class_c= 'bg-success text-light'; $class_d='';}
                                elseif($correct==="C" && $select==="B"){$class_a=''; $class_b='bg-danger text-light'; $class_c= 'bg-success text-light'; $class_d='';}
                                elseif($correct==="C" && $select==="D"){$class_a=''; $class_b=''; $class_c= 'bg-success text-light'; $class_d='bg-danger text-light';}
                                elseif($correct==="D" && $select==="D"){$class_a=''; $class_b=''; $class_c= ''; $class_d='bg-success text-light';}
                                elseif($correct==="D" && $select==="A"){$class_a='bg-danger text-light'; $class_b=''; $class_c= ''; $class_d='bg-success text-light';}
                                elseif($correct==="D" && $select==="B"){$class_a=''; $class_b='bg-danger text-light'; $class_c= ''; $class_d='bg-success text-light';}
                                else{$class_a=''; $class_b=''; $class_c= 'bg-danger text-light'; $class_d='bg-success text-light';}

            $content.= "<tr><td>".$row["quest_num"]. "</td><td>".$row["question"]. "</td><td class='$class_a'>".$row["option_a"]. "</td><td class='$class_b'>".$row["option_b"]. "</td><td class='$class_c'>" .$row["option_c"]. "</td><td class='$class_d'>" .$row["option_d"]. "</td></tr>";
                            }
                
            $content.= '<tr><td colspan="6" class="text-center"><a href="../student/index.php" class="btn btn-success btn-lg">Close Result Page</a></td></tr>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>';
echo $content;
                    }
         }
    }
?>