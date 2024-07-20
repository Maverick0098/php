<?php
session_start();
include 'connection.php';
if(!isset($_SESSION["email"])){
    header("location:login.php");
}
// echo "Profile page";
$email=$_SESSION["email"];
$query = "SELECT fname,lname From users where email= '$email' ";
$result = mysqli_query($conn,$query);
if($result){
    $row=mysqli_fetch_assoc($result);
    // print_r($row);
    echo "Welcome, ".$row['fname'].' '.$row['lname'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <form action="logout.php" method="get">
    <input type="submit" value="Log Out">
    </form>
</body>
</html>

