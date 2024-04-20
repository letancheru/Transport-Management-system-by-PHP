function onFocusF () {
	firstname_field=registration.firstname.value;
	if (firstname_field=="should be character") {
		document.getElementById("fname").value="";
		document.getElementById("fname").style.color = "black";
		document.getElementById("fname").style.fontWeight="normal";
	}
}
function onBulrF () {
	x=registration.firstname.value;
	if(! /^[a-zA-Z]+$/.test(x) && x!=""){
      document.getElementById("fname").style.color="brown";
      document.getElementById("fname").style.fontWeight="bold";
      document.getElementById("fname").value="should be character";
    }
}
/*-------------     for last name       ------------------*/
function onFocusL () {
	Lastname_field=registration.lastname.value;
	if (Lastname_field=="should be character") {
		document.getElementById("lname").value="";
		document.getElementById("lname").style.color = "black";
		document.getElementById("lname").style.fontWeight="normal";
	}
}
function onBulrL () {
	x=registration.lastname.value;
	if(! /^[a-zA-Z]+$/.test(x) && x!=""){
      document.getElementById("lname").style.color="brown";
      document.getElementById("lname").style.fontWeight="bold";
      document.getElementById("lname").value="should be character";
    }
}

/*-------------  for Password fields -----------------------*/
		/*------ to validate first field ---------*/
pass_temp_value = "";
function onFocuspass () {
	pass_field=registration.password.value;
	if (pass_field=="it is too short") {
		document.getElementById("pass").value="";
		document.getElementById("pass").style.color = "black";
		document.getElementById("pass").style.fontWeight="normal";
		document.getElementById("pass").type="password";
		if (pass_temp_value!=""||pass_temp_value!=null) {
			document.getElementById("pass").value=pass_temp_value;		
		}		
	}
}
function onBulrpass (){
	pass_field=registration.password.value;
	if (pass_field.length<6 && pass_field!="") {
		pass_temp_value = registration.password.value;
		document.getElementById("pass").style.color="brown";
		document.getElementById("pass").style.fontWeight="bold";
		document.getElementById("pass").type="text";
		document.getElementById("pass").value="it is too short";
	}
}
		/*------ to validate second field ---------*/
repass_temp_value = "";
function onFocusrepass () {
	pass_field=registration.password.value;
	if (pass_field=="") {
		repass_temp_value = registration.repassword.value;
		document.getElementById("repass").style.color="brown";
		document.getElementById("repass").style.fontWeight="bold";
		document.getElementById("repass").type="text";
		document.getElementById("repass").value="password field is required";
	} else if (pass_field=="it is too short") {
		document.getElementById("repass").style.color="brown";
		document.getElementById("repass").style.fontWeight="bold";
		document.getElementById("repass").type="text";
		document.getElementById("repass").value="fill password first";
	} else {
		document.getElementById("repass").value="";
		document.getElementById("repass").style.color = "black";
		document.getElementById("repass").style.fontWeight="normal";
		document.getElementById("repass").type="password";
		if (repass_temp_value!=""||repass_temp_value!=null) {
			document.getElementById("repass").value=repass_temp_value;		
		}
	}
	
}
function onBulrrepass (){
	pass_field=registration.password.value;
	repass_field=registration.repassword.value;
	if (repass_field.length<6 && repass_field!=""&& repass_field!="Make Both Password and Re-Password the same") {
		repass_temp_value = registration.repassword.value;
		document.getElementById("repass").style.color="brown";
		document.getElementById("repass").style.fontWeight="bold";
		document.getElementById("repass").type="text";
		document.getElementById("repass").value="it is too short";
	} else if (repass_field!=pass_field) {
		document.getElementById("repass").style.color="brown";
		document.getElementById("repass").style.fontWeight="bold";
		document.getElementById("repass").type="text";
		document.getElementById("repass").value="Make Password and Re-Password the same";		
	};						
}
//================================================================================================================================

//------------------- birthday validation 
function onFocusbd (){
	x = document.getElementById('birthday').value;
	if (x == "birthday shold before 15 years" || x == "Please enter birthday") {
      document.getElementById("birthday").style.color="black";
      document.getElementById("birthday").style.fontWeight="normal";
      document.getElementById("birthday").type="Date";
	}
}

function onBulrbd () {
	x = document.getElementById('birthday').value;
	
	inputYear = new Date(x).getFullYear();
	todayYear = new Date().getFullYear();

	if (inputYear > (todayYear-15)) {
      document.getElementById("birthday").style.color="brown";
      document.getElementById("birthday").style.fontWeight="bold";
      document.getElementById("birthday").type="text";
      document.getElementById("birthday").value="birthday shold before 15 years";      
	}else if (x == "" || x == null) {
      document.getElementById("birthday").style.color="brown";
      document.getElementById("birthday").style.fontWeight="bold";
      document.getElementById("birthday").type="text";
      document.getElementById("birthday").value="Please enter birthday"; 
	}	
}