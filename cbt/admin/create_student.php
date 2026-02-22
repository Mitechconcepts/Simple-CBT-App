<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="p-2 text-secondary fw-bold">Add New Student</h3>
            </div>
        </div>
        <form method="post" action="create_student__account.php" enctype="multipart/formdata" id="myform2">
        <div class="row p-2">
            <div class="col-lg-6">
                <div class="form-floating mb-1 mt-1">
                    <input type="text" class="form-control rounded-3" id="f_name" placeholder="Firstname" name="sname" required>
                    <label class="form-label" for="email">Surname</label>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-floating mt-1 mt-1">
                    <input type="text" class="form-control rounded-3" id="o_name" placeholder="" name="other" required>
                    <label class="form-label" for="o_name">Other Names <span class="ms-3 text-danger">sperate name with space</span> e.g James Maxwell</label>
                </div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col-lg-6">
                <div class="form-floating mb-1 mt-1">
                    <input type="text" class="form-control rounded-3" id="adm_num" placeholder="" name="adm_num" required>
                    <label class="form-label" for="admission number">Admission Number <span class="ms-3 text-danger">DIS/J/23/XXXX</span></label>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-floating mb-1 mt-1">
                    <input type="text" class="form-control rounded-3" id="class" placeholder="" name="class" required>
                    <label class="form-label" for="class">Class <span class="ms-3 text-danger">JSS 1</span></label>
                </div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col-lg-6">
                <div class="form-floating mb-1 mt-1">
                    <input type="password" class="form-control rounded-3" id="auth_code" placeholder="" name="auth_code" required>
                    <label class="form-label" for="auth_code">Password <span class="ms-3 text-danger">Enter a strong password</span></label>
                </div>
            </div>            
            <div class="col-lg-6">
                <label class="form-label"> Upload a <span class="text-danger">(.PNG, .JPG, .JPEG)</span> picture not > 1MB </label>
                <div class="form-group mb-1 mt-1 p-1">
                    <input type="file" class="form-control rounded-3 p-2" id="pix" name="file">
                </div>
            </div>
        </div>
        <div class="row p-2">
            <div id="result"></div>
        </div>
            <div class="row p-2 mt-3">
                <div class="col-lg-6">
                    <input type="submit" name="submit" value= "Create Student" class="btn btn-success btn-lg"> 
                </div>
            </div>
        </div>
        </form>
    </div>

