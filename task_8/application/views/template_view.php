<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Tasklist</title>
</head>
<body>
    <?php 
        include 'application/models/model_db.php';
        include 'application/views/'.$content_view;
    ?>
</body>
</html>