<?php
$host="localhost:3307";
$user_name="root";
$password="";
$database="blog";

$conn= mysqli_connect($host,$user_name,$password,$database);
if(!$conn){
    echo "connection is not established";
}

// $query = mysqli_query($conn,"INSERT INTO users (fname, lname, email, password, cpassword) VALUES ('Bidesh', 'Saha', 'sahabidesh523@gmail.com', 'Bidesh@123', 'Bidesh@123')");