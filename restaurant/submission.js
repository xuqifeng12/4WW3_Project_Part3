var x=document.getElementById("latitude");
var y=document.getElementById("longitude");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition);
    }
  else{x.innerHTML="Geolocation is not supported by this browser.";}
  }
function showPosition(position)
  {
  x.value=position.coords.latitude;  
  y.value=position.coords.longitude;    
  }


//function checks for empty fields
function CheckEmpty(field_id){
	var MyValue = document.getElementById(field_id).value;
	if (MyValue==""||MyValue==null){
		alert("you cannot leave this empty");
	}
}



//function valiadates the given email id
function ValidatePhoneNumber(phonenumber){
	var MyTel = document.getElementById(phonenumber).value;
	var format = /\d/g; 
	if (!MyTel.match(format)||MyTel.length!=10){
		alert("Please enter a valid phone number");
	}
}