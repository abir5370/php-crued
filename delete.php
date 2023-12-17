<?php 
session_start();
require 'db.php';

$id = $_GET['id'];

//image-delete
$selectDelete = "SELECT * FROM crueds WHERE id=$id";
$selectResult = mysqli_query($dbConn,$selectDelete);
$afterAssoc = mysqli_fetch_assoc($selectResult);
$imagePath = 'upload/crued/'.$afterAssoc['photo'];
unlink($imagePath);

//databse record delete
$delete = "DELETE FROM crueds WHERE id=$id";
$result = mysqli_query($dbConn,$delete);

$_SESSION['delete'] = 'deleted successfully';
header('location: index.php');

?>