<?php
// print_r($userdata);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="<?php echo base_url()?>/assets/css/style.css">
</head>
<body>
<div class="container martop">
    <div class="col-md-6 center_div">
        <?php if(isset($flash_message)) : ?>
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    Congratulations! Updated successfully
                </div>
            </div>
        <?php endif;?>
        <form method="post">
            <div class="form-group">
                <label for="email">First Name</label>
                <input type="text" class="form-control" name="firstname" value="<?php echo $userdata['firstname']?>">
            </div>
            <div class="form-group">
                <label for="email">Last Name</label>
                <input type="text" class="form-control" name="lastname" value="<?php echo $userdata['lastname']?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $userdata['email']?>">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
