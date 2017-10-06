jQuery(function () {
	document.formvalidator.setHandler('int',
		function (value) {
			regex = /[0-9]/;
			return regex.test(value);
		});
	document.formvalidator.setHandler('decimal',
		function (value) {
			regex = /[0-9]+\.[0-9]{2}/;
			return regex.test(value);
		});
});