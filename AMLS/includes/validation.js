$(function(){
	
	//https://www.youtube.com/watch?v=TehnRqQtKv8
	
	$.validator.addMethod('strongPassword', function(value, element){
		return this.optional(element)
		|| value.length >= 8
		&& /\d/.test(value)
		&& /[a-z]/i.test(value);
	}, 'Password must be at least 8 characters long and contain a number or a character')
	
	$("#signup-form").validate({
		rules:{
			firstname: {
				required: true,
				nowhitespace: true,
				lettersonly: true
			},
			lastname: {
				required: true,
				//nowhitespace: true,
				lettersonly: true
			},
			dateofbirth:{
				required:true,
			},
			username:{
				required:true,
			},
			email:{
				required:true,
				email: true
			},
			password: {
				required: true,
				strongPassword: true
			},
			confirmpassword: {
				required: true,
				//#password is the id attribute of name=password
				equalTo: "#password"
			},
			phonenumber:{
				required: true
			},
			securityquestion1:{
				required: true
			},
			securityanswer1:{
				required: true
			},
			securityquestion2:{
				required: true
			},
			securityanswer2:{
				required: true
			},
			phonenumber:{
				required: true
			},
			
		},
		messages: {
			email:{
				required: 'Please enter an email address.',
				email: 'Please enter a fucken address'
			}
			
		}
	});
	
});