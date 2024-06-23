<?php
if (isset($_GET['yourname']) && isset($_GET['youraddress'])) {
    $name = $_GET['yourname'];
    $address = $_GET['youraddress'];
    $form_input = "&yourname = $name &youraddress = $address";
} else {
    header("Location:formRequired.php?error=variable_undefined");
}
if (empty($name)) {
    header("Location:formRequired.php?error=empty_name" . $form_input);
} else if (empty($address)) {
    header("Location:formRequired.php?error=empty_address" . $form_input);
} else {
    echo "Nama Kamu: $name <br> Alamat Kamu : $address";
}
