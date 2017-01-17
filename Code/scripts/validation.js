
function validateRegister() {
	var email = $("#emailreg").val();
	var password1 = $("#passwdreg").val();
	var password2 = $("#passwdrepreg").val();
	
	if(validateEmail(email)) {
		if(password1 == password2 && isNotEmpty(password1)) {
			return true;
		}
	}

	$('#emailreg').css({ "border": '#FF0000 1px solid'});
	$('#passwdreg').css({ "border": '#FF0000 1px solid'});
	$('#passwdrepreg').css({ "border": '#FF0000 1px solid'});
	return false;
}

function validateLogin() {
	var email = $("#emaillog").val();
	var password = $("#passwdlog").val();
	
	if(validateEmail(email)) {
		if(isNotEmpty(password)) {
			return true;
		}
	}

	$('#emaillog').css({ "border": '#FF0000 1px solid'});
	$('#passwdlog').css({ "border": '#FF0000 1px solid'});
	return false;
}

function validateUpload() {
	var title = $("#title").val();
	var picPath = $("#picture").val();
	var category = $("#category").val();
	
	if(isNotEmpty(title) && isNotEmpty(picPath) && isNotEmpty(category)) {
		return true;
	}

	$('#pictitle').css({ "border": '#FF0000 1px solid'});
	$('#picture').css({ "border": '#FF0000 1px solid'});
	$('#category').css({ "border": '#FF0000 1px solid'});
	return false;
}

function validateComment() {
	var comment = $("#comment").val();

	if(isNotEmpty(comment)) {
		return true;
	}

	$('#comment').css({ "border": '#FF0000 1px solid'});
	return false;
}

function validateChangePW() {
	var password1 = $("#oldpasswd").val();
	var password2 = $("#passwd").val();
	var password3 = $("#passwdrep").val();

	if(isNotEmpty(password1) && isNotEmpty(password2) && isNotEmpty(password3)) {
		return true;
	}

	$('#oldpasswd').css({ "border": '#FF0000 1px solid'});
	$('#passwd').css({ "border": '#FF0000 1px solid'});
	$('#passwdrep').css({ "border": '#FF0000 1px solid'});
	return false;
}






function validateEmail(p_email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
	if(re.test(p_email)) {
		return true;
	} else {
		return false;
	}
}

function isNotEmpty(p_string) {
	if(p_string > 0) {
		return true;
	} else {
		return false;
	}
}