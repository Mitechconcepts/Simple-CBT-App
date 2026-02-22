 <?php
 include("header.php");
 include("chart.php");
 include("db.php");
 session_start();
 if(!isset($_SESSION["user"]["user_id"])){
    header("Location:../index.php");
    exit;
 }
 $acad_info= getAcadYear($conn);
 $term= $acad_info["term"];
 $sess= $acad_info["year"];
 
 ?>
 
 <style>
    body{font-size:px;
       
    }
    .orders .col{
        background-color:#fff;
        width:250px;
        margin-right:10px;
    }
    .sidebar{
        margin:0;
        padding:0;
    }
    .sidebar li{
        display:block;
        margin-top:10px;
        padding:8px;
        color:#666;
    }
    .sidebar .active{
   background-color:#333;
   border-radius:15px;
   color:#fff!important;
   }
   
   .sidebar .active i{
    color:#fff!important;
   }
  .sidebar li i, i{
        color:#000;
        font-size:16px;!important
    }

@media screen and (max-width:661px) {
    
}




</style>

<div class="container-fluid">
    <div class="row p-0">
        <div class="col-lg-2 p-2">
            <ul class="sidebar">
                <li><img class="d-inline-block" src="../assets/image/ded.png" style="width:45px; height:45px;"><h6 class="text-secondary p-2 d-inline-block fw-bolder"> DoEstDot Schools </h6></li>
                <li class="active"><i class="bi bi-grid-fill me-5"></i>Overview</li>
                <li id="view_exams"><i class="bi bi-view-stacked me-5"></i> View Examinations</li>
                <li id="new_student"><i class="bi bi-person-fill-add me-5"></i>Create Student</li>
                <li id="new_staff"><i class="bi bi-person-fill-add me-5"></i>Create Teacher</li>
                <li id="add_exam"><i class="bi bi-table me-5"></i> Create Examination</li>
                <li id="students"><i class="bi bi-database-fill me-5"></i>Student Records</li>
                <li id="staff"><i class="bi bi-database-fill me-5"></i> Staff Records</li>
                <li><i class="bi bi-bell-fill me-5"></i> Notifications </li>
                <li><i class="bi bi-broadcast me-5"></i> Send Broadcast </li>
                <li><i class="bi bi-chat-left-fill me-5"></i>Memo</li>
                <li><i class="bi bi-gear-fill me-5"></i>Settings</li>
                 <li id="logout" class="mt-3"><i class="bi bi-box-arrow-right me-5"></i></i>LogOut</li>
            </ul>
        </div>
        <div class="col-lg-10 bg-light p-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="container-fluid">
                             <div class="row p-2 mb-2">
                            <div class="col-lg-12 p-2 border-1 border-bottom border-muted text-start" style="font-size:20px;">
                             <span class="float-end"><i class="bi bi-list p-2 px-3 text-dark border border-secondary border-2 rounded-2" style=""></i></span>
                            <span class="text-start text-muted">GM, <?= $_SESSION["user"]["user_id"]; ?> !</span>
                            </div>
                        </div>
                            <div class="row text-dark" id="content_box">
                                <div class="col-lg-6" style="background:#fff;">
                                    <div class="container">
                                        <div class="row p-2 rounded-3">
                                            <h2 style="color:#333;">Profile Information</h2>
                                            <div class="col-lg-4">
                                                <img class="img-thumbnail d-block" src="<?=$_SESSION['user']['directory'] ?>" style="width:150px; height:150px;"/>
                                            </div>
                                            <div class="col-lg-7 mx-auto">
                                                <table class="table table-striped">
                                                    <tr><td>Names</td><td><?= $_SESSION["user"]["surname"]; ?> <?= $_SESSION["user"]["other_names"]; ?> </td></tr>
                                                    <tr><td>User_id</td><td><?= $_SESSION["user"]["user_id"]; ?></td></tr>
                                                    <tr><td>Role</td><td><?= ucfirst($_SESSION["user"]["user_role"]); ?></td></tr>
                                                    <tr><td>Term</td><td><?= $term; ?> <span class="mx-3">Term</span></td></tr>
                                                    <tr><td>Session</td><td><?= $sess; ?> <span class="mx-3"> Session</span></td></tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                </div>
                                <div class="col-lg-6" style="background:#fff;">
                                    <div class="container">
                                        <div class="row p-2 rounded-3">
                                            <h2 style="color:#333;">Staff List & Details</h2>
                                            <div class="col-lg-12">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr><th>Names</th><th>User_Id</th><th>Password</th><th>Photo</th>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $data= getAllStaff($conn);
                                                        foreach($data as $d){
                                                            echo '<tr><td>'.$d["surname"]. ' '. $d["other_names"]. '</td><td>'.$d["user_id"]. '</td><td>'.$d["auth_code"]. '</td><td><img style="height:40px; width:40px;" src="'.$d["directory"].'"</tr>';
                                                        }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                </div>                                
                            </div>
                             
                        </div>
                    </div>
                </div>
               
                </div>
                
            </div>
            
        </div>
    </div>
</div>
<!--JQuery Begins here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>
$(document).ready(function(){
     $(".active").click(function(){
        location.href="";
    });
    $(".sidebar li").click(function(){
        $("li").removeClass("active");
        $(this).addClass("active");
    });
    $("#students").click(function(){
        $("#content_box").load("get_students.php");
    });
    $("#view_exams").click(function(){
        $("#content_box").load("../exams/view_exams.php?qs=view_exams");
    });
    $("#new_student").click(function(){
        $("#content_box").load("create_student.php");
    });

    $("#new_staff").click(function(){
        $("#content_box").load("create_staff.php");
    });
    $("#add_exam").click(function(){
        $("#content_box").load("../exams/add_exam.php");
    });
    $("#logout").click(function(){
        location.href="../logout.php"
    });
    
    $(document).on("submit", "#myform2", function(event){
    event.preventDefault();
    var url= "create_student_account.php";
    var formdata= new FormData(this);
        $.ajax({
        url: url,
        method:"POST",
        data: formdata,
        processData:false,
        contentType:false,
        success: function(res){
            $("#result").html(res);
        },
        error:function(xhr, status, error){
            $("#result").html("Ajax Error" + xhr.responseText);
        }
    });
    });

    $(document).on("click", ".pub_exam", function(e){
        e.preventDefault();
        let url= $(this).attr("href");
        $.ajax({
            url: url,
            method:"GET",
            success: function(res){
                alert(res);
                window.location.reload();
            },
            error:function(xhr, status, error){
                alert("Ajax Error" + xhr.responseText);
        }
         });
       
    });

    $(document).on("click", ".del_exam", function(e){
        e.preventDefault();
        let url= $(this).attr("href");
        alert(url);
        $.ajax({
            url: url,
            method:"GET",
            success: function(res){
                alert(res);
                window.location.reload();
            },
            error:function(xhr, status, error){
                alert("Ajax Error" + xhr.responseText);
        }
         });
       
    });


});
</script>
