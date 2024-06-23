<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Form Handling</title>
</head>

<body>
    <h3>Halo! Selamat Datang</h3>
    <p>
        <b><?php echo $_POST["yourName"]; ?></b> yang berasal dari
        <b><?php echo $_POST["yourAddress"]; ?></b>
    </p>
</body>

</html>