 <?php
 include("header.php");
 //include("chart.php");
 include("../admin/db.php");
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
    body{font-size:14px;
       
    }
    .side-nav{
        background-color:#fff;
    }

    .sidebar{
        margin:0;
        padding:0;
    }
   .side-nav .sidebar li{
        display:block;
        margin-top:15px;
        margin-bottom:15px;
        padding-top:0.75em;
        padding-bottom:0.75em;
        padding-left:0.4em;
        padding-right:0.4em;
        color:#333!important;
       
    }
   .side-nav .sidebar .active{
   background-color:#333;
   border-radius:15px;
   color:#fff!important;
   }
   
   .side-nav .sidebar .active i{
    color:#fff!important;
   }

  .sidebar li i, i{
        color:#000;
        font-size:14px;!important
    }
</style>

<div class="container-fluid">
    <div class="row p-0">
        <div class="col-lg-2 py-3 text-secondary side-nav">
            <ul class="sidebar">
                <li id="dashboard" class="active"><i class="bi bi-grid-fill me-5"></i>Overview</li>
                <li id="view_exams"><i class="bi bi-view-stacked me-5"></i> View Examinations</li>
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
                            <div class="col-lg-12 border-1 border-bottom border-secondary" style="font-family:georgia; font-size:25px;">
                            <span class="fw-bolder">
                                <img class="d-inline-block" src="../assets/image/ded.png" style="width:55px; height:55px;"><h3 class="text-dark p-2 d-inline-block fw-bolder"> DOESTDOT INTERNATIONAL SCHOOLS </h3>
                            </span>
                             <span class="float-end"><i class="bi bi-list p-2 px-3 text-dark border border-secondary border-2 rounded-2" style=""></i></span>
                            <p class="text-end" style="color:purple;">GM, <?= strtoupper($_SESSION["user"]["user_id"]); ?> !</p>
                            </div>
                        </div>
                            <div class="row orders text-dark" id="content_box">
                                <div class="col-lg-6" style="background:#fff;">
                                    <div class="container">
                                        <div class="row p-2 rounded-3">
                                            <div class="col-lg-4">
                                                <img class="img-thumbnail d-block" src="../admin/<?=$_SESSION['user']['directory'] ?>" style="width:150px; height:150px;"/>
                                            </div>
                                            <div class="col-lg-7 mx-auto">
                                                <h4>Staff Profile</h4>
                                                <table class="table table-striped">
                                                    <tr><td>Names</td><td><?= $_SESSION["user"]["surname"]; ?> <?= $_SESSION["user"]["other_names"]; ?></td></tr>
                                                    <tr><td>User_id</td><td><?= $_SESSION["user"]["user_id"]; ?></td></tr>
                                                    <tr><td>Role</td><td><?= $_SESSION["user"]["user_role"]; ?></td></tr>
                                                    
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
</div>
<!--JQuery Begins here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(".sidebar li").click(function(){
        $(".sidebar li").removeClass("active");
        $(this).addClass("active");
    });

    $("#dashboard").click(function(){
        location.href=""
    });

    $("#view_exams").click(function(){
        $("#content_box").load("../exams/view_exams.php?qs=view_exams");
    });

    $("#logout").click(function(){
        location.href="../logout.php"
    });

    $(document).on("click", ".get_results", function(e){
    e.preventDefault();
    let url= $(this).attr("href");
    $("#content_box").load(url);
    });

});



</script>
