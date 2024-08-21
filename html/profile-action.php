<?php
session_start();
include 'connection.php';

header('Content-Type: application/json');

$response = array('success' => false, 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables
    $profilePicturePath = '';
    $maxFileSize = 1 * 1024 * 1024; // 1 MB
    $allowedTypes = ['image/jpeg'];
    $isValid = true;

    // Fetch user ID
    $email = $_SESSION["email"];
    $query = "SELECT ID FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $user_id = mysqli_fetch_assoc($result);

    // Handle file upload
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
        $fileSize = $_FILES['profile_pic']['size'];
        $fileType = $_FILES['profile_pic']['type'];

        if ($fileSize > $maxFileSize) {
            $response['message'] .= "Max file size 1 MB";
            $isValid = false;
        }

        if (!in_array($fileType, $allowedTypes)) {
            $response['message'] .= "Only JPG files are allowed.<br>";
            $isValid = false;
        }

        if ($isValid) {
            $profilePicture = time() . '-' . basename($_FILES['profile_pic']['name']);
            $destination = './uploads/' . $profilePicture;

            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $destination)) {
                $profilePicturePath = $profilePicture;
            } else {
                $response['message'] .= "File could not be uploaded.<br>";
                $isValid = false;
            }
        }
    }

 if($isValid) {

    // Prepare data for insertion/update
    $dob = $_POST["datemax"];
    $contact = $_POST["phone"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];

    // Check if profile already exists
    $query = "SELECT * FROM profile WHERE user_id = '".$user_id["ID"]."'";
    $result2 = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result2);
    if ($count > 0) {
        // Update existing profile
        $uquery = "UPDATE profile SET ";
        if($profilePicturePath)  $uquery .= "profile_pic = '".($profilePicturePath ?? "")."',"; 
                  $uquery .= " datemax = '$dob'".","; 
                  $uquery .= " phone = '$contact', 
                  address = '$address', 
                  city = '$city', 
                  state = '$state' 
                  WHERE user_id = '".$user_id["ID"]."'";
    } else {
        // Insert new profile
        $iquery = "INSERT INTO profile (user_id, profile_pic, datemax, phone, address, city, state) 
                  VALUES ('".$user_id["ID"]."', '".($profilePicturePath ?? "")."', '$dob', '$contact', '$address', '$city', '$state')";
                  echo"<pre>";
                  print_r($iquery);
                  echo"</pre>";
    }

    $finalQuery = $count ? $uquery : $iquery;

    if (mysqli_query($conn, $finalQuery)) {
        $response['success'] = true;
        $response['message'] = "Profile updated successfully.";
    } else {
        $response['message'] .= "Error: Could not execute the query. " . mysqli_error($conn);
    }
 };

    echo json_encode($response);
}
   







