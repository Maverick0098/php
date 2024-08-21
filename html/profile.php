<?php
session_start();
include 'connection.php';
if(!isset($_SESSION["email"])){
    header("location:login.php");
}

$email = $_SESSION["email"];

// Data fetching from user table
$query = "SELECT fname, lname, email FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Data fetching from profile table
$query = "SELECT ID FROM users WHERE email = '$email'";
$userid = mysqli_query($conn, $query);
$user_id = mysqli_fetch_assoc($userid);
$query2 = "SELECT profile_pic, datemax, phone, address, city, state FROM profile WHERE user_id = '".$user_id["ID"]."'";
$result2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_assoc($result2);
// var_dump($row2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Profile</title>
</head>
<body>
<div class="form-container">
    <!-- Logout form -->
    <form action="logout.php" method="get" class="logoutform" id="logoutform">
        <input type="submit" value="Logout">
    </form>

    <!-- Profile form -->
    <form method="post" enctype="multipart/form-data" class="profileform" id="profileform">
        <!-- profile-image-section -->
        <div class="image-part" id="image-part">
            <label for="profile_pic">Upload Profile Picture</label>            
            <span id="error-message"></span>
            <?php if(!isset($row2['profile_pic']) || empty($row2['profile_pic'])){
                        echo '<input type="file" name="profile_pic" id="profile_picture" style="display: none;">
                        <div class="profile-image" id="profile-image"><img src="" alt="" id="profile-img"></div>';
                     }else{
                        echo '<input type="file" name="profile_pic" id="profile_picture" style="display: none;" disabled>';
                        echo '<div class="profile-image" id="profile-image"><img src="./uploads/'.$row2["profile_pic"].'" alt="" id="profile-img"></div>';
                     }
            ?> 
        </div>       
        <!-- profile-info-section -->
        <div class="info-part" id="info-part">
            <div class="oneline">
                <label for="fname">First Name</label>
                <div class="start"><?php echo $row['fname']; ?></div>
            </div>
            <div class="oneline">
                <label for="lname">Last Name</label>
                <div class="start"><?php echo $row['lname']; ?></div>
            </div>
            <div class="oneline email">
                <label for="email">Email</label>
                <div class="start"><?php echo $row['email']; ?></div>
            </div>
            <div class="oneline">
                <label for="datemax">D.O.B</label>                
                <?php if(!isset($row2['datemax'])){ ;?>
                        <input type="date" class="form-control start" id="datemax" name="datemax" max="2014-12-31" required>
                    <?php }else{ ?>
                        <input type="date" class="form-control start" id="datemax" name="datemax" value="<?php echo $row2['datemax'] ?? ''; ?>" readonly>
                   <?php  } ?>
            </div>
            <div class="oneline">
                <label for="phone">Contact No</label>
                <?php if(!isset($row2['phone'])){ ;?>
                        <input type="tel" class="form-control start" id="phone" name="phone" required>
                    <?php }else{ ?>
                        <input type="tel" class="form-control start" id="phone" name="phone" value="<?php echo $row2['phone'] ?? ''; ?>" readonly>
                <?php  } ?>               
            </div>
            <div class="oneline">
                <label for="address">Address</label>
                <?php if(!isset($row2['address'])){ ;?>
                        <textarea class="form-control start" id="address" name="address" required></textarea>
                    <?php }else{ ?>
                        <textarea class="form-control start" id="address" name="address" readonly><?php echo $row2['address'] ?? ''; ?></textarea>
                <?php  } ;?>                
            </div>
            <div class="oneline">
                <label for="city">City</label>
                 <!-- working on city -->

                <?php
                    $cities = ['Kolkata', 'Bangalore', 'Indore', 'Hyderabad']; // Add more options as needed
                    $selectedCity = isset($row2['city']) ? $row2['city'] : '';

                    $disabledAttribute = isset($row2['city']) ? 'disabled' : '';
                ?>
                <select class="form-control start" id="city" name="city" <?= $disabledAttribute ?> required>
                    <option value="" disabled <?= empty($selectedCity) ? 'selected' : '' ?>>Select a city</option>
                    <?php foreach ($cities as $city): ?>
                        <option value="<?= $city ?>" <?= $city == $selectedCity ? 'selected' : '' ?>>
                            <?= $city ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!--  working on city -->

            </div>
            <div class="oneline">
                <label for="state">State</label>

                <!-- working on state -->

                <?php 
                    $states = [
                        "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh", 
                        "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jharkhand", "Karnataka", 
                        "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", 
                        "Nagaland", "Odisha", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", 
                        "Telangana", "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal"
                    ];

                    $selectedState = isset($row2['state']) ? $row2['state'] : '';
                    $isDisabled = isset($row2['state']);
                ?>
                <select class="form-control start" id="state" name="state" <?= $isDisabled ? 'disabled' : 'required' ?>>
                    <option value="" disabled <?= !$isDisabled ? 'selected' : '' ?>>Select your state</option>
                    <?php foreach ($states as $state): ?>
                     <option value="<?= htmlspecialchars($state) ?>" <?= $state == $selectedState ? 'selected' : '' ?>>
                            <?= htmlspecialchars($state) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
            <!-- working on state -->
            </div>
            <!-- working on save and edit -->
            <?php if(!isset($row2)){
                        echo '<input type="submit" value="Save" id="save" name="save">';
                     }else{
                        //  edit button added 
                        echo'<input type="submit" value="Save" id="save" name="save" style="display: none;">';
                        echo ' <input type="button" value="Edit" id="edit" name="edit">';
                     }
                    ?>

            <!-- working on save and edit -->

            <a href="home.php">Goto Home</a>
        </div>
    </form>
</div>
<script src="profile.js"></script>
</body>
</html>

