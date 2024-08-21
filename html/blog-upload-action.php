<?php
session_start();
include 'connection.php';

header('Content-Type: application/json');

$response = array('success' => false, 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables
    $maxFileSize = 2 * 1024 * 1024; // 2 MB
    $allowedTypes = ['image/jpeg', 'image/png'];
    $isValid = true;

    // Check for file upload errors
    if ($_FILES['fetured_pic']['error'] === 0) {
        // Get file size and type
        $fileSize = $_FILES['fetured_pic']['size'];
        $fileType = $_FILES['fetured_pic']['type'];

        // Validate file size
        if ($fileSize > $maxFileSize) {
            $response['message'] .= "Max file size is 2 MB.<br>";
            $isValid = false;
        }

        // Validate file type
        if (!in_array($fileType, $allowedTypes)) {
            $response['message'] .= "Only JPG and PNG files are allowed.<br>";
            $isValid = false;
        }

        // If file is valid, move it to the upload directory
        if ($isValid) {
            $profilePicture = time() . '-' . basename($_FILES['fetured_pic']['name']);
            $destination = './FeatureImage/' . $profilePicture;

            if (move_uploaded_file($_FILES['fetured_pic']['tmp_name'], $destination)) {
                $profilePicturePath = $profilePicture;
            } else {
                $response['message'] .= "File could not be uploaded.<br>";
                $isValid = false;
            }
        }
    } else {
        $response['message'] .= "There was a problem with the file upload.<br>";
        $isValid = false;
    }

    // If file is valid, proceed with database query
    if ($isValid) {
        // Fetch user ID from the users table
        $email = $_SESSION["email"];
        $query = "SELECT ID,fname,lname FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        $user_id = mysqli_fetch_assoc($result);
        
        // Prepare data for insertion
        $content = $_POST["textarea"];

        // Insert data into profile table
        $query = "INSERT INTO `blogsotrage` (`user_id`,`fname`,`lname`,`fetured_image`,`blogs`) 
                  VALUES ('".$user_id["ID"]."','".$user_id["fname"]."','".$user_id["lname"]."', '".$profilePicturePath."', '".$content."')";

        if (mysqli_query($conn, $query)) {
            $response['success'] = true;
            $response['message'] = "Profile updated successfully.";
        } else {
            $response['message'] .= "Error: Could not execute the query. " . mysqli_error($conn);
        }
    }

    echo json_encode($response);
}