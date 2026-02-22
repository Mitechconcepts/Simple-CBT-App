<style>
.form-label{color: #023020; font-weight:bolder; font-family:georgia;}
</style>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="p-2 text-secondary fw-bold">Examination Profile</h3>
            </div>
        </div>
        <form method="post" action="exams.php?qs=new" id="addexam">
        <div class="row p-2">
            <div class="response p-2"></div>
            <div class="col-lg-4">
                <div class="form-group mb-1 mt-1">
                    <label for="session" class="form-label">Choose Academic Session</label>
                    <select class="form-control" name="session">
                        <option value="2024/2025">2024/2025</option>
                        <option value="2025/2026">2025/2026</option>
                        <option value="2026/2027">2026/2027</option>
                        <option value="2027/2028">2027/2028</option>
                        <option value="2028/2029">2028/2029</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group mb-1 mt-1">
                    <label for="term" class="form-label">Select Term</label>
                    <select class="form-control" name="term">
                        <option value="First">First</option>
                        <option value="Second">Second</option>
                        <option value="Third">Third</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group mb-1 mt-1">
                    <label for="class" class="form-label">Select Class</label>
                    <select class="form-control" name="class">
                        <option value="JSS 1">JSS 1</option>
                        <option value="JSS 2">JSS 2</option>
                        <option value="JSS 3">JSS 3</option>
                        <option value="SSS 1">SSS 1</option>
                        <option value="SSS 2">SSS 2</option>
                        <option value="SSS 3">SSS 3</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col-lg-4">
                <div class="form-group mb-1 mt-1">
                    <label for="subject" class="form-label">Select Subject</label>
                    <select class="form-control" name="subject">
                        <option value="English Language">English Language</option>
                        <option value="Mathematics">Mathematics</option>
                        <option value="Basic Science">Basic Science</option>
                        <option value="Basic Technology">Basic Technology</option>
                        <option value="Business Studies">Business Studies</option>
                        <option value="CRS">C.R.S</option>
                        <option value="Physics">Physics</option>
                        <option value="Chemistry">Chemistry</option>
                        <option value="Biology">Biology</option>
                        <option value="Further Mathematics">Further Mathematics</option>
                        <option value="Literature">Literature</option>
                        <option value="Civic Education">Civic Education</option>
                        <option value="Commerce">Commerce</option>
                        <option value="Accounting">Accounting</option>
                        <option value="Government">Government</option>
                        <option value="Creatrive Arts">Creative Arts</option>
                        <option value="Catering Crafts">Catering Crafts</option>
                        <option value="Economics">Economics</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                 <div class="form-group mb-1 mt-1">
                    <label for="number of questions" class="form-label">Total Number of Questions</label>
                    <select class="form-control" name="num_quest">
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="date" class="form-label">Due Date</label>
                    <input type="date" name="due_date" class="form-control" required/>
                </div>
            </div>
    </div>
    <div class="row p-2">
        <div class="col-lg-4">
            <div class="form-group mb-1 mt-1">
                <label for="duration" class="form-label">Time Allowed (Minutes)</label>
                <select class="form-control" name="duration">
                    <option value="25">25 Minutes</option>
                        <option value="30">30 Minutes</option>
                        <option value="45">45 Minutes</option>
                        <option value="60">60 Minutes</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
            <div class="form-group mb-1 mt-1">
                <label for="author" class="form-label">Subject Teacher</label>
                <select class="form-control" name="author">
                    <option value="Isiaka Azeez">Isiaka Azeez</option>
                        <option value="DIS/C/22/001">Oshiyokun Olamide</option>
                        <option value="DIS/C/23/003">Femi Adeshina</option>
                        <option value="">Okelade Samuel</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                 <div class="form-group mb-1 mt-1">
                    <label for="exam type" class="form-label">Exam Type</label>
                    <select class="form-control" name="exam_type">
                        <option value="Mid-Exam">Mid-Term</option>
                        <option value="Exam">Examination</option>
                        <option value="Entrance">Entrance Test</option>
                        <option value="Common_Entrance">Common Entrance</option>
                    </select>
                </div>
            </div>
        <div class="row text center p-2 mt-3">
            <div class="col-lg-6 mx-auto">
                <input type="submit" name="submit" value= "Submit" class="btn btn-success btn-lg"> 
            </div>
        </div>
    </form>
</div>
<!--JQuery Begins here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#addexam").submit(function(event){
    event.preventDefault();
    let formdata= new FormData(this);
    $.ajax({
        method:"post",
        url:"../exams/exams.php?qs=add_exam",
        data:formdata,
        processData:false,
        contentType:false,
        success: function(res){
            alert(res);
           window.location.reload();
        }
    })
  })
});
</script>