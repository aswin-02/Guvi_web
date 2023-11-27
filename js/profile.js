function submitForm() {
  var age = $("input[name=age]").val();
  var dob = $("input[name=dob]").val();
  var contact = $("input[name=contct]").val();
  var address = $("input[name=address]").val();

  if (age != "" && dob != "" && contact != "" && address != "") {
    var formData = { age: age, dob: dob, contact: contact, address: address };
    $("#message").html(
      '<span style="color: red">Processing form. . .</span>'
    );

    $.ajax({
      url: "http://localhost/Guvi_web/php/profile.php",
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
            '<span style="color: red">Form not submitted. </span>'
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
