<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Required</title>

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
        $pesan = "Maaf, kamu harus mengakses halaman ini dari formRequired.php";
    } elseif ($error == "empty_name") {
        $pesan = "Maaf, nama harus terisi";
    } elseif ($error == "empty_address") {
        $pesan = "Maaf, alamat harus terisi";
    }

    //Isian form jika terjadi kesalahan
    if (isset($_GET['yourname']) && isset($_GET['youraddress'])) {
        $name = $_GET['yourname'];
        $address = $_GET['youraddress'];
    } else {
        $name = "";
        $address = "";
    }
    ?>

    <span class="error"><?php echo $pesan; ?></span>

    <table>
        <form action="prosesFormRequired.php" method="get">
            <tr>
                <td>Nama Kamu:</td>
                <td>
                    <input type="text" name="yourname" value="<?php echo $name; ?>">
                </td>
            </tr>
            <tr>
                <td>Alamat Kamu:</td>
                <td>
                    <input type="text" name="youraddress" value="<?php echo $address; ?>">
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