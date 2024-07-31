<?php
session_start();
// echo "<pre>";
// print_r($_FILES);
// echo  "</pre>";


include 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $maxFileSize = 1 * 1024 * 1024;
    $allowedTypes = ['image/jpeg'];
    $isValid = true;
    $errorMessage = '';

    if($_FILES['profile_pic']['error']===0){

        $fileSize = $_FILES['profile_pic']['size'];
        $fileType = $_FILES['profile_pic']['type'];

        if ($fileSize > $maxFileSize) {
            $errorMessage .= "Error: File size should be less than 1 MB.<br>";
            $isValid = false;
        }

        
        if (!in_array($fileType, $allowedTypes)) {
            $errorMessage .= "Error: Only JPG files are allowed.<br>";
            $isValid = false;
        }

        
        if($isValid){
            // move_uploaded_file($_FILES['profile_pic']['tmp_name'], './uploads/'.time().'-'.$_FILES['profile_pic']['name']);

            $profilePicture = time() . '-' . basename($_FILES['profile_pic']['name']);
            $destination = './uploads/' . $profilePicture;

            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $destination)) {
                $profilePicturePath = $profilePicture;
            } else {
                $errorMessage .= "Error: File could not be uploaded.<br>";
                $isValid = false;
            }
        }
    }  else {
        $errorMessage .= "Error: There was a problem with the file upload.<br>";
        $isValid = false;
    }
    
    if ($isValid) {
        $email = $_SESSION["email"];
        $query = "SELECT ID FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        $user_id = mysqli_fetch_assoc($result);
    
        // $profilePicture = time().'-'.$_FILES['profile_pic']['name'];
        $nickname = $_POST["nick"];
        $feet= $_POST["height1"];
        $in =$_POST["height2"];
        $weight = $_POST["weight1"];
        $username = $_POST["uname"];
        $dob = $_POST["dob"];
        $address = $_POST["tarea"];
        $country=$_POST["country"];
        $gender =$_POST["g"];
        $ph=$_POST["pno"];
        $bg=$_POST["bg"];
        $deg=$_POST["dig"];
        $bio=$_POST["bio"];
    
        
        
        $query = "INSERT INTO `profile` 
                (`user_id`, `nickname`, `dob`, `address`, `weight`, `height_ft`, `height_in`, `username`, `countryname`, `gender`, `phnumber`, `bloodgroup`, `designation`, `profilepic`, `bio`) 
                VALUES 
                ('".$user_id["ID"]."', '".$nickname."', '".$dob."', '".$address."', '".$weight."', '".$feet."', '".$in."', '".$username."', '".$country."', '".$gender."', '".$ph."', '".$bg."', '".$deg."', '".$profilePicturePath."', '".$bio."')";
    
        
        if (mysqli_query($conn, $query)) {
            echo "Profile updated successfully.";
        } else {
            echo "Error: Could not execute the query. " . mysqli_error($conn);
        }
    } else {
        echo $errorMessage;
    }
}







