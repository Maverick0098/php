console.log("loaded home js");
$(document).ready(function () {
  console.log("inside ready function");
  $("#login").click(function () {
    $(".logo").toggle();
  });
});
