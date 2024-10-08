<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="wrapper">
        <div class="half left-half">
            <form id="SignupForm" class="Signup-form">
               <h1>Hello, Welcome!</h1>
               <label for="fname">First Name:</label>
               <input type="text" id="fname" name="fname" placeholder="abc">
               <span class="error"></span>
               </br>
               </br>
               <label for="lname">Last Name:</label>
               <input type="text" id="lname" name="lname" placeholder="abc">
               <span class="error"></span>
               </br>
               </br>
               <label for="email">Email:</label>
               <input type="email" id="email" name="email" placeholder="name@gmail.com">
               <span class="error"></span>
               <br/>
               <br/>
               <label for="p">Password:</label>
               <div id="psw-container">
                  <input type="password" id="p" name="psw" placeholder="*********">
                  <button type="button" id="togglePassword" class="tgl">👁️</button>
               </div>
               <span id="perror" class="invalid"></span>
               <br/>
               <label for="cp">Confirm Password:</label>
               <input type="password" id="cp" name="cp" placeholder="*********"  required>
               <!-- onkeyup="checkPasswordMatch()" -->
               <span id="msg1" class="message"></span>
               <span class="error"></span>
               <br/>
               <br/>
               <input type="submit" value="Signup" id="button">
               <p id="msg2" class="message"></p>
               <p id="lg">Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
        <div class="half right-half"></div>
    </div>
    <script src="signup.js"></script>
</body>
</html>