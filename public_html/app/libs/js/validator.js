function Validator()
{
}

Validator.email = function(email)
{
	var emailRegxp = /^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/;
	
	if (emailRegxp.test(email) == true) {
		return true;
	} else {
		return false;
	}
};

Validator.username = function(username)
{
	var usernameRegxp = /^([a-zA-Z0-9_-]+)$/;
	
	if (usernameRegxp.test(username) == true) {
		return true;
	} else {
		return false;
	}
};

Validator.url = function(url)
{
	var regexp = /^https?:\/\/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/i;
	return regexp.test(url);
}

//checks to see if the protocol is specified, if not
// will add http:// in front
Validator.addHttp = function(url)
{
	var regexp = /^[a-zA-Z]{1,5}:\/\//i;
	if(!regexp.test(url)) {
		return 'http://'+url;
	} else {
		return url;
	}	
}