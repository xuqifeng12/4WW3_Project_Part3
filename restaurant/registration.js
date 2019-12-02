//function checks for empty fields
function CheckEmpty(field_id){
	var GivenValue = document.getElementById(field_id).value;
	if (GivenValue==""||GivenValue==null){
		alert("you cannot leave this empty");
	}
}


//function valiadates the given email id
function ValidateEmail(email){
	var GivenEmail = document.getElementById(email).value;
	var format = /.+@.+/;
	if (!GivenEmail.match(format)){
		alert("Please enter a valid email id");
	}
}


//function validates the password
function ValidatePassword (password){
	var GivenPassword = document.getElementById(password).value;
	var format = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
	if (!GivenPassword.match(format)){
		alert("The password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters")
	}
}

function ConfirmPassword (password, confirm_password) {
	var Password = document.getElementById(password).value;
	var ConfirmPassword = document.getElementById(confirm_password).value;
	if (ConfirmPassword !== Password){
		alert("Please enter the same password in both the fields");
	}
}


