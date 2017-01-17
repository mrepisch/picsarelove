
function validateRegister() {
	var email = $("#emailreg").val();
	var password1 = $("#passwdreg").val();
	var password2 = $("#passwdrepreg").val();
	
	if(validateEmail(email)) {
		if(password1 == password2 && isNotEmpty(password1)) {
			return true;
		}
	}
	makeRedBorder('#emailreg');
	makeRedBorder('#passwdreg');
	makeRedBorder('#passwdrepreg');
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
	makeRedBorder('#emaillog');
	makeRedBorder('#passwdlog');
	return false;
}

function validateUpload() {
	var title = $("#title").val();
	var picPath = $("#picture").val();
	var category = $("#category").val();
	
	if(isNotEmpty(title) && isNotEmpty(picPath) && isNotEmpty(category)) {
		return true;
	}
	makeRedBorder('#pictitle');
	makeRedBorder('#picture');
	makeRedBorder('#category');
	return false;
}

function validateComment() {
	var comment = $("#comment").val();

	if(isNotEmpty(comment)) {
		return true;
	}
	makeRedBorder('#comment');
	return false;
}

function validateChangePW() {
	var password1 = $("#oldpasswd").val();
	var password2 = $("#passwd").val();
	var password3 = $("#passwdrep").val();

	if(isNotEmpty(password1) && isNotEmpty(password2) && isNotEmpty(password3)) {
		return true;
	}
	makeRedBorder('#oldpasswd');
	makeRedBorder('#passwd');
	makeRedBorder('#passwdrep');
	return false;
}



function makeRedBorder(p_element) {
	$(p_element).css({ "border": '#FF0000 1px solid'});
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
	if(p_string.length > 0) {
		return true;
	} else {
		return false;
	}
}