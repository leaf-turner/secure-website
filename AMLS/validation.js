$(function(){
	
	/*
	* using validation framework validate.js
	*/
	
	$.validator.addMethod('strongPassword', function(value, element){
		return this.optional(element)
		|| value.length >= 8
		&& /\d/.test(value)
		&& /[a-z]/i.test(value);
	}, 'Password must be at least 8 characters long and contain a number or a character')
	
	$("#signup-form").validate({
		rules:{
			firstname: {
				
				//nowhitespace: true,
				lettersonly: true
			},
			lastname: {
				
				nowhitespace: true,
				lettersonly: true
			},
			dateofbirth:{
				
			},
			uid:{
				
			},
			mail:{
				
				email: true
			},
			password: {
				required:true,
				strongPassword: true
			},
			pwdrepeat: {
				required: true,
				//#password is the id attribute of name=password
				equalTo: "#password"
			},
			phonenumber:{
				
			},
			securityquestion1:{
				
			},
			securityanswer1:{
				
			},
			securityquestion2:{
				
			},
			securityanswer2:{
				
			},
			
			
		},
		messages: {
            password:{
                required: 'Please enter an email address.',
                strongPassword: 'Please enter a fucken email address'
            },
			email:{
				required: 'Please enter an email address.',
				email: 'Please enter a fuckenl address'
			},
			pwdrepeat:{
				pwdrepeat: 'Password must be at least 8 characters long and contain a number or a character'
			}
			
		}
	});
	
});