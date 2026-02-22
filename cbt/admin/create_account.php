<?php
define("root", $_SERVER["DOCUMENT_ROOT"]."/cbt/");
include(root."/admin/db.php");
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="POST"){
$user_id= $_POST["user_id"];
$check_user= checkUser($conn, $user_id);
if($check_user==="true"){
    $res="<span class='text-danger'>A user with the User ID $user_id already exist.</span>";
}
else{
$filename= $_FILES["file"]["name"]; 
    $tmp_dir= $_FILES["file"]["tmp_name"];
    if($filename==""){
        $res="<span class='text-danger'>File not found</span>";
    }
    else {
        $allowed_ext=array("jpeg", "jpg", "png");
        $file_type= pathinfo($filename, PATHINFO_EXTENSION);
        if(in_array($file_type, $allowed_ext)){
            $file_size= $_FILES["file"]["size"];
            $max_file_size= 1024*1024;
            if($max_file_size < ceil($file_size)){
                $res="<span class='text-danger'>File too large. Ensure it not more than 1MB</span>";
            }
            else{
                $upload_dir="uploads/";
                $target_file= $upload_dir.basename($filename);
                if(!move_uploaded_file($tmp_dir, $target_file)){
                    $res=$_FILES["file"]["error"]."<span class='text-danger'>An error was encountered while uploading the files. Please try again</span>";
                } 
                else{
                    $dir=$upload_dir.$filename;
                    if($dir){
                        $sname= $_POST["sname"]; $others= $_POST["other_names"]; $user_id= $_POST["user_id"]; $pword= $_POST["pword"]; $role= $_POST["role"];
                        $sql= "INSERT INTO ded_cbt.users (surname, other_names, user_id, auth_code, directory, user_role) VALUES('$sname', '$others', '$user_id', '$pword', '$dir', '$role')";
                        if(mysqli_query($conn, $sql)){
                            $res="<span class='text-sucess'> Entry has been made successfully!";
                        }
                        else{
                            die(mysql_error);
                        }
                        
                    }
                    
                }
                
            }
        }
        else{
            $res="<span class='text-danger'>please upload a valid file</span>";
        }
    }
}
    echo $res;
}
else {
header("Location: index.php");
}
?>