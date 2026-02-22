<?php 
session_start();
if(isset($_SESSION["user"]["user_id"])){
include("../header.php");
include("../admin/db.php");
//Retrieve exam ID from the link
    if(!isset($_GET["eid"])){
        $exam_id= "";
    }
    else{
    $exam_id= $_GET["eid"];
    $_SESSION["quest_data"]["eid"]= $exam_id;
    $eid=$_SESSION["quest_data"]["eid"];
    //Get Last Question number
    $sql="SELECT MAX(quest_num) AS last_qn FROM questions WHERE exam_id= '$eid'";
    $result= mysqli_query($conn, $sql);
    $quest_row= mysqli_fetch_assoc($result);
        if($quest_row["last_qn"]===null){
            $quest_num= 1;
        }
        else{
            $quest_num= $quest_row["last_qn"] + 1;
        }
        
    //Get Exam details
    $sql="SELECT * FROM exams where exam_id= '$eid'";
    $query=mysqli_query($conn, $sql);
        if($query && mysqli_num_rows($query) >0){
            $row= mysqli_fetch_assoc($query);
            $sub =$row["subjects"];
            $num= $row["num_quest"];
            $_SESSION["quest_data"]["subject"]= $sub;
            $_SESSION["quest_data"]["num"]= $num;
        
        }
        else{
            die("Query failed due to". mysqli_error());
        }
} 

}
?>

<style>
.form-label{
    font-weight:bold; margin-top:5px; margin-bottom:5px;
}
</style>
<body>
    <div class="container-fluid">
        <div class="row p-0">
            <div class="col-lg-12 text-light" style="background:#000088">
                <h3 class="text-warning">Questions Entry Form</h3>
            </div>
        </div>
    </div>
    <?php
        //Get the last question number
   $sub=$_SESSION["quest_data"]["subject"];
    $eid=$_SESSION["quest_data"]["eid"];    
    $sql="SELECT MAX(quest_num) AS last_qn FROM questions WHERE exam_id= '$eid'";
    $result= mysqli_query($conn, $sql);
    $quest_row= mysqli_fetch_assoc($result);
        if($quest_row["last_qn"]===null){
            $quest_num= 1; 

        }
        else{
            $quest_num= $quest_row["last_qn"] + 1;
        }
    $snum= $_SESSION["quest_data"]["num"];
    if(isset($_GET["st"])){
            if($_GET["res"]=="success"){
                $message= "<p class='p-2 text-success fw-bolder'> Question added Successfully </p>";
            }
            elseif($_GET["st"==="fail"]){
                $message="<p class='p-2 text-danger  fw-bolder'> Question submission failed </p>";
            }
        } else {
            $message="";
        }
       
        if($quest_num>$snum){
            $qd= "UPDATE exams SET status= 'ready' WHERE exam_id='$eid'";
            mysqli_query($conn, $qd);
            $message="<script>alert('You have reached the Limit of $num Questions'); window.location.href='../questions/success.php';</script>";
        }
    ?>
    <div class="container">
        <div class="row rounded-3 p-3">
            <div class="container">
                <div class="row bg-light mt-3 rounded-3 py-3">
                    <div class="col-lg-7 p-1">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 p-2">
                                    <h5 class="p-1"> <?=$sub?> </h5>
                                    <h5 class="p-1"> <?=$message?> </h5>
                                    <p><a class='btn btn-secondary btn-lg' href='../staff/index.php'>Close Page</a></p>
                                </div>
                                <form action="questions.php" method="post" id="myform">
                                <div class="col-lg-12 p-2">
                                    <h5 class="p-1">Question <?=$quest_num?>  of <?=$snum?> </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <textarea class="form-control my-2" name="question" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 p-2">
                                    <input type="text" class="form-control" name="opt_A" placeholder="Option A" required/>
                                </div>
                                <div class="col-lg-12 p-2">
                                    <input type="text" class="form-control" name="opt_B" placeholder="Option B" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 p-2">
                                    <input type="text" class="form-control" placeholder="Option C" name="opt_C" required/>
                                </div>
                                <div class="col-lg-12 p-2">
                                    <input type="text" class="form-control" placeholder="Option D" name="opt_D" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 p-2">
                                    <label class="form-label p-2">Select Answer</label>
                                    <select name="correct_answer" class="form-select">
                                        <option value="A">Option A</option>
                                        <option value="B">Option B</option>
                                        <option value="C">Option C</option>
                                        <option value="D">Option D</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row p-2 mt-1 ">
                                <input type="hidden" name="total_quest" value="<?=$snum?>"/>
                                <input type="hidden" name="quest_num" value="<?=$quest_num?>"/>
                                <input type="hidden" name="exam_id" value="<?=$eid?>"/>
                                <input type="hidden" name="subject" value="<?=$sub?>"/>
                            </div>
                            <div class="row">
                                <input class="btn btn-lg w-50 mx-auto" type="submit" name="submit_quest" value="Submit Question" style="background:#000088; color:#fff;"/>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 p-2">
                       
                        <?php
                            for($i=1; $i<= $snum; $i++){
                                if($i==$quest_num){
                                    echo "<a class='btn btn-warning mx-3 my-3 rounded-circle'  href=sample.php?q=$i>" .$i . "</a>";
                                }
                                elseif($i < $quest_num){
                                    echo "<a class='btn btn-secondary mx-3 my-3 rounded-circle'  href=sample.php?q=$i>" .$i . "</a>";
                                }
                                else{
                                    echo "<a class='btn btn-light mx-3 my-3 rounded-circle'  href=sample.php?q=$i>" .$i . "</a>";
                                }
                             }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>