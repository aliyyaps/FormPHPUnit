<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Email</title>

    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php

    //Nilai variabel error
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
    } else {
        $error = "";
    }

    //Pesan kesalahan
    $pesan = "";
    if ($error == "variable_undefined") {
        $pesan = "Maaf, kamu harus mengakses halaman ini dari formEmail.php";
    } elseif ($error == "empty_name") {
        $pesan = "Maaf, nama harus terisi";
    } elseif ($error == "invalid_name") {
        $pesan = "Maaf, nama harus berupa huruf dan spasi";
    } elseif ($error == "empty_email") {
        $pesan = "Maaf, email harus terisi";
    }
    if ($error == "invalid_email") {
        $pesan = "Maaf, email tidak sesuai";
    }

    //Isian form jika terjadi kesalahan
    if (isset($_GET['yourname']) && isset($_GET['youremail'])) {
        $name = $_GET['yourname'];
        $email = $_GET['youremail'];
    } else {
        $name = "";
        $email = "";
    }
    ?>

    <span class="error"><?php echo $pesan; ?></span>

    <table>
        <form action="prosesFormEmail.php" method="get">
            <tr>
                <td>Nama Kamu:</td>
                <td>
                    <input type="text" name="yourname" value="<?php echo $name; ?>">
                </td>
            </tr>
            <tr>
                <td>Email Kamu:</td>
                <td>
                    <input type="email" name="youremail" value="<?php echo $email; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit" value="Submit">
                </td>
            </tr>
        </form>
    </table>
</body>

</html>