// function validateForm(event){
//     event.preventDefault(); 
//     var eid = document.getElementById('email').value;
//     var password = document.getElementById('p').value;
//     var message = document.getElementById('msg');
//     if (eid === 'arijitseal71@gmail.com' && password === 'Arijit@123') {
//         message.textContent = 'Login successful!';
//         message.classList.remove('error-message');
//         message.classList.add('success-message');
//     }else{
//         message.textContent = 'Invalid ID or Password';
//         message.classList.remove('success-message');
//         message.classList.add('error-message');
//     }
// }

var togglePassword = document.getElementById('togglePassword');
togglePassword.addEventListener('click',function(){
    var passwordInput = document.getElementById('p');
    var type =  passwordInput.getAttribute('type')==='password'?'text':'password';
    passwordInput.setAttribute('type', type);
    this.textContent = type === 'password' ? '👁️' : '🔒';
});

$(document).ready(function(){
   $("#loginForm").submit(function(event){
    event.preventDefault();
    var isValid = false;

    var eid = $("#email").val();
    var password = $("#p").val();
    if (eid === 'arijitseal71@gmail.com' && password === 'Arijit@123') {
        isValid=true;
    }else{
        isValid=false;
    }
    if(isValid){
    $.ajax({
        'url':"loginsucess.php",
        'method':"POST",
        'data': $("#loginForm").serialize(),
        'success':function(response) {
            $("#msg").html("Log in successful!").css("color", "green");
        },
        'error':function() {
            $("#msg").html("An error occurred. Please try again.").css("color", "red");
        }
    }); 
    }else {
        $("#msg").html("Invalid ID or Password.").css("color", "red");
    }
});
});