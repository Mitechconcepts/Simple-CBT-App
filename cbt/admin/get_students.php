<table class="table table-striped">
    <thead>
        <tr><th>Names</th><th>Admission Number</th><th>Password</th><th>Class</th><th>Photo</th>
    </thead>
    <tbody>
        <?php
            include_once("db.php");
            $data= getAllStudents($conn);
            foreach($data as $d){
                echo '<tr><td>'.$d["surname"]. ' '. $d["other_names"]. '</td><td>'.$d["user_id"]. '</td><td>'.$d["auth_code"]. '</td><td>'. $d["class"]. '</td><td><img style="height:40px; width:40px;" src="'.$d["directory"].'"</tr>';
            }
        ?>
    </tbody>