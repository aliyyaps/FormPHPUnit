<?php
if (isset($_GET['yourname']) && isset($_GET['youremail'])) {
    $name = $_GET['yourname'];
    $email = $_GET['youremail'];
    $form_input = "&yourname = $name &youremail = $email";
} else {
    header("Location:formEmail.php?error=variable_undefined");
}
if (empty($name)) {
    header("Location:formEmail.php?error=empty_name" . $form_input);
} elseif (!preg_match("/^[a-zA-z ]*$/", $name)) {
    header("Location:formEmail.php?error=invalid_name" . $form_input);
} elseif (empty($email)) {
    header("Location:formEmail.php?error=empty_email" . $form_input);
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location:formEmail.php?error=invalid_email" . $form_input);
} else {
    echo "Nama Kamu: $name <br> Email Kamu: $email";
}
