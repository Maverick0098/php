<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Firstname = $_POST['fname'];
    $Lastname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $cpassword = $_POST['cp'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    // echo "Received data: ";
    // echo "First name: " . $Firstname . "<br>";
    // echo "Last name: " . $Lastname . "<br>";
    // echo "Email: " . $email . "<br>";
    // echo "Password: " . $password . "<br>";
    // echo "Success";
    // echo "<br>";
    
    
    $query = mysqli_query($conn,"INSERT INTO users (`fname`, `lname`, `email`, `password`) VALUES ('".$Firstname."','".$Lastname."','".$email."','".$hashed_password."')");
    // mysqli_error($conn);
    if($query){
      echo "Signup Successfull";
    } else {
        echo "Something went wrong";
    }
}
    
?>