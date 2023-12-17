<?php 
session_start();
require 'db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$passwordHash = password_hash($password,PASSWORD_DEFAULT);

if(empty($password)){
    $uploadedFile = $_FILES['photo'];
    if($uploadedFile['name'] == ''){
        $update = "UPDATE crueds SET name='$name',email='$email',phone='$phone' WHERE id=$id";
        $update_result = mysqli_query($dbConn,$update);
        $_SESSION['success'] = 'user updated!';
        header('location: edit.php?id='.$id);
    }
    else{
        $after_explode = explode('.',$uploadedFile['name']);
        $extension = end($after_explode);
        $allowed_extension = array('jpg','png','webp','gif');
        if(in_array($extension,$allowed_extension)){
            if($uploadedFile['size'] <= 10000000 ){
                $select = "SELECT * FROM crueds WHERE id=$id";
                $select_result = mysqli_query($dbConn,$select);
                $after_assoc = mysqli_fetch_assoc($select_result);
                $delete_form = "upload/crued/".$after_assoc['photo'];
                unlink($delete_form);

                $file_name = $id.'.'.$extension;
                $new_location = 'upload/crued/'.$file_name;
                move_uploaded_file($uploadedFile['tmp_name'], $new_location);

                $update = "UPDATE crueds SET name='$name',email='$email',phone='$phone', photo='$file_name' WHERE id=$id";
                $updateResult = mysqli_query($dbConn, $update);

                $_SESSION['success'] = 'the data created Successfull!';
                header('location:index.php');
            }
            else{
                $_SESSION['size'] = 'file size too long';
                header('location: edit.php?id='.$id);
            }
        }
        else{
            $_SESSION['extension'] = 'invalid extension!';
            header('location: edit.php?id='.$id); 
        } 
    }
}
else{
    $uploadedFile = $_FILES['photo'];
    if($uploadedFile['name'] == ''){
        $update = "UPDATE crueds SET name='$name',email='$email',phone='$phone',password='$passwordHash' WHERE id=$id";
        $update_result = mysqli_query($dbConn,$update);
        $_SESSION['success'] = 'user updated!';
        header('location: edit.php?id='.$id);
    }
    else{
        $after_explode = explode('.',$uploadedFile['name']);
        $extension = end($after_explode);
        $allowed_extension = array('jpg','png','webp','gif');
        if(in_array($extension,$allowed_extension)){
            if($uploadedFile['size'] <= 10000000 ){
                $select = "SELECT * FROM crueds WHERE id=$id";
                $select_result = mysqli_query($dbConn,$select);
                $after_assoc = mysqli_fetch_assoc($select_result);
                $delete_form = "upload/crued/".$after_assoc['photo'];
                unlink($delete_form);

                $file_name = $id.'.'.$extension;
                $new_location = 'upload/crued/'.$file_name;
                move_uploaded_file($uploadedFile['tmp_name'], $new_location);

                $update = "UPDATE crueds SET name='$name',email='$email',phone='$phone',password='$passwordHash', photo='$file_name' WHERE id=$id";
                $updateResult = mysqli_query($dbConn, $update);

                $_SESSION['success'] = 'the data created Successfull!';
                header('location:index.php');
            }
            else{
                $_SESSION['size'] = 'file size too long';
                header('location: edit.php?id='.$id);
            }
        }
        else{
            $_SESSION['extension'] = 'invalid extension!';
            header('location: edit.php?id='.$id); 
        }   
    }
}




?>