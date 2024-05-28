<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
<div class="container martop">
    <div class="col-md-6 center_div">
        <?php if(isset($validation)) : ?>
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <?= $validation->listErrors() ?>
                </div>
            </div>
        <?php endif;?>
        <?php if(isset($flash_message)) : ?>
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    Invalid Credentials
                </div>
            </div>
        <?php endif;?>
        <form action="./" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="checkbox">
                <a href="signup"><label>Sign Up</label></a>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
