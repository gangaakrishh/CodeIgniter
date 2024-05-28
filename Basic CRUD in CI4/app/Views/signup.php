<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
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
        <?php if(isset($validation)) : ?>
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <?= $validation->listErrors(); ?>
                </div>
            </div>
        <?php endif;?>
        <?php if(isset($flash_message)) : ?>
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    Congratulations! Registered successfully
                </div>
            </div>
        <?php endif;?>
        <form action="./signup" method="post">
            <div class="form-group">
                <label for="email">First Name</label>
                <input type="text" class="form-control" name="firstname" value=<?= set_value('firstname')?>>
            </div>
            <div class="form-group">
                <label for="email">Last Name</label>
                <input type="text" class="form-control" name="lastname" value=<?= set_value('lastname')?>>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value=<?= set_value('email')?>>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" value=<?= set_value('password')?>>
            </div>
            <div class="form-group">
                <label for="password">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirm" value=<?= set_value('password_confirm')?>>
            </div>
            <div class="checkbox">
                <a href="./"><label>Sign in</label></a>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
