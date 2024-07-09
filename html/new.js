console.log("hello world")
$(document).ready(function(){
    console.log("Inside ready function")
    $("#click").click(function(){
        $("#ageinput").toggle()
    })
})