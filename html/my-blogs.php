<?php
 session_start();
include 'connection.php';
if(isset($_SESSION["email"])){


    $email = $_SESSION["email"];
    //Data fetching from user table
    $query = "SELECT fname ,lname FROM users WHERE email = '$email'";
    $result = mysqli_query($conn,$query);
    if($result){
        $row = mysqli_fetch_assoc($result);
    }

    //data fetching from blogstorage table
    $query = "SELECT ID FROM users WHERE email = '$email'";
    $userid = mysqli_query($conn,$query);
    $user_id = mysqli_fetch_assoc($userid);
    $query2 = "SELECT fetured_image	,blogs, created_at FROM blogsotrage WHERE user_id = '".$user_id["ID"]."'";
    $result2 = mysqli_query($conn,$query2);
    if($result2){
        $row2 = mysqli_fetch_all($result2, MYSQLI_ASSOC); 
    }
}
// echo '<pre>';
// print_r($row2);
// echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="my-blogs.css">
    <title>My Blogs</title>
</head>
<body>
    <div class="title">
        <h1>My Blogs</h1>
    </div>
    
    <div class="grid-container">
    <?php
        foreach($row2 as $oneof){
            echo '<div class="grid-items">';            
            echo '<a href="#"> <img src="./FeatureImage/'.$oneof["fetured_image"].'" alt="" width="500px" height="300px"></a>';
                echo '<div class="item-details">';
                    echo '<p> ' . $row['fname'] . '</p>';
                    echo '<p>' . $oneof['blogs'] . '</p>';
                    echo '<p> ' . $oneof['created_at'] . '</p>';
                echo '</div>';  
            echo '</div>';                
        }
    ?>    
    </div>                
</body>
</html>