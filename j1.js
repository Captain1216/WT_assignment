function validateForm() {
		//First name validation
  var x = document.forms["form1"]["fn"].value;
  document.write(x);
  if (x == "") {
    alert("Name must be filled out");
    return false;
  }
}