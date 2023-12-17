<?php 
session_start();
require 'include/header.php';
require 'db.php';

$select = "SELECT*FROM crueds";
$selectResult = mysqli_query($dbConn,$select);
$assocs = mysqli_fetch_all($selectResult,MYSQLI_ASSOC);

?>
<div class="row justify-content-center mt-3">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">Crued List</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Si</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Photo</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($assocs as $key=>$assoc) {?>
                    <tr>
                        <td><?=$key+1?></td>
                        <td><?=$assoc['Name']?></td>
                        <td><?=$assoc['Email']?></td>
                        <td><?=$assoc['Phone']?></td>
                        <td><img width="50" src="upload/crued/<?=$assoc['photo']?>" alt=""></td>
                        <td><?=$assoc['Password']?></td>
                        <td>
                            <a href="edit.php?id=<?=$assoc['id']?>" class="btn btn-sm btn-primary">Edit</a>
                            <a class="btn btn-danger del" value="delete.php?id=<?=$assoc['id']?>">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>


<?php 
require 'include/footer.php';
?>
<script>
   $('.del').click(function(){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                var link = $(this).attr('value');
                window.location.href = link;
            }
            })
        })
</script>
<?php if(isset($_SESSION['delete'])) { ?>
    <script>
        Swal.fire(
        'Deleted!',
        '<?=$_SESSION['delete']?>',
        'success'
                )
    </script>
<?php } unset($_SESSION['delete']); ?>
