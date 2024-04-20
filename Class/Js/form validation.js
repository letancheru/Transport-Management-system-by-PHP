/*=============    for Registration/ signup   ==========================================*/
/*-------------     for frist name       ------------------*/
function onFocusF () {
	firstname_field=registration.firstname.value;
	if (firstname_field=="First name is required"||firstname_field=="should be character") {
		document.getElementById("fname").value="";
		document.getElementById("fname").style.color = "black";
		document.getElementById("fname").style.fontWeight="normal";
	}
}
function onBulrF () {
	x=registration.firstname.value;
	if(x==""||x==null){
		document.getElementById("fname").style.color="brown";
		document.getElementById("fname").style.fontWeight="bold";
		document.getElementById("fname").value="First name is required";
	}else if(! /^[a-zA-Z]+$/.test(x)){
      document.getElementById("fname").style.color="brown";
      document.getElementById("fname").style.fontWeight="bold";
      document.getElementById("fname").value="should be character";
    }
}
/*-------------     for last name       ------------------*/
function onFocusL () {
	Lastname_field=registration.lastname.value;
	if (Lastname_field=="Last name is required"||Lastname_field=="should be character") {
		document.getElementById("lname").value="";
		document.getElementById("lname").style.color = "black";
		document.getElementById("lname").style.fontWeight="normal";
	}
}
function onBulrL () {
	x=registration.lastname.value;
	if(x==""||x==null){
		document.getElementById("lname").style.color="brown";
		document.getElementById("lname").style.fontWeight="bold";
		document.getElementById("lname").value="Last name is required";
	}else if(! /^[a-zA-Z]+$/.test(x)){
      document.getElementById("lname").style.color="brown";
      document.getElementById("lname").style.fontWeight="bold";
      document.getElementById("lname").value="should be character";
    }
}
/*-------------      sex             ------------------------*/
function onBulrSex () {
	x=registration.sex.value;
	if(x==""||x==null){
		document.getElementById("sex").innerHTML = "";
	}
}

/*-------------      for username        ------------------*/
username_temp_value = "";
function onFocusun () {
	username_field=registration.username.value;
	if (username_field=="username is required"||username_field=="it is too short") {
		document.getElementById("uname").value="";
		document.getElementById("uname").style.color = "black";
		document.getElementById("uname").style.fontWeight="normal";
		if (username_temp_value!=""||username_temp_value!=null) {
			document.getElementById("uname").value=username_temp_value;		
		}
	}
}
function onBulrun (){
	x=registration.username.value;
	if(x==""||x==null){
		document.getElementById("uname").style.color="brown";
		document.getElementById("uname").style.fontWeight="bold";
		document.getElementById("uname").value="username is required";
	} else if (x.length<6) {
		username_temp_value = registration.username.value;
		document.getElementById("uname").style.color="brown";
		document.getElementById("uname").style.fontWeight="bold";
		document.getElementById("uname").value="it is too short";
	}
}
/*-------------  for Password fields -----------------------*/
		/*------ to validate first field ---------*/
pass_temp_value = "";
function onFocuspass () {
	pass_field=registration.password.value;
	if (pass_field=="Password is required"||pass_field=="it is too short") {
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
	if(pass_field==""||pass_field==null){
		document.getElementById("pass").style.color="brown";
		document.getElementById("pass").style.fontWeight="bold";
		document.getElementById("pass").type="text";
		document.getElementById("pass").value="Password is required";
	} else if (pass_field.length<6) {
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
	if (pass_field==""||pass_field==null|| pass_field=="it is too short"||pass_field=="Password is required") {
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
	if(repass_field==""||repass_field==null){
		document.getElementById("repass").style.color="brown";
		document.getElementById("repass").style.fontWeight="bold";
		document.getElementById("repass").type="text";
		document.getElementById("repass").value="Re-Password is required";
	} else if (repass_field.length<6) {
		repass_temp_value = registration.repassword.value;
		document.getElementById("repass").style.color="brown";
		document.getElementById("repass").style.fontWeight="bold";
		document.getElementById("repass").type="text";
		document.getElementById("repass").value="it is too short";
	} else if (repass_field!=pass_field && repass_field!="fill password first") {
		repass_temp_value = registration.repassword.value;
		document.getElementById("repass").style.color="brown";
		document.getElementById("repass").style.fontWeight="bold";
		document.getElementById("repass").type="text";
		document.getElementById("repass").value="Make Both Password and Re-Password the same";		
	};						
}
/*=========================================================================================================*/

function onfocuspa () {
	firstname_field=registration.passAnswer.value;
	if (firstname_field=="recovery answer is required"||firstname_field=="recovery answer should be character") {
		document.getElementById("passAns").value="";
		document.getElementById("passAns").style.color = "black";
		document.getElementById("passAns").style.fontWeight="normal";
	}
}
function onblurpa () {
	x=registration.passAnswer.value;
	if(x==""||x==null){
		document.getElementById("passAns").style.color="brown";
		document.getElementById("passAns").style.fontWeight="bold";
		document.getElementById("passAns").value="recovery answer is required";
	}else if(! /^[a-zA-Z]+$/.test(x)){
      document.getElementById("passAns").style.color="brown";
      document.getElementById("passAns").style.fontWeight="bold";
      document.getElementById("passAns").value="recovery answer should be character";
    }
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