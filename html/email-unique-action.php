<?php
include 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $result = mysqli_query($conn, "SELECT email from users where email= '".$email."'");
    $num_rows=mysqli_num_rows($result);
    $response = [
        'status'=> 200,
        'msg'=> "Email already exists"
    ];
    if($num_rows >=1){
        echo json_encode($response);

    }  
}