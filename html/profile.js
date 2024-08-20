$(document).ready(function () {
  $("#edit").on("click", function () {
    $(".form-control").prop("readonly", false);
    $("textarea").prop("readonly", false);
    // $("#profile_picture").prop("disabled", false);
    // $('#profile_pic').show();
    $("#profileform").find('input[type="submit"]').show();
    $(this).hide();
  });

  $("#profileform").on("submit", function (e) {
    console.log("Inside submit click!!");

    e.preventDefault();
    var formData = new FormData(this);
    // console.log("Form :", formData);

    $.ajax({
      url: "profile-action.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        console.log("Response :", response);
        if (response.success) {
          window.location.reload();
        } else {
          $("#error-message")
            .html(response.message)
            .css("color", "#9e291c")
            .css("font-size", "24px");
        }
      },
      error: function (error) {
        console.log("Error :", error);
      },
    });
  });
});
