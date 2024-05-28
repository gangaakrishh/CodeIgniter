<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>image upload</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/css/style.css">
</head>
<body>
<div class="container martop">
    <div class="col-md-6 center_div">
        <h1>Image Upload</h1>
        
        <?php if(isset($flash_message)) : ?>
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <h4>Image Updated</h4>
                </div>
            </div>
        <?php endif;?>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="userfile" size="20"><br>
            <button type="submit" class="btn btn-info">Update</button>
        </form>
    </div>
</div>
</body>
</html>
