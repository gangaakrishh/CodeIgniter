<?php

$data = session()->get();
// print_r($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashbaord</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
<div class="container martop">
    <div class="col-md-6 center_div">
        <h4>Welcome <?php echo $data['firstname']. ' ' .$data['lastname']?> | <a href="<?= base_url('logout') ?>">Logout</a></h4>
    </div>
    <div class="container">
        <a href="<?php echo base_url() ?>exportuserdata" class="btn btn-primary">Export Excel</a>
        <h2>User Data</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usersdata as $key=>$val){?>
                    <tr>
                        <th><?php echo $val['firstname']?></th>
                        <th><?php echo $val['lastname']?></th>
                        <th><?php echo $val['email']?></th>
                        <th><a href="<?php echo base_url() ?>editUser/<?php echo $val['id']?>">Edit</a> | <a onclick="return confirm('Are you sure you want to delete this record')" href="<?php echo base_url() ?>deleteUser/<?php echo $val['id']?>">Delete</a> | <a href="<?php echo base_url() ?>upload/<?php echo $val['id']?>">Upload Image</a></th>                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
    </div>
</div>
</body>
</html>
