function url_hash(param) {

	var hash = window.location.hash;
	hash = hash.replace('#', '');

	hash = hash.split('/');

	var url = {};
	for (var i in hash) {

		if (!hash[i]) continue;

		var hash_param = hash[i].split('=');
		url[hash_param[0]] = "";

		if (hash_param[1] !== undefined) url[hash_param[0]] = hash_param[1];
	}

	for (var index in param) {
		url[index] = param[index];
	}

	hash = "";

	for (var index in url) {
		if (hash) hash += "/";
		hash += index+"="+url[index];
	}

	window.location.hash = "/"+hash+"/";
}

function url_param(arg) {
	var param = window.location.hash;
	param = decodeURIComponent(param.replace('#', ''));

	param = param.split('/');

	var params = {};
	for (var i in param) {
		var pair = param[i].split('=');
		params[pair[0]] = pair[1];
		if (arg && pair[0] == arg) return pair[1];
	}

	if (arg) return "";
	return params;
}