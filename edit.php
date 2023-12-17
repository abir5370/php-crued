<?php 
session_start();
require 'db.php';
require 'include/header.php';

$id = $_GET['id'];

$select = "SELECT * FROM crueds WHERE id=$id";
$result = mysqli_query($dbConn,$select);
$crueds = mysqli_fetch_assoc($result);


?>
<div class="row justify-content-center mt-3">
    <div class="col-md-6">
        <div class="card">

            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success"><?=$_SESSION['success']?></div>
            <?php } unset($_SESSION['success'])?>
            <div class="card-header">Edit data</div>
            <div class="card-body">
                <form action="update.php" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="id" value="<?=$crueds['id']?>">
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-3">
                            <label for="name" class="col-form-label">Name</label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="name" id="name" class="form-control" value="<?=$crueds['Name']?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-3">
                            <label for="email" class="col-form-label">email</label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="email"  class="form-control" value="<?=$crueds['Email']?>">
                            <?php if(isset($_SESSION['invalid'])) { ?>
                                <strong class="text-danger"><?=$_SESSION['invalid']?></strong>
                            <?php } ?>
                            <?php if(isset($_SESSION['exist'])) { ?>
                                <strong class="text-danger"><?=$_SESSION['exist']?></strong>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-3">
                            <label for="phone" class="col-form-label">Phone</label>
                        </div>
                        <div class="col-9">
                            <input type="number" name="phone" id="phone" class="form-control" value="<?=$crueds['Phone']?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-3">
                            <label for="inputPassword6" class="col-form-label">Password</label>
                        </div>
                        <div class="col-9">
                            <input type="password" name="password" id="inputPassword6" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-3">
                            <label for="inputPassword7" class="col-form-label">Confirm Password</label>
                        </div>
                        <div class="col-9">
                            <input type="password" name="confirm_password" id="inputPasswor7" class="form-control">

                            <?php if(isset($_SESSION['password'])) { ?>
                                <strong class="text-danger"><?=$_SESSION['password']?></strong>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-4">
                        <div class="col-3">
                            <label class="col-form-label">Photo</label>
                        </div>
                        <div class="col-9">
                            <input type="file" name="photo"  class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"><br>
                            <img width="100" src="upload/crued/<?=$crueds['photo']?>" alt="">

                            <?php if(isset($_SESSION['extension'])) { ?>
                                <strong class="text-danger"><?=$_SESSION['extension']?></strong>
                            <?php } ?>
                            <?php if(isset($_SESSION['size'])) { ?>
                                <strong class="text-danger"><?=$_SESSION['size']?></strong>
                            <?php } ?>
                        </div>
                    </div>
                    <input type="submit" value="save" class="btn btn-primary w-25">
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
require 'include/footer.php';

unset($_SESSION['errors']);
unset($_SESSION['name']);
unset($_SESSION['eml']);
unset($_SESSION['phn']);
unset($_SESSION['invalid']);
unset($_SESSION['password']);
unset($_SESSION['exist']);
unset($_SESSION['extension']);
unset($_SESSION['size']);
?>
