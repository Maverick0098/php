<?php
session_start();
include 'connection.php';
if(isset($_SESSION["email"])){


    $email = $_SESSION["email"];
    //Data fetching from user table
    $query = "SELECT fname ,lname,email FROM users WHERE email = '$email'";
    $result = mysqli_query($conn,$query);
    if($result){
        $row = mysqli_fetch_assoc($result);
    }
                                                        

    $query = "SELECT ID FROM users WHERE email = '$email'";
    $userid = mysqli_query($conn,$query);
    $user_id = mysqli_fetch_assoc($userid);
    $query2 = "SELECT profile_pic,phone FROM profile WHERE user_id = '".$user_id["ID"]."'";
    $result2 = mysqli_query($conn,$query2);
    if($result2){
        $row2 = mysqli_fetch_assoc($result2);
    } 
}
?>
<?php 
        $querynewpost = "SELECT fname, lname, fetured_image, blogs, created_at FROM blogsotrage ORDER BY created_at DESC LIMIT 1";
        $resultnewpost = mysqli_query($conn,$querynewpost);

        if ($resultnewpost) {
        $rownewpost = mysqli_fetch_assoc($resultnewpost); // Use mysqli_fetch_assoc for a single row
        }


        $query2 = "SELECT fname,lname,fetured_image, blogs, created_at FROM blogsotrage ORDER BY RAND() LIMIT 3";
        $result2 = mysqli_query($conn, $query2);
        
        if ($result2) {
            $rowall = mysqli_fetch_all($result2, MYSQLI_ASSOC);
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Home</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="home.js"></script>
</head>
<body>
    <div id="wrapper">
            <div class="upperHeader">
                <div class="left-part-upperHeader">
                    <i><i class="fa-brands fa-facebook"></i></i>
                    <i><i class="fa-brands fa-instagram"></i></i>
                    <i><i class="fa-brands fa-linkedin"></i></i>
                    <i><i class="fa-brands fa-youtube"></i></i>
                </div>
                <div class="right-part-upperHeader">
                    <?php 
                    if(isset($row["email"]) && isset($row2["phone"])){
                        echo '<P>'.$row['email'].' | '.$row2['phone'].'</P>';
                    }else{
                        echo'<p>production123@gmail.com | 9411225965</p>';
                    }
                    ?>
                </div>
            </div>
            <header class="head" id="headid">
                <div class="logo">
                    <figure>
                        <img src="./images/homepage-images/packaging-icon-logo-illustration-box-symbol-template-for-graphic-and-web-design-collection-free-vector.jpg" alt="" id="logoImg">
                        <figcaption>Production Hub</figcaption>
                    </figure>
                </div>
                <nav class="nav">
                    <ul>
                        <li>Home</li>
                        <li>Blog</li>
                        <li>Contact Us</li>
                        <li>About Us</li>

                        <!-- <li><a href="loginpage.php">login</a></li> 
                        <li><a href="signuppage.php">Sign up</a></li> -->

                        <?php  
                        //notworking
                        if(!isset($row) && !isset($row2['profile_pic'])){
                            echo'<li><a href="login.php">login</a></li>';
                            echo'<li><a href="signup.php">Sign up</a></li>';
                            echo '<li><img class="profile" alt="" src=""></li>';
                        }else if(isset($row) && !isset($row2['profile_pic'])){
                            echo '<li>Welcome '.$row["fname"].' '.$row["lname"].'</li>';
                            echo '<li><a href="profile.php"><img class="profile" alt="" src=""></a></li>';
                        }else if(isset($row) && isset($row2['profile_pic'])){
                            echo '<li><a href="my-blogs.php">My Blogs</a></li>';
                            echo '<li>Welcome '.$row["fname"].' '.$row["lname"].'</li>';
                            echo '<li><a href="profile.php"><img class="profile" alt="" src="./uploads/'.$row2["profile_pic"].'"></a></li>';

                        }
                        ?>
                    </ul>
                    
                </nav>
                
            </header>
            <div class="imgSection">
                <img src="./images/homepage-images/M.jpg" alt="" id="slideImg">
            </div>
            <!-- working for create post template -->
            <div class="upload_blog" id="upload_blog">
                <p>Upload Your Blog To Our Website</p>
                <a href="blog-upload.php"><button type="submit" name="upload_button" class="btn-pink" id="btn-top">Upload</button></a>
            </div>
            <!-- working for create post template -->
            <div class="newPost">
                <h3>New posts</h3>
                <ul>
                    <?php 
                        echo '<a href="#"><img src="./FeatureImage/'.$rownewpost["fetured_image"].'" alt=""></a>';
                        echo '<a href="#">';
                        echo '<p> '.$rownewpost['fname'].'</p>';
                        echo '<p>'.date('y-m-d',strtotime($rownewpost['created_at'])).'</p>';
                        echo '</a>';
                    ?>
                </ul>
            </div>
            <div class="popularPost">
                <h3>Popular posts</h3>
                    <?php 
                    //echo "<ul>";
                        foreach($rowall as $oneof){
                            //echo "<li>";
                            echo '<a href="#"><img src="./FeatureImage/'.$oneof["fetured_image"].'" alt=""></a>';
                            echo '<div class="post-details">';
                                echo '<p> '.$oneof['fname'].'</p>';
                                // echo '<p>'.$oneof['blogs'].'</p>';
                                echo '<p>'.$oneof['created_at'].'</p>';
                            echo '</div>';
                            //echo "</li>";
                        }
                    //echo "</ul>";
                    ?>
            </div>
            <footer class="footer_section">
                <section class="footer">
                    <div class="footer_part">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                    </div>
                    <div class="footer_part">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                    </div>
                    <div class="footer_part">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                    </div>
                    <div class="footer_part">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                    </div>
                </section>
                <section class="belowfooter">
                    <span>@copyright:Arijjit Seal 2024 August 21</span> 
                </section>
            </footer>
    </div>
</body>
</html>
<?php