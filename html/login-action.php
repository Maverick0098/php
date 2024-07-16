<?php
// print_r($_POST);
// die();
include 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['psw'];

    // echo "Received data: ";
    // echo "Email: " . $email . "<br>";
    // echo "Password: " . $password . "<br>";
    // echo "Success";

    $loginMessage = verifyLogin($email,$password);
    echo $loginMessage;
}
function verifyLogin($email,$pass){
  global $conn;
  $email=mysqli_real_escape_string($conn,$email);
  $pass=mysqli_real_escape_string($conn,$pass);

  $sql="SELECT password FROM users WHERE email='$email'";
  $result=mysqli_query($conn,$sql);

  if(mysqli_num_rows($result)==0){
    $status="Invalid Email";
  }else{
    $row=mysqli_fetch_assoc($result);
    $hashed_password = $row['password'];

    if(password_verify($pass,$hashed_password)){
        $status="Login successfull";
    }else{
        $status="Invalid password";
    }
  }
  mysqli_close($conn);
  echo $status;
}
?>