// JavaScript Document

$(function () {
	
	$.validator.addMethod('strongPassword', function(value, element) {
		return this.optional(element)
		|| value.length >= 6
		&& /\d/.test(value)
		&& /[a-z]/i.test(value);
	}, 'Your password must be 6 characters long and contain at least one number and one char\'.');
	
	$("#login-form").validate({
		rules: {
			login_user: {
				required: true
			},
			login_pass: {
				required: true
			}
		},
		messages: {
			login_email: {
				required: "Enter your username email address"
			},
			login_pass: {
				required: "Enter your password"
			}
		}
	});
	
	$("#reg-form").validate({
		rules: {
			last_name: {
				required: true,
				nowhitespace: true,
				lettersonly: true
			},
			first_name: {
				required: true,
				nowhitespace: true,
				lettersonly: true
			},
			username: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true,
				digits: true
			},
			pass: {
				required: true,
				strongPassword: true
			},
			con_pass: {
				required: true,
				equalTo: "#pass"
			},
			terms: {
				required: true
			}
		},
		messages: {
			last_name: {
				required: 'Please enter your last Name (surname)',
				nowhitespace: 'No space allowed',
				lettersonly: 'Alphabets are allowed only'
			},
			other_name: {
				required: 'Please enter your first Name',
				lettersonly: 'Alphabets are allowed only'
			},
			username: {
				required: 'Please enter a unique username'
			},
			email: {
				required: 'Please enter an email address',
				email: 'Please enter a valid email address'
			},
			phone: {
				required: 'Please enter a phone number',
				digits: 'Please enter a valid phone number'
			},
			pass: {
				required: 'Please enter a password'
			},
			con_pass: {
				required: 'Please confirm your password',
				equalTo: 'Password doesn\'t match'
			},
			terms: {
				required: 'Please read and check our terms and conditions'
			}
		}
	});
	
	$("#multiplex-terms").validate({
		rules: {
			terms: {
				required: true
			}
		},
		messages: {
			terms: {
				required: 'Please check the accept all the terms'
			}
		}
	});
	
});