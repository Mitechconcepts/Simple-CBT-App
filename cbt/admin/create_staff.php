<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="p-2 text-secondary">Enroll New Staff</h4>
            </div>
        </div>
        <form id="myform" method="post" action="create_account.php" enctype="multipart/form-data" >
        <div class="row p-2">
            <div class="col-lg-6">
                <div class="form-floating mb-1 mt-1">
                    <input type="text" class="form-control rounded-2" id="fname" placeholder="Firstname" name="sname" required>
                    <label class="form-label" for="email">Surname</label>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-floating mt-1 mt-1">
                    <input type="text" class="form-control rounded-2" id="lname" placeholder="John Smith" name="other_names" required>
                    <label class="form-label" for="surname">Other Names</label>
                </div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col-lg-6">
                <div class="form-floating mb-1 mt-1">
                    <input type="text" class="form-control rounded-2" id="user_id" name="user_id" placeholder="DIS/S/YY/XXXX" required>
                    <label class="form-label" for="staff id">Staff ID</label>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-floating mb-1 mt-1">
                    <input type="password" class="form-control rounded-2" id="password"  name="pword" required>
                    <label class="form-label" for="class">Password</label>
                </div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col-lg-6">
                <div class="form-group mb-1 mt-1">
                    <input type="file" class="form-control form-control-lg rounded-2" id="picture" name="file" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group mb-1 mt-1">
                    <select class="form-select form-control-lg" id="role" name="role">
                        <option>Assign Role</option>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row p-2 fw-bolder">
            <div class="col-lg-6" id="result"></div>
        </div>
        <div class="row p-2">
            <div class="row text center p-1 mt-1">
                <div class="col-lg-6">
                    <input type="submit" name="submit" value= "Create Staff" class="btn btn-success btn-lg"> 
                </div>
            </div>

        </form>
        </div>
<!--JQuery Begins here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myform").submit(function(event){
    event.preventDefault();
    var role= $("#role").val();
    var url= "create_account.php?role="+ role;
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
});
</script>