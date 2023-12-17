<?php 
session_start();
require 'db.php';

$errors = [];
$fieldNames = ['name'=>'name required','email'=>'email required','phone'=>'phone required','password'=>'password required','confirm_password'=>'confirm_password required'];

foreach($fieldNames as $filedName=>$message){
    if(empty($_POST[$filedName])){
        $errors[$filedName] = $message;
    }
}

if (count($errors) == 0) {
    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $_SESSION['invalid'] = 'invalid email format!';
        header('location:create.php');
    }
    else if($_POST['password'] != $_POST['confirm_password']){
        $_SESSION['password'] = 'password and confirm password does not exists!';
        header('location:create.php');
    }
    else{
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $passwordHash = password_hash($password,PASSWORD_DEFAULT);


        $selectEmail = "SELECT COUNT(*) as email_exist FROM crueds WHERE email='$email'";
        $selectEmailResult = mysqli_query($dbConn,$selectEmail);
        $afterAssoc = mysqli_fetch_array($selectEmailResult);

        if($afterAssoc['email_exist'] == 0){

            $uploaded_file = $_FILES['photo'];
            $after_explode = explode('.',$uploaded_file['name']);
            $extension = end($after_explode);

            $allowed_extension = array('jpg','png','webp','gif');
            if(in_array($extension,$allowed_extension)){
                if($uploaded_file['size'] <= 10000000 ){
                    $insert  = "INSERT INTO crueds(name,email,phone,password)VALUES('$name','$email','$phone','$passwordHash')";
                    $insertResult = mysqli_query($dbConn,$insert);
                    $id = mysqli_insert_id($dbConn);
                    $file_name = $id.'.'.$extension;
                    $new_location = 'upload/crued/'.$file_name;
                    move_uploaded_file($uploaded_file['tmp_name'], $new_location);
                    $update = "UPDATE crueds SET photo='$file_name' WHERE id=$id";
                    $updateResult = mysqli_query($dbConn, $update);

                    $_SESSION['success'] = 'the data created Successfull!';
                    header('location:create.php');
                }
                else{
                    $_SESSION['size'] = 'file size too long';
                    header('location: create.php');
                }
            }
            else{
                $_SESSION['extension'] = 'invalid extension!';
                header('location: create.php');  
            } 
        }
        else{
            $_SESSION['exist'] = 'the email has already taken!';
            header('location:create.php');  
        }
    }
}
else {
    $_SESSION['errors'] = $errors;
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['eml'] = $_POST['email'];
    $_SESSION['phn'] = $_POST['phone'];
    header('location: create.php');
}


?>