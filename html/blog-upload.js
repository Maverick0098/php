$(document).ready(function () {
  // Hide the file input field
  $("#fetured_pic").hide();

  // Trigger file input click when clicking on the feature section
  $("#fetured-image").on("click", function () {
    $("#fetured_pic").click();
  });

  // Display the selected image
  $("#fetured_pic").on("change", function () {
    var file = $(this).prop("files")[0];
    if (file) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#fetured-img").attr("src", e.target.result).show();
      };
      reader.readAsDataURL(file);
    }
  });

  // Handle form submission via AJAX
  $("#blog-form").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    $.ajax({
      url: "blog-upload-action.php", // Change this to the URL of your PHP upload handler
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        // Handle the response from the server
        // alert('Blog uploaded successfully');
        if (response.success) {
          window.location.reload();
        } else {
          $("#error-message")
            .html(response.message)
            .css("color", "#9e291c")
            .css("font-size", "24px");
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        // Handle errors here
        alert("An error occurred: " + textStatus);
      },
    });
  });
});
