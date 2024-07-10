<?php
// print_r($_POST);
// die();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['psw'];

    echo "Received data: ";
    echo "Email: " . $email . "<br>";
    echo "Password: " . $password . "<br>";
    echo "Success";
}
?>