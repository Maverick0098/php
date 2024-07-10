<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Firstname = $_POST['fname'];
    $Lastname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $cpassword = $_POST['cp'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    echo "Received data: ";
    echo "First name: " . $Firstname . "<br>";
    echo "Last name: " . $Lastname . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Password: " . $password . "<br>";
    echo "Success";
    echo "<br>"

    include 'connection.php';
    $query = mysqli_query($conn,"INSERT INTO users (fname, lname, email, password, cpassword) VALUES ('$Firstname','$Lastname','$email','$hashed_password','$cpassword')");
    mysqli_error($conn);
}
?>