<?php
session_start();
include 'connection.php';
if(!isset($_SESSION["email"])){
    header("location:login.php");
}
// echo "Profile page";
$email=$_SESSION["email"];
$query = "SELECT fname,lname,email From users where email= '$email' ";
$result = mysqli_query($conn,$query);
if($result){
    $row=mysqli_fetch_assoc($result);
    // print_r($row);
    // echo "Welcome, ".$row['fname'].' '.$row['lname'];
    $email=$row['email'];
    $fname=$row['fname'];
    $lname=$row['lname'];
}

$query = "SELECT ID FROM users WHERE email = '$email'";
$userid = mysqli_query($conn,$query);
$user_id = mysqli_fetch_assoc($userid);
$query2 = "SELECT * FROM profile WHERE user_id = '".$user_id["ID"]."'";
$result2 = mysqli_query($conn,$query2);
if($result2){
    $row2 = mysqli_fetch_assoc($result2);
}

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <form action="profile-action.php" method="post" enctype="multipart/form-data">
        <label>Upload Pic</label>
        <input type = "file" name="profile_pic">
        <input type="submit" value="Upload">
    </form>

    <form action="logout.php" method="get">
    <input type="submit" value="Log Out">
    </form>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="form-container">
    <div id="logout">
    <form action="logout.php" method="get">
    <button class="btn-pink" >Logout</button>
    </form>
    </div>
    </br>
    <!-- <form action="profile-action.php" method="post" enctype="multipart/form-data" class="container"> -->
    <form  method="post" enctype="multipart/form-data" class="container" id="profileform"> 
        <div class="box" id="data">
            <h1>My Account</h1>
            </br>
            </br>
            <div class="form1">
                <b style="color: red;">Your Basic Information:</b>
                <div class="personalinfo" >
                <div id="bx1">
                    <label for="email">Email Address : </label>
                    <!-- <input type="Email" id="email" name="email" placeholder="Email" style="display: none"> -->
                    <?php echo $email;?>
                </div>
                <div id="bx2">
                    <label for="fname">First Name : </label>
                    <!-- <input type="text" id="fname" name="fname" placeholder="First Name" style="display: none"> -->
                    <?php echo $fname;?>
                </div>
                <div id="bx3">
                    <label for="lname">Last Name : </label>
                    <!-- <input type="text" id="lname" name="lname" placeholder="Last Name" style="display:none"> -->
                    <?php echo $lname;?>
                </div>
                <div id="bx4">
                    <label for="nick">Nick Name : </label>
                    <?php if(!isset($row2['nickname'])){
                        echo ' <input type="text" id="nick" name="nick" placeholder="Nick Name"> ';
                    }else{
                        echo '<span id="bx4">'.$row2['nickname'].'</span>';
                    }
                    ?> </div>
                <div id="bx5">
                    <label for="dob">D.O.B : </label>
                    <?php if(!isset($row2['dob'])){
                        echo ' <input type="date" id="dob" name="dob"> ';
                    }else{
                        echo '<span id="bx5">'.$row2['dob'].'</span>';
                    }
                    ?> </div>
                    <div id="bx6">
                    <label for="tarea">Address : </label>
                    <!-- <textarea id="tarea" name="tarea" rows="1" cols="70"></textarea></div> -->
                    <?php if(!isset($row2['address'])){
                        echo ' <textarea id="tarea" name="tarea" rows="1" cols="70"></textarea> ';
                    }else{
                        echo '<span id="bx6">'.$row2['address'].'</span>';
                    }
                    ?> </div>
                </div>
            </div>
            </br>
            </br>
            </br>
            <div class="form1">
                    <b style="color: red;">Body Information:</b>
                    <div class="personalinfo" >
                        <div class="bx7">
                        <h4>Height: </h4>
                        <!-- <input type="number" id="height1" name="height1"> -->
                        <?php if(!isset($row2['height_ft'])){
                        echo ' <input type="number" id="height1" name="height1"> ';
                        }else{
                        echo '<span id="bx7">'.$row2['height_ft'].'</span>';
                        }
                        ?>
                        <label for="height1">feet </label>
                        <!-- <input type="number" id="height2" name="height2"> -->
                        <?php if(!isset($row2['height_in'])){
                        echo ' <input type="number" id="height2" name="height2"> ';
                        }else{
                        echo '<span id="bx7">'.$row2['height_in'].'</span>';
                        }
                        ?>
                        <label for="height2">in </label></div>

                        <div class="bx7">
                            <h4>Weight: </h4>
                            <!-- <input type="number" id="weight1" name="weight1"> -->
                            <?php if(!isset($row2['weight'])){
                            echo ' <input type="number" id="weight1" name="weight1"> ';
                            }else{
                            echo '<span id="bx7">'.$row2['weight'].'</span>';
                            }
                            ?>
                            <label for="weight1">lbs </label></div>
                          
                    </div>      
            </div>
            </br>
            </br>
            </br>
            <div class="form1">
                    <b style="color: red;">User Information:</b>
                    <div class="personalinfo" >
                        <div id="b1">
                        <label for="uname">User Name : </label>
                        <input type="name" id="uname" name="uname" placeholder="User Name"></div>
                        <div id="b2">
                        <label for="Country">Country Name : </label>
                        <select name="country" id="counry">
                            <option value="Select">Select Country</option>
                            <option value="India">India</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Nepal">Nepal</option>
                        </select></div>
                        <div id="b3">
                            <label for="Gender">Gender: </label>
                            <input type="radio" id="male" name="g" value="male">
                            <label for="male">Male</label><br>
                            <input type="radio" id="female" name="g" value="female">
                            <label for="female">Female</label><br>
                            <input type="radio" id="others" name="g" value="others">
                            <label for="others">others</label></div>
                        <div id="b4">
                            <label for="pno">Phone Number : </label>
                            <!-- <input type="number" id="pno" name="pno" placeholder="123456789"></div> -->
                            <?php if(!isset($row2['phnumber'])){
                            echo ' <input type="text" id="pno" name="pno" placeholder="123456789"> ';
                            }else{
                            echo '<span id="b4">'.$row2['phnumber'].'</span>';
                            }
                            ?></div>
                        <div id="b5">
                            <label for="blood">Blood Group : </label>
                            <!-- <input type="text" id="blood" name="bg" placeholder="ex: A+"></div> -->
                            <?php if(!isset($row2['bloodgroup'])){
                            echo ' <input type="text" id="blood" name="bg" placeholder="ex: A+"> ';
                            }else{
                            echo '<span id="b5">'.$row2['bloodgroup'].'</span>';
                            }
                            ?></div>
                        <div id="b6">
                            <label for="dig">Designation : </label>
                            <!-- <input type="text" id="dig" name="dig" placeholder="ex: System Engineer"></div> -->
                            <?php if(!isset($row2['designation'])){
                            echo ' <input type="text" id="dig" name="dig" placeholder="ex: System Engineer"> ';
                            }else{
                            echo '<span id="b6">'.$row2['designation'].'</span>';
                            }
                            ?></div>
                    </div>
                
                </div>
            </br>
            </br>
            <div id="final">
                <input type="submit" value="Save" id="Save" class="btn-pink">
            </div>
            <div id="error-message"></div>
        </div>
        <div class="box" id="picture">
            <div id="pic">
                <!-- <input type="file" name="profile_pic" id="file" class="file-input"> -->
                <?php if(!isset($row2['profilepic'])){
                            echo ' <input type="file" name="profile_pic" id="file" class="file-input"> ';
                            }else{
                            echo '<img src="http://localhost/php/html/uploads/'.trim($row2['profilepic']).'"/>';
                            }
                ?> 
            </div>
        </div>
        <div class="box" id="bio">
            <div id="bio-container">
            <h2 style="color: red;">About Yourself</h2>
            </br>
            <textarea name="bio" class="bio-text" placeholder="Write your bio here..."></textarea>
            <!-- <div id="b"><button type="submit" class="btn-pink">Save</button>
                        <button type="submit" class="btn-pink">Edit</button> 
            </div> -->
            </div>
        </div>
    </form>

    </div>
    <script src="profile.js"></script>
</body>
</html>

