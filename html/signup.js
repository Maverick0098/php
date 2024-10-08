/* function checkPasswordMatch(){
       var password = document.getElementById("p").value;
       var confirm = document.getElementById("cp").value;
       if (password !== confirm) {
           document.getElementById("msg1").innerHTML = "Passwords do not match!";
           document.getElementById("msg1").style.color = "red";
       }else{
           document.getElementById("msg1").innerHTML = "Passwords match.";
           document.getElementById("msg1").style.color = "green";
       }
   }
*/
$(document).ready(function() {
  $("#togglePassword").click(function(){
    var pswf = $("#p");
    var type = pswf.attr("type")==="password" ? "text" : "password";
    pswf.attr("type",type);
    $(this).text(type === 'password' ? '👁️' : '🔒');
  });

function validatePassword() {
    var password = $("#p").val();
    var validity = true;
    if(password.length >= 8) {
        $("#perror").removeClass("invalid").addClass("valid");
    }else {
        $("#perror").removeClass("valid").addClass("invalid");
        validity = false;
    }
    if(password.match(/[a-z]/)) {
        $("#perror").removeClass("invalid").addClass("valid");
    }else {
        $("#perror").removeClass("valid").addClass("invalid");
        validity = false;
    }
    if(password.match(/[A-Z]/)) {
        $("#perror").removeClass("invalid").addClass("valid");
    }else {
        $("#perror").removeClass("valid").addClass("invalid");
        validity = false;
    }
    if(password.match(/[0-9]/)) {
        $("#perror").removeClass("invalid").addClass("valid");
    }else {
        $("#perror").removeClass("valid").addClass("invalid");
        validity= false;
    }
    if(password.match(/[!@#$%^&*]/)) {
        $("#perror").removeClass("invalid").addClass("valid");
    }else {
        $("#perror").removeClass("valid").addClass("invalid");
        validity = false;
    }
    if (validity) {
        $("#perror").removeClass("invalid").addClass("valid").text("Password is valid");
    } else {
        $("#perror").removeClass("valid").addClass("invalid").text("Password is invalid");
    }
    return validity;
}

$("#p").on("keyup", validatePassword);


$("#cp").on('keyup', function(){
    var password = $("#p").val();
    var confirm = $("#cp").val();
    if(password != confirm){
        $("#msg1").html("Passwords do not match!").css("color", "red");
    }else{
        $("#msg1").html("Passwords match.").css("color", "green");
    }
});

$("#email").on('blur', function(){
    $.ajax({
        method:"POST",
        url: "email-unique-action.php",
        data: { email : $('#email').val()},
        success: function(response) {
            console.log( typeof response, response);
            let parseJson = JSON.parse(response)
            console.log(parseJson);
            if(parseJson.status===200){
            $("#msg2").html(parseJson.msg).css("color", "red");
            $('#button').attr("disabled", "disabled");
            }
        },
        error: function(){
            $("#msg2").html("An error occurred. Please try again.").css("color", "red");
        }
    })
});

$("#SignupForm").submit(function(event) {
    if(validatePassword()) {
        event.preventDefault();
        var isValid = true;
    
        $('input').each(function() {
            if ($(this).val() === '') {
                isValid = false;
                $(this).next('.error').text('This field is required.');
            } else {
                $(this).next('.error').text('');
            }
        });
        var password = $("#p").val();
        var confirmPassword = $("#cp").val();
        if (password !== confirmPassword) {
                isValid = false;
                $("#cp").next('.error').text('Passwords do not match!');
            } else {
                $("#cp").next('.error').text('');
            }
        if (isValid) {
            $.ajax({
                type:"POST",
                url: "signup-action.php",
                data: $("#SignupForm").serialize(),
                success: function(response) {
                    console.log(response);
                    $("#msg2").html(response).css("color", "green");
                },
                error: function() {
                    $("#msg2").html("An error occurred. Please try again.").css("color", "red");
                }
            });
        }else {
            $("#msg2").html("Please fix the errors above.").css("color", "red");
        }
    }else{
        alert("Password does not meet the criteria.");
    }
});
});


