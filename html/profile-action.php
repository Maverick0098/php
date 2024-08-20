<?php
session_start();
// echo "<pre>";
// print_r($_FILES);
// echo count($_FILES);
// echo  "</pre>";


include 'connection.php';

header('Content-Type: application/json');
$response = array('success' => false, 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $maxFileSize = 1 * 1024 * 1024;
    $allowedTypes = ['image/jpeg'];
    $isValid = true;
    $profilePicturePath = '';

    $email = $_SESSION["email"];
    $query = "SELECT ID FROM users WHERE email ='".$email."'";
    $result = mysqli_query($conn, $query);
    $user_id = mysqli_fetch_assoc($result);

    if(count($_FILES) && $_FILES['profile_pic']['error']===0){

        $fileSize = $_FILES['profile_pic']['size'];
        $fileType = $_FILES['profile_pic']['type'];

        if ($fileSize > $maxFileSize) {
            // $errorMessage .= "Error: File size should be less than 1 MB.<br>";
            $response['message'] .= "Max file size 1 MB";
            $isValid = false;
        }

        
        if (!in_array($fileType, $allowedTypes)) {
            // $errorMessage .= "Error: Only JPG files are allowed.<br>";
            $response['message'] .= "Only JPG files are allowed.<br>";
            $isValid = false;
        }

        
        if($isValid){
            // move_uploaded_file($_FILES['profile_pic']['tmp_name'], './uploads/'.time().'-'.$_FILES['profile_pic']['name']);

            $profilePicture = time() . '-' . basename($_FILES['profile_pic']['name']);
            $destination = './uploads/' . $profilePicture;

            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $destination)) {
                $profilePicturePath = $profilePicture;
            } else {
                // $errorMessage .= "Error: File could not be uploaded.<br>";
                $response['message'] .= "File could not be uploaded.<br>";
                $isValid = false;
            }
        }
    }  

        // var_dump($user_id);
    
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

        $query2="SELECT user_id from profile where user_id='".$user_id['ID']."'";
        $check=mysqli_query($conn,$query2);
        $isexist = mysqli_num_rows($check);
        
        // var_dump($isexist);
        if($isexist > 0){
            $uquery = "UPDATE profile SET ";
                    if($profilePicturePath)  $uquery .= "profile_pic = '".($profilePicturePath ?? "")."',"; 
                        $uquery .= " dob = '$dob'".","; 
                        $uquery .= " phnumber = '$ph', 
                        address = '$address', 
                        height_ft = '$feet',
                        height_in = '$in',
                        weight= '$weight',
                        nickname = '$nickname',
                        bloodgroup = '$bg',
                        designation = '$deg'
                        WHERE user_id = '".$user_id['ID']."'";
            
            } else {
                    $query = "INSERT INTO `profile` 
                            (`user_id`, `nickname`, `dob`, `address`, `weight`, `height_ft`, `height_in`, `username`, `countryname`, `gender`, `phnumber`, `bloodgroup`, `designation`, `profilepic`, `bio`) 
                            VALUES 
                            ('".$user_id["ID"]."', '".$nickname."', '".$dob."', '".$address."', '".$weight."', '".$feet."', '".$in."', '".$username."', '".$country."', '".$gender."', ".$ph.", '".$bg."', '".$deg."', '".$profilePicturePath."', '".$bio."')";

            }
            // print_r($query);

            $finalQuery = $isexist ? $uquery : $query;

            if (mysqli_query($conn, $finalQuery)) {
                // echo "Profile updated successfully.";
                $response['success'] = true;
                $response['message'] .= "Profile updated successfully.<br>";
            } else {
                // echo "Error: Could not execute the query. " . mysqli_error($conn);
                $response['message'] .= "Error: Could not execute the query. " . mysqli_error($conn);
            }
            echo json_encode($response);
}
   







