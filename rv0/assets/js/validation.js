var globalError = '';
function formSubmit(fid)
{
	 
	if($('#shipping_terms').length>0)
	  {  
		  if($('#shipping_terms').is(':checked'))
		 {
			  error_remove($("#shipping_terms"))
		 }else{
			// alert('Accept terms and conditions...');
			globalError ="Accept Terms and Conditons";
			 error_display($("#shipping_terms"));
		 }
	  }
	 
	$('#'+fid+" .required").each(function(){ 
		console.log($(this));
		required_valid($(this));
	});
	
//	$('#'+fid+" .alpha").each(function(){
//		alpha_valid($(this));
//	});
//	
//	$('#'+fid+" .numeric").each(function(){
//		required_valid($(this));
//	});
	
	//password validation
	var pas = '';
	var pasid = '';
	var cpas = '';
	var cpasid = '';
	 
	$('#'+fid+" .pass").each(function(){
		 
			pas = $(this).val(); 
			pasid = $(this); 
		    required_valid($(this));
	});
	
	//pincodelengthvalidation
	$('#'+fid+" .pincode").each(function(){
        pincode_valid($(this));
    });
	 
	$('#'+fid+" .cpass").each(function(){
		
		cpas = $(this).val();
		cpasid = $(this);
		required_valid($(this));
	});
	
	$('#'+fid+" .passwordstrength").each(function(){ 
		 
		checkPassStrength($(this));
	});
	
	 
	if((pas!='' && cpas!='') && pas!=cpas)
	{
		globalError = "Confirm Password is not Matching";
		error_display(cpasid);
	} 
	
	//email validation
	$('#'+fid+" .email").each(function(){
		email_valid($(this));
	});
	
	//mobile validation
	$('#'+fid+" .mobile").each(function(){
		mobile_valid($(this));
	});
	
		//door number validation
	$('#'+fid+" .door").each(function(){
		door_valid($(this));
	});
	
	
	
	//alpha characters validation
	$('#'+fid+" .alpha").each(function(){
		alpha_valid($(this));
	});
	
	//numeric validation
	$('#'+fid+" .numeric").each(function(){
		numeric_valid($(this));
	});
	//Float validation
	$('#'+fid+" .float").each(function(){
		float_valid($(this));
	});
	
	//Url validation
	$('#'+fid+" .url").each(function(){
		globalError = "Enter valid website url";
		url_valid($(this));
	});
	$('#'+fid+" .username").each(function(){
		 
		username_valid($(this));
	});
	$('#'+fid+" .validate_passedout").each(function(){
		 
		validate_passedout($(this));
	});
	if($('#'+fid+" .invalid").length >0) {
		
		
		
		
		/*if($(".tab-content").length > 0)
		{
		  flag = true;
		  i = 0;
		  $(".tab-content .tab-pane").each(function(){
			  if($(this).find(".invalid").length >0 && flag == true)
				  {
				    flag = false;
				    $("#myTab li").removeClass("active")
				    $("#myTab li:eq("+i+")").addClass("active");
				  	$(".tab-content .tab-pane").removeClass("active").removeClass("in");
				    $(this).addClass("active").addClass("in");
				    //err_scroll = $("#"+fid+" .invalid:eq(0)").offset().top;
				    //$('html, body').animate({scrollTop: err_scroll}, "slow");
				  }
			  i++;
		  });
		}*/
		
		//$(window).scrollTop(err_scroll);
		//err_scroll = $("#"+fid+" .invalid:eq(0)").offset().top;
		//$('html, body').animate({scrollTop: err_scroll}, "slow");
		
		return false;
    }
	else{
		
		return true;	
		
	}
		
}

//validating required fields
function required_valid(tval)
{
	 
	var temp = '';
	if($('#message_form').length>0 )
	 {
		 temp =  $.trim(tval.select2('val'));
	 }else
	 {
		  temp =  $.trim(tval.val());
	 }
	 $.trim(tval.val());
	 
 	if(temp == '') {
		globalError = tval.attr("alt")+" is required";
		//globalError = " Required";
		error_display(tval);
	}
	else
		error_remove(tval); 
}



function username_valid(tval)
{
	
	var username = $.trim(tval.val());
	if(username == '')
		   return true;
	usernamepattern = /^[a-zA-Z]+(\.{1}[a-zA-Z0-9]+)?$/;
	if( username.length!=8 )
	{
		globalError = "Username should be contain 8 chars";
   		error_display(tval);
	}else if(!usernamepattern.test(username)) {
		globalError = "Username not available";
   		error_display(tval);
	}
   else
      	error_remove(tval);	
}

function validate_passedout(tval)
{
	
	var yr = $.trim(tval.val());
	var d = new Date();
	var n = d.getFullYear();
	if(yr == '')
		   return true;
	 
	if( parseInt(yr) < 1946 ||  parseInt(yr) > parseInt(n) )
	{
		 
		globalError = "Passedout should be in between 1946 and "+n;
   		error_display(tval);
	} 
    else
      	error_remove(tval);	
}


function mobile_valid(tval)
{
	
	var mob_value = $.trim(tval.val());
	if(mob_value == '')
		   return true;
	mobilepattern = /^[0-9]+$/;
	if(!mobilepattern.test(mob_value) || mob_value.length!=10 ) {
		globalError = "Invalid "+tval.attr("alt");
   		error_display(tval);
	}
   else
      	error_remove(tval);	
}


function mobile_value_check(tval)
{
	var mob_value = $.trim(tval.val());
	
}

function email_valid(tval)
{
   var email_value = $.trim(tval.val());
   if(email_value == '')
	   return true;
  var emailPattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,3}(?:\.[a-z]{2})?)$/i;
    if(!emailPattern.test(email_value)) {
	//globalError = tval.attr("alt")+" Should be Valid Email ID";
    globalError = " Enter a valid email address";
   	error_display(tval);
   }	
   else
      	error_remove(tval);	
}

function door_valid(tval)
{
   var door_value = $.trim(tval.val());
   if(door_value == '')
	   return true;
   var doorPattern =  /^[a-zA-z0-9\-.\\_\/-:;\[\]]+$/;
   if(!doorPattern.test(door_value)) {
	globalError = tval.attr("alt")+" should be Valid Door number";
   	error_display(tval);
   }	
   else
      	error_remove(tval);	
}
function float_valid(tval)
{
   var num_value = $.trim(tval.val());
   if(num_value == '')
	   return true;
   var numPattern = /^(?:[0-9]\d*|1)?(?:\.\d+)?$/;
   if(!numPattern.test(num_value)) {
	globalError = "Please enter the correct price";//tval.attr("alt")+" Should be in Numeric";
   	error_display(tval);
   	return false;
   }
   else {
	   if(num_value > 0)
		   {
      	error_remove(tval);	
		   }
	   else
		   {
		   globalError = "Please enter the correct price";//tval.attr("alt")+" Should be in Numeric";
		   	error_display(tval);
		   	return false;
		   }
   }
   return true;
}

function url_valid(tval)
{
   var num_value = $.trim(tval.val());
   if(num_value == '')
	   return true;
   var numPattern = /^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.|http:\/\/|https:\/\/){1}([0-9A-Za-z_?&=-]+\.)/;
   if(!numPattern.test(num_value)) {
	globalError = "Please enter valid url";
   	error_display(tval);
   	return false;
   }
   else
      	error_remove(tval);	
   return true;
}
  
function numeric_valid(tval)
{
   var num_value = $.trim(tval.val());
   if(num_value == '')
	   return true;
   var numPattern = /^[0-9]+$/;
   if(!numPattern.test(num_value)) {
	globalError = tval.attr("alt")+" should be in Numeric";
   	error_display(tval);
   	return false;
   }
   else
      	error_remove(tval);	
   return true;
}
function checkPassStrength(dis)
{
		//initial strength
		var strength = 0
		var password = dis.val();
		//if the password length is less than 6, return message.
		if (password.length < 6) { 
			$('#password_strength').removeClass();
			$('#password_strength').addClass('short');
			return 	pass_error_display(dis);
		}
		
		//length is ok, lets continue.
		
		//if length is 8 characters or more, increase strength value
		if (password.length > 7) strength += 1
		
		//if password contains both lower and uppercase characters, increase strength value
		if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
		
		//if it has numbers and characters, increase strength value
		if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
		
		//if it has one special character, increase strength value
		if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
		
		//if it has two special characters, increase strength value
		if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
		
		//now we have calculated strength value, we can return messages
		
		//if value is less than 2
		if (strength < 2 )
		{
			$('#password_strength').removeClass();
			$('#password_strength').addClass('weak');
			return 	pass_error_display(dis);		
		}
		else if (strength == 2 )
		{
			$('#password_strength').removeClass();
			$('#password_strength').addClass('good');
			return true;	
		}
		else
		{
			$('#password_strength').removeClass();
			$('#password_strength').addClass('strong');
			return true;
		}
}
function pincode_valid(tval)
{   
   var num_value = $.trim(tval.val());
   if(num_value == '')
       return true;
   var numPattern = /^[0-9]+$/;
   if(!numPattern.test(num_value) ) {
    globalError = tval.attr("alt")+" should be in Numeric and pincode contains 6 digits";
       error_display(tval);
   }else if(num_value.length<=6) { //alert('tets');
	   globalError = tval.attr("alt")+"contains 6 digits";
       error_display(tval); 
	   }
   else   { //alert('tetsiii');
          error_remove(tval); 
   }
}

function alpha_valid(tval)
{
   var alpha_value = $.trim(tval.val());
   if(alpha_value == '')
	   return true;
   //var alphaPattern = /^[a-zA-Z. ,-]+$/;
   var alphaPattern = /^[A-Za-z]{0,80}$/;
   if(!alphaPattern.test(alpha_value)) {
		globalError = tval.attr("alt")+" should be in Alphabetic";
   		error_display(tval);
   }
   else
      	error_remove(tval);	
}

//validation 
function error_display(tval)
{
	if(!tval.hasClass('invalid'))
	{
		 tval.addClass('invalid');	
		 tval.parents('div.form-group').find('p').remove();
		 
		tval.parents('div.form-group').append('<p class="error">'+globalError+'</p>');
		//v = tval.attr("alt");
		if(tval.next("p").length == 0)
		   tval.after("");
	}
}
function pass_error_display(tval)
{
	if(!tval.hasClass('invalid'))
	{
		 tval.addClass('invalid');	
		 tval.parents('div.form-group').find('p').remove();
		 
		tval.parents('div.form-group').append('<p class="error">Password should be atleast Good</p>');
		//v = tval.attr("alt");
		if(tval.next("p").length == 0)
		   tval.after("");
	}
}


function error_remove(tval)
{
	  
	  tval.removeClass('invalid');
	  tval.parent('div.form-group').find('p').remove();
}
