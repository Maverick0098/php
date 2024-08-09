$(document).ready(function() {
    $('#profileform').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        console.log("Form :", formData);

        $.ajax({
            url: 'profile-action.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log("Response :", response)
                if (response.success) {
                    window.location.reload();
                } else {
                    $('#error-message').html(response.message).css("color", "#9e291c",).css("font-size","24px");
                }
            }
        });
    });
});