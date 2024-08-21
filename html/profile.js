$(document).ready(function () {
  $("#profile-image").on("click", function () {
    $("#profile_picture").click();
    console.log("hi");
  });

  $("#profile_picture").on("change", function (event) {
    console.log("hi2");
    var file = event.target.files[0];
    if (file) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#profile-img").attr("src", e.target.result);
      };
      reader.readAsDataURL(file);
    }
  });

  $("#edit").on("click", function () {
    $(".form-control").prop("readonly", false);
    $("textarea").prop("readonly", false);
    $("select").prop("disabled", false);
    $("#profile_picture").prop("disabled", false);
    // $('#profile_pic').show();
    $("#profileform").find('input[type="submit"]').show();
    $(this).hide();
  });

  $("#profileform").on("submit", function (e) {
    console.log("Profile pic submit!!");

    e.preventDefault();
    var formData = new FormData(this);
    // $("#save").hide();
    // $("#edit").show();

    $.ajax({
      url: "profile-action.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        if (response.success) {
          window.location.reload();
        } else {
          $("#error-message")
            .html(response.message)
            .css("color", "#9e291c")
            .css("font-size", "24px");
        }
      },
    });
  });
});
