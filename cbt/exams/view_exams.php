<?php
include("../header.php");
include("exams.php");
if(!isset($_SESSION["user"]["user_id"])){
    header("Location:../index.php");
}

?>
<div class="container-fluid">
<div class="row">
<div class="col-lg-12" id="content_box">
<h3 class='text-secondary'> Examination Details</h3>
    <?php
    if(empty($_SESSION["exam_data"])){  
        echo "<p class='text-danger fw-bold p-2'> No Records of examinations Found at this time.</p>";
    }
    else{
        echo "<table class='table table-striped' id=iqTable'><thead><tr><th>Subject</th><th>Class</th><th>Total</th><th>Exam Type</th><th>Date Created</th><th>Due Date</th><th>Status</th><th class='text-center'>Action</th></tr></thead><tbody>";
         if($_SESSION["user"]["user_role"]=="admin"){
            $role= $_SESSION["user"]["user_role"];
                foreach($_SESSION["exam_data"] as $getExams){
                    $eid= $getExams["exam_id"];
                    $status= $getExams["status"];
                    if($status==="published"){
                        echo "<tr><td>".$getExams['subjects']. "</a></td><td>".$getExams['class'] ."</td><td>". $getExams['num_quest']. "</td><td>".$getExams['exam_type']."</td><td>" .$getExams['date_created']. "</td><td>" .$getExams['due_date']. "</td><td>".$getExams['status']. "</td><td><a title='Edit Exam' class='btn btn-primary mx-2' href='../exams/action.php?q=edit&eid=$eid'>Edit</a><a class='btn btn-success mx-2' href='../results/index.php?r=admin&eid=$eid'>Results</a><a class='del-exam btn btn-danger mx-2' href='../exams/action.php?q=delete&eid=$eid'>Delete</a></td></tr>";
                    }
                    else{
                        echo "<tr><td>".$getExams['subjects']. "</a></td><td>".$getExams['class'] ."</td><td>". $getExams['num_quest']. "</td><td>".$getExams['exam_type']."</td><td>" .$getExams['date_created']. "</td><td>" .$getExams['due_date']. "</td><td>".$getExams['status']. "</td><td><a title='Edit Exam' class='btn btn-primary mx-2' href='../exams/action.php?q=edit&eid=$eid'>Edit</a><a title='Publish Exam' class='btn btn-warning mx-2 pub_exam' href='../exams/action.php?q=publish&eid=$eid'>Publish</a><a class='btn btn-success mx-2' href='../results/index.php?r=admin&eid=$eid'>Results</a><a class='del_exam btn btn-danger mx-2' href='../exams/action.php?q=delete&eid=$eid'>Delete</a></td></tr>";
                }
            }
         }
        else{
            foreach($_SESSION["exam_data"] as $getExams){
                echo "<tr><td>".$getExams['subjects']. "</td><td>". $getExams['class']. "</td><td>". $getExams['num_quest']. "</td><td>" .$getExams['exam_type']. "</td><td>" .$getExams['date_created']. "</td><td>" .$getExams['due_date']. "</td><td>".$getExams['status']. "</td><td><a title='Add Questions' class='add_questions mx-2' href='../questions/add_quest.php?eid=".$getExams['exam_id']."'><i class='bi bi-plus-lg btn btn-primary text-light'></i></a><a class=' mx-2' href=''><i class='bi bi-pencil-fill btn btn-dark text-light'></i></a><a title='View Examination results' class='get_results mx-2' href='../results/index.php?r=staff&eid=".$getExams['exam_id']."'><i class='bi bi-view-stacked btn btn-success text-light'></i></a></td></tr>"; 
            }
        }
    }
?>
    </tbody>
</table>
</div>
</div>
</div>