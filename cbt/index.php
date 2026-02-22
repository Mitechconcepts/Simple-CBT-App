<?php include("header.php")?>
<body>
    <style>
            body{
                
                background: url(assets/image/cbt-bg.jpg);
                background-size:cover;
                background-repeat:repeat-y;
                padding:0;
            }
            .spinner{
                border:5px solid #f3f3f3;
                border-top:5px solid #3498db;
                border-radius:50%;
                width:50px;
                height:50px;
                animation:spin 1s linear inifnite;
            }
            @keyframes spin{
                0%{transform:rotate(0deg);}
                100%{transform:rotate(360deg);}
            }
    </style>
        <div class="container-fluid p-0 m-0">
            <div class="row" style="margin-top:10%;">
                <form id="auth_form" action="backend/auth.php" method="post">
                <div class="col-lg-4 mx-auto px-0"  style=" margin-top:25px; background:#fff">
                    <div class="bg-secondary p-2 text-light text-center">
                        <h4 class="fw-bold">COMPUTER BASED TEST(CBT) PORTAL</h4>
                    </div> 
                    
                    <div class="container">
                        <div class="row py-2 mt-3">
                            <div class="col-lg-12">
                                <h6 class="text-dark fw-bold">Login to Portal</h6></div>
                                <div class="container">
                                    <div class="row p-2">
                                        <div class="col-lg-12 text-danger fw-bolder" id="auth_error" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="form-label my-2">Student ID /Staff ID / Admin ID</label>
                                <input class="form-control" type="text" name="username" id="username"/>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label my-2">Password</label>
                                    <input class="form-control" type="password" name="password"  id="password"/>
                                </div>
                                
                                <div class="form-group mt-2">
                                    <button id="login" type="submit" class="btn btn-success w-100" name="login" value="login">Access Account </button>
                                </div>
                                <p class="text-dark fw-bolder p-2 mt-2">
                                    Forgot Password? Contact the Administrator.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#auth_form").on("submit", function(e){
                    e.preventDefault();
                    $("#loading").show();
                    let username= $("#username").val();
                    var password= $("#password").val();
                    var login= $("#login").val();
                    let data= {"username": username, "password":password, "login":login};
                    $.ajax({
                        url:"backend/auth.php",
                        method:"post",
                        data:data,
                        success:function(res){
                            if(res=="admin"){
                                window.location.href="admin/index.php";
                            }
                            else if(res=="student"){
                                window.location.href="student/index.php";
                            }
                            else if(res=="staff"){
                                window.location.href="staff/index.php";
                            }
                            else{
                                $("#auth_error").text(res);
                            }
                        }
                    });
            });
        });
        </script>
    </body>

</html>