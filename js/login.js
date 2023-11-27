function submitForm() {
  var fName = $("input[name=name]").val();
  var password = $("input[name=password]").val();

  if (fName != "" && password != "") {
    var formData = { fName: fName, password: password };
    $("#message").html(
      '<span style="color: red">Invalid Username or password</span>'
    );
    $.ajax({
      url: "http://localhost/Guvi_web/php/login.php",
      type: "POST",
      data: formData,
      success: function (response) {
        console.log("Raw response:", response);

        var res =
          typeof response === "object" ? response : JSON.parse(response);
        console.log(res);

        if (res.success == true) {
          $("#message").html(
            '<span style="color: green">Form submitted successfully</span>'
          );
          window.location.href = "http://localhost/Guvi_web/profile.html";
        } else {
          $("#message").html(
            '<span style="color: red">Invalid Username or password..</span>'
          );
        }
      },
    });
  } else {
    $("#message").html(
      '<span style="color: red">Please fill all the fields</span>'
    );
  }
}
