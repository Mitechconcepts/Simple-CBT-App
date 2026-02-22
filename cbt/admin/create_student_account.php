<?php
//define("root", $_SERVER["DOCUMENT_ROOT"]."/cbt/");
include_once("db.php");
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="POST"){

//Get the submitted entries
$sname= $_POST["sname"];
$other= $_POST["other"];
$adm_num= $_POST["adm_num"];
$class= $_POST["class"];
$role= "student";
$auth_code= $_POST["auth_code"];
$file_name= $_FILES["file"]["name"];
$file_size= $_FILES["file"]["size"];
$file_type= $_FILES["file"]["type"];
$file_tmp= $_FILES["file"]["tmp_name"];
$dir= "uploads/";
$allowed_ext = array("JPEG", "JPG", "PNG");
$file_ext= PATHINFO($file_name, PATHINFO_EXTENSION);
$uploaded_file= $dir.basename($file_name);

//Check if a user with the admission number already exist
if (checkUser($conn, $adm_num)==="false"){

    //check file extension
    if(in_array(strtoupper($file_ext), $allowed_ext)){
    //check file size before uploading
    $max_size= 1024 * 1024;
        if($file_size > $max_size){
            echo "<p class='text-danger'> Error occured while uploading files </span>";
        }
        elseif($file_size===0){
            echo "<p class='text-danger p-2'>File not detected.</p>";
        }
        else{
        //check if file already existed
            if(file_exists($uploaded_file)){
            echo "<p class='text-danger fw-bold p-2'>File already existed with the same name</p>";
            }
            else{
            //if file size is ok, move to uploads folder
                $action= move_uploaded_file($file_tmp, $uploaded_file);
                if($action){
                $sql= "insert INTO users (surname, other_names, user_id, class, directory, auth_code, user_role) VALUES(?, ?, ?, ?, ?, ?, ?)";
                $stmt= mysqli_prepare($conn, $sql);
                if($stmt){
                    mysqli_stmt_bind_param($stmt, "sssssss", $sname, $other, $adm_num, $class, $uploaded_file, $auth_code, $role);
                    mysqli_stmt_execute($stmt);
                    echo "<p class='p-2 text-success'>Student creation executed successfully</p>";
            
                }
                else{
                    echo "Data execution failed due to possible manipulations";
                }
            }
            else{
                echo "<p class='text-danger p-2 fw-bold'>failed to move files</p>";
            }
        }

    }
  
    }
    else{
        echo "<p class='p-2 text-danger fw-bold'>Invalid file detected";
    }
}
else{
    echo "<p class='p-2 text-danger fw-bold'>A user with the Admission Number ". $adm_num. " already exists </p>";
}
}
else{
    header("Location: index.php");
}
?>