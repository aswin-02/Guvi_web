function submitForm() {
  var fName = $("input[name=fName]").val();
  var lName = $("input[name=lName]").val();
  var email = $("input[name=email]").val();
  var password = $("input[name=password]").val();
  var cPassword = $("input[name=cPassword]").val();

  if (password != cPassword) {
    $("#message").html(
      '<span style="color: red">Please make sure your passwords match</span>'
    );
  } else if (
    fName != "" &&
    lName != "" &&
    email != "" &&
    password != "" &&
    cPassword != ""
  ) {
    var formData = {
      fName: fName,
      lName: lName,
      email: email,
      password: password,
    };
    $("#message").html(
      '<span style="color: red">Processing form. .check if email already exists . .</span>'
    );
    $.ajax({
      url: "http://localhost/Guvi_web/php/register.php",
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
            '<span style="color: red">Form not submitted. Some error in running the database query.</span>'
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
