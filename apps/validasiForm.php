<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Form</title>
</head>

<body>
    <?php

    if (isset($_GET["yourName"]) && isset($_GET["yourAddress"])) {
        echo "<p>Selamat Datang " . $_GET["yourName"] . " yang berasal dari " . $_GET["yourAddress"] . "";
    } else {
        echo "Maaf, Kamu harus mengakses halaman ini dari validasiForm.html";
    }

    ?>

</body>

</html>