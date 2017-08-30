 $(document).ready(function() {
		  var options =  { 
        beforeSubmit: function() { 
               show_site_loader();       
		},
        success:showResponse
        };
	 //$('#home').ajaxForm(options); 
	 function showResponse(responseText)
	 {
		 var msg = jQuery.parseJSON(responseText); 
		 if(msg.status == 'success'){
			$("#home").find(".success").html('');
			$("#home").prepend('<div class="success">'+msg.message+'</div>');
			if(msg.mobile_verify) 
			{
				 $('.verifylink').remove();
				 $('#mobile').parent('div').append('<a class="verifylink" href="'+base_url+'verifymobile">Verify</a>');
			}
			setTimeout(function(){$("div").find(".success").fadeOut('slow');}, 3000);
		}else{
			$("#home").find(".error").html('');
			$("#home").prepend('<div class="error">'+msg.message+'</div>');
			setTimeout(function(){$("div").find(".error").fadeOut('slow');}, 3000);
		}
		 hide_site_loader();
	 }
	 //image search module scroll
    $('#scrollbox5').enscroll({
		verticalTrackClass: 'track4',
		verticalHandleClass: 'handle4',
		minScrollbarLength: 50
	});
   $('#scrollbox5').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
           profileImages();
        }
    }); 
	  });
  function profilrupdate(id,val){
	if(!formSubmit(id))
	return false;
	var userdata = $("#"+id).serialize();
	   if($(".nav-pills li:eq(2)").hasClass('active')){
		  
		  if($.trim($("#sname").val())=="" && $.trim($("#syear").val())=="" && $.trim($("#slocation").val())=="" && $.trim($("#uname").val())=="" && $.trim($("#uyear").val())=="" && $.trim($("#uspecification").val())=="" && $.trim($("#ulocation").val())=="" && $.trim($("#pname").val())=="" && $.trim($("#pyear").val())=="" && $.trim($("#pspecification").val())=="" && $.trim($("#plocation").val())=="" && $.trim($("#phd_name").val())=="" && $.trim($("#phd_year").val())=="" && $.trim($("#phd_specification").val())=="" && $.trim($("#phd_location").val())=="" ){
                 alert('Please fil atleast one field');
				 $('.edu_sucess').show();
				  return  false;
				   
		   } 
		    $('.edu_sucess').hide();
	   }
	 show_site_loader();
	$.ajax({
		url: base_url+"user/profileupdate",
		method: "POST",
		data: userdata,
		dataType: "json"
	}).done(function(msg){
		if(msg.status == 'success'){
			$("#"+id).find(".success").html('');
			$("#"+id).prepend('<div class="success">'+msg.message+'</div>');
			 hide_site_loader();
			setTimeout(function(){$("div").find(".success").fadeOut('slow');}, 3000);
		}else{
			$("#"+id).find(".error").html('');
			$("#"+id).prepend('<div class="error">'+msg.message+'</div>');
			 hide_site_loader();
			setTimeout(function(){$("div").find(".error").fadeOut('slow');}, 3000);
		}
	});
	
}

// This is called with the results from from FB.getLoginStatus().
 /* function statusChangeCallback(response) {
    
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      //getUserDetails();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  } */

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  /*function checkLoginState() {
	  
    FB.getLoginStatus(function(response) {
	 
      statusChangeCallback(response);
    });
  }*/

  window.onload=function()
{
   
  FB.init({
    appId      : '1091549324229299',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  /*FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });*/

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function getUserDetails() {$(".load-layout-image").css("display","block");
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me',{fields: 'id,name,first_name,last_name,link,website,gender,picture,locale,about,email,hometown,location,birthday,education,work'}, function(response) {
	       
	       $.ajax({
			   
						url:  base_url+ 'user/getFacebookdetails',
						type: 'POST',
						data:{get_param:response},
						 dataType: 'json',
						 
						 success: function(data)
						 {  
						    //console.log(data);
						    setTimeout(function() {
								$(".site-wait-loader").hide();
                            location.reload();
                            //$(".site-wait-loader").css("display":"none");
                            },100); 
						 }
						 
					}); 
					
						    
	 
        //document.getElementById('status').innerHTML =
        //'Thanks for logging in, ' + response.name + '!'+response.first_name+ '!'+response.email+'!';
    });
  }
  
  function Login() {
  FB.login(function (response) {
			if(response.authResponse) {
			  
			  getUserDetails();
			  
			} else {
			  alert("Login attempt failed!");
			}
  }, { scope: 'public_profile,email, user_about_me,user_birthday,user_work_history,user_education_history,user_hometown , manage_pages,publish_actions,manage_pages' });

}
 
 function Logout() {
	 
	  FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                FB.logout(function(response) {
                    // this part just clears the $_SESSION var
                    // replace with your own code
                    $.ajax({
						url:  base_url+ 'user/logout',
						type: 'POST',
						data:{get_param:''},
						 dataType: 'json',
						 success: function(data)
						 {  
						  
						 }
					});
					setTimeout(function() {
                            location.reload();
                            },20); 
						 
				   
                });
            }
        });
 
 }
  
 



 // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
    //  ShareAPI();
     jQuery('.fblogin').hide();
     jQuery('.sharepic').show();
     return;
    } else if (response.status === 'not_authorized') {
     jQuery('.fblogin').show();
     jQuery('.sharepic').hide();
    } else {
      jQuery('.fblogin').show();
      jQuery('.sharepic').hide();
      
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

 /* window.fbAsyncInit = function() {
  FB.init({
    appId      : '198828980617085',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use version 2.8
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };*/

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
 
  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function share_pic(obj) { 
  
     console.log( obj);
	 
	//  var pic= $('#socialthumb').val(); 
    //  var linkv = base_url+'connections/profile/'+v;
      
        /*FB.api('/me/feed', 'post', { name:'Rightlink',type:'photo',message: 'We have been moulding kids into motivated, enterprising and compassionate adults, for 37 years ',icon:'https://dev.rightlink.io/cdn/images/favicon.png',picture:pic,link:'http://rightlink.io',caption:'Rightlink' }, function(response) {
         console.log( response);
         if (!response || response.error) {
            alert('Error occured');
          } else {
            alert('Post ID: ' + response);
          }
        }); */
   
           var postObj = {};
		       postObj.method = 'feed';
		   
		   if(obj.link!=undefined || obj.link!='')
			    postObj.link = obj.link ;
			if(obj.redirect_uri!=undefined || obj.redirect_uri!='')
			    postObj.redirect_uri = obj.redirect_uri;
			 if(obj.name!=undefined || obj.name!='')
			    postObj.caption = obj.name ;
			 if(obj.description!=undefined || obj.description!='')
			    postObj.description = obj.description ;
			 if(obj.picture!=undefined || obj.picture!='')
			    postObj.picture = obj.picture;
			
			
		 
			  
        
			FB.ui( postObj, function(response){
				
				
			}); 
			
			/*FB.api("/me?fields=id,name,education",
				function (response) {
					 
				  if (response && !response.error) {
					  console.log(response);
					 
				   }
    }
					);*/
 }
 
 function test() { 
	  
	   FB.api(
			"/me/groups",
			function (response) {
				console.log(response.data);
			  if (response && !response.error) {
				  
			/*	 FB.api(
    "/1047967438626199/feed",
    "POST",
    {
        "message": "This is a test message"
    },
    function (response) {
      if (response && !response.error) {
         
      }
    }
);*/
			  }
			}
		);
  }
 function fbAuth(v,name) {
	 var pic= $('#socialthumb').val();
	 
    FB.login(function(response) {
      if (response.authResponse) {
		   FB.api('/search', {q: 'user@email.com', type: 'user'}, function(response) {
             
                console.log(response);
            });
		  checkLoginState();
          share_pic(pic,v,name);
      } else {
        alert('User canceled login or did not fully authorize the app.');
      }
    }, { scope: 'public_profile,email,publish_actions,user_education_history' });
}

/* user image croping*/
$( "#userimage" ).on('change', prepareUpload);
function prepareUpload(event)
{
      files = event.target.files;
       
   
    // START A LOADING SPINNER HERE

    // Create a formdata object and add the files
		var data = new FormData();
		$.each(files, function(key, value)
		{
			data.append(key, value);
		});
     show_site_loader();
     $.ajax({
        url: base_url+'user/updateProfileImage',
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        success: function(data, textStatus, jqXHR)
        {
			if(data.status=='success')
			{ 
				$('#thumbnail').attr('src',base_url+data.image_location);
				$('#croper').attr('src',base_url+data.image_location);
				$('#current_large_image_width').val(data.width);
				$('#current_large_image_height').val(data.height);
				$('#random_key').val(data.random_key);
				var c = data.height/data.width;
				  
				$('#thumbnail').imgAreaSelect({ aspectRatio: '1:1', onSelectChange: preview });
				$('body').removeClass('overflow-hidden').addClass('overflow-hidden');
				$('#doCrop').show();
		     }else
		     {
						 
							$("#images").find(".error-msg").html('');
							$("#images").prepend('<div class="error-msg">'+data.message+'</div>');
							setTimeout(function(){$("div").find(".error-msg").fadeOut('slow');}, 3000);
					 
			 }
            hide_site_loader();
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            // Handle errors here
            console.log('ERRORS: ' + textStatus);
             hide_site_loader();
            // STOP LOADING SPINNER
        }
    });
}
function preview(img, selection) { 
	 
	var scaleX = 160 / selection.width; 
	var scaleY = 160 / selection.height; 
	var current_large_image_width = $('#current_large_image_width').val();
	var current_large_image_height = $('#current_large_image_height').val();
	 
	$('#thumbnail + div > img').css({ 
		width: Math.round(scaleX * current_large_image_width ) + 'px', 
		height: Math.round(scaleY * current_large_image_height ) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
	});
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
} 
function closeCrop()
{ 
	$('#thumbnail').imgAreaSelect({ hide: true });
	$('#doCrop').hide();
	$('body').removeClass('overflow-hidden');
	$('#images')[0].reset();
}
function closeCoverCrop()
{ 
	$('#cover_thumbnail').imgAreaSelect({ hide: true });
	$('#cover_doCrop').hide();
}
function createThumb()
{ 
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		var originalimage = $('#thumbnail').attr('src');
		var random_key = $('#random_key').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("You must make a selection first");
			return false;
		}else{
			           
					 $.ajax({
						url: base_url+'user/updateThumbImage',
						type: 'POST',
						data: "imageLocation="+originalimage+"&x1="+x1+"&y1="+y1+"&x2="+x2+"&y2="+y2+"&w="+w+"&h="+h+"&random_key="+random_key,  
						success: function(data, textStatus, jqXHR)
						{
							 
							 $('#profilethumb').attr('src',base_url+data);
							 $('#profileimage').attr('src',base_url+data);
							 $('#thumbnail').imgAreaSelect({ hide: true });
							 $('#doCrop').hide();
							 $('body').removeClass('overflow-hidden');
							 $("#images").find(".success").html('');
							 $("#images").prepend('<div class="success">Profile image updated</div>');
							 setTimeout(function(){$("div").find(".success").fadeOut('slow');}, 3000);
							
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
							// Handle errors here
							console.log('ERRORS: ' + textStatus);
							// STOP LOADING SPINNER
						}
					});
		   
		}
 } 
 
 function verifyMobileNumber()
 {
	 var p = $('#mobile').val();
	 var mobilepattern = /^\d{10}$/;  
    if(!mobilepattern.test(p)) { 
        alert("Invalid mobile number");  
        return false; 
     }else  
     {  
         
     }  
	 
 }
 function getImageSearch()
 {
	 if(formSubmit('search_image'))
			   {        $('.load-layout-image').show();
						var searchval = $('#search').val(); 
						$.ajax({
							url:  base_url+ 'user/getImageSearch' ,
							type: 'POST',
							async : false,
							data: 'ajax=true&search='+searchval,
							success: function(data, textStatus, jqXHR)
							{
								
								var str = '';
								var msg = jQuery.parseJSON(data); 
								 if(msg.status==='success'){
									 $.each( msg.searchdata, function( key, value ) {
										//alert( key + ": " + value.Name );
										
										str +='<section class="postings col-lg-2 col-md-2 col-sm-3 col-xs-6 show" id="profileimage_'+value.ID+'">';
										str +='<div class="showin" >';
										str +='<img class="search-img" src="'+base_url+'resize.php?src='+base_url+'uploads/profile_images/'+value.alumniImage+'&amp;w=140&amp;h=140">';
										str +='<div class="search-details">';
										if(value.Name!==''){
											
										str +='<span class="search-name">';
											str +='<i class="fa fa-user" aria-hidden="true"></i>'+value.Name+'<br/>';
										str +='</span>';		
										}
										
										
										if(value.hallTicketNumber!==''){
											
											str +='<span>';
											str +='<i class="fa fa-ticket" aria-hidden="true"></i>'+value.hallTicketNumber+'<br/>';
										str +='</span>';		
											
										
										}
										str +='<a href="javascript:void(0);" onClick="cropprofileImage(\''+value.alumniImage+'\',this)"><i class="fa fa-file-image-o" aria-hidden="true"></i>Use Image</a>';
										str +='</div></div></section>';
									 });
								 }else{
									 str+='Images not availables';
								 }
								 $('.load-layout-image').hide();
								 $('#searchdata').html(str);
								 $('#searchdata').css('display','block');
								 
							}
							 
						}); 
			   
		      }
		      return false;
 }
 function profileImages(){
	 $('.load-top-image').show();
	 var id=$("#searchdata").find('section').last().attr('id');
		var strsplt = id.split('profileimage_');
		id = strsplt[1];
		var searchval = $('#search').val(); 
		$.ajax({
		url: base_url+"user/getImageSearch",
		method: "POST",
		data: 'ajax=true&search='+searchval+'&img_id='+id,
		dataType: "json",
		async: false
	}).done(function(msg){
		//console.log(msg1);
		var str = '';
		//var msg = jQuery.parseJSON(msg1); alert(msg.status);
		if(msg.status==='success'){
			$.each( msg.searchdata, function( key, value ) {
				str +='<section class="postings col-lg-2 col-md-2 col-sm-3 col-xs-6 show" id="profileimage_'+value.ID+'">';
				str +='<div class="showin" >';
				str +='<img class="search-img" src="'+base_url+'resize.php?src='+base_url+'uploads/profile_images/'+value.alumniImage+'&amp;w=140&amp;h=140">';
				str +='<div class="search-details">';
				if(value.Name!==''){
					str +='<span class="search-name">';
					str +='<i class="fa fa-user" aria-hidden="true"></i>'+value.Name+'<br/>';
					str +='</span>';		
				}
				if(value.hallTicketNumber!==''){
					str +='<span>';
					str +='<i class="fa fa-ticket" aria-hidden="true"></i>'+value.hallTicketNumber+'<br/>';
					str +='</span>';		
				}
				str +='<a href="javascript:void(0);" onClick="cropprofileImage(\''+value.alumniImage+'\',this)"><i class="fa fa-file-image-o" aria-hidden="true"></i>Use Image</a>';
				str +='</div></div></section>';
			});
		}
		$('.load-layout-image').hide();
		$('#searchdata').append(str);
		
		$('.load-top-image').hide(); 
	});
 }
 function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}
 $('#myModal1').on('show.bs.modal', function (e) {
   $('#searchdata').html('');
   $('#search').val(''); 
})

 function cropprofileImage(val,dis){
	  $('#myModal1').modal('hide');
	            var imgloc = base_url+'uploads/profile_images/'+val;
	            var img = new Image(); 	 	
	                img.src = imgloc;
	            var width =  img.width;
	            var   height = img.height;
	             var  random_key= makeid();    
	            $('#thumbnail').attr('src',imgloc);
				$('#croper').attr('src',imgloc);
				$('#current_large_image_width').val(width);
				$('#current_large_image_height').val(height);
				$('#random_key').val(random_key);
				var c = height/width;
				  
				$('#thumbnail').imgAreaSelect({ aspectRatio: '1:1', onSelectChange: preview });
				$('body').removeClass('overflow-hidden').addClass('overflow-hidden');
				$('#doCrop').show();
	 
 }
 
 /* education block js*/
 
 function addProfessionFields(){
	 var iniVal=$('#proVal').val();
	 var c = parseInt(iniVal)+1;
     var appenddatra = '<div class="profession profession-add col-lg-12 col-xs-12 remove'+c+' ">\
	                 <div class="form-group col-lg-6 col-md-6 ">\
                      <label for="exampleInputPassword1">Industry</label>\
            <div class="select-control"> <span class="">\
              <select class="form-control required" onChange="otherIndustry(this.value,\''+c+'\')"  name="prof['+c+'][industry]" alt="Industry">\
                <option value="">select industry</option>\
					                     <option value="Entertainment">Entertainment</option>\
                                        <option value="Machinery">Machinery</option>\
                                        <option value="Telecommunications">Telecommunications</option>\
                                        <option value="Chemicals">Chemicals</option>\
                                        <option value="Food & Beverage">Food & Beverage</option>\
                                        <option value="Not For Profit">Not For Profit</option>\
                                        <option value="Consulting">Consulting</option>\
                                        <option value="Hospitality">Hospitality</option>\
                                        <option value="Shipping">Shipping</option>\
                                        <option value="Banking">Banking</option>\
                                        <option value="Energy">Energy</option>\
                                        <option value="Environmental">Environmental</option>\
                                        <option value="Manufacturing">Manufacturing</option>\
                                        <option value="Transportation">Transportation</option>\
                                        <option value="Communication">Communication</option>\
                                        <option value="Government">Government</option>\
                                        <option value="Recreating">Recreating</option>\
                                        <option value="Education">Education</option>\
                                        <option value="Insurance">Insurance</option>\
                                        <option value="IT">IT</option>\
                                        <option value="Biotechnology">Biotechnology</option>\
                                        <option value="Engineering">Engineering</option>\
                                        <option value="Finance">Finance</option>\
                                        <option value="Media">Media</option>\
                                        <option value="Utilities">Utilities</option>\
                                        <option value="Construction">Construction</option>\
                                        <option value="Healthcare">Healthcare</option>\
                                        <option value="Retail">Retail</option>\
                                        <option value="Apparel">Apparel</option>\
                                        <option value="Electronics">Electronics</option>\
										<option value="Agriculture">Agriculture</option>\
										<option value="Business">Business</option>\
										<option value="Pharmaceutical">Pharmaceutical</option>\
                                        <option value="other">other</option>\
              </select>\
              </span> </div>\
			   <div style="display:none" class="form-group col-lg-6 col-md-6 text-other other_'+c+'">\
                 <input type="text" class="form-control" placeholder="Please specify"  name="prof['+c+'][other_industry]" value="" />\
                 </div>\
          </div>\
		     <div class="form-group col-lg-6 col-md-6">\
                <label for="exampleInputPassword1">Company</label>\
                <div class="select-control">\
				<input type="text" class="form-control required" alt="Company"  name="prof['+c+'][company]" value="" />\
				 </div>\
              </div>\
		   <div class="form-group form-group-clear col-lg-6 col-md-6 ">\
            <label for="exampleInputPassword1">profession</label>\
             <input type="text" class="form-control required" alt="profession" name="prof['+c+'][profession]" id="" placeholder=""></div>\
		   <div class="form-group col-lg-6 col-md-6">\
  <label for="exampleInputPassword1">Time Period</label>\
  <div class="select-control form-inline">\
    <div class="inline-cntainer"> <span class="">From</span>\
      <select class="form-control required" alt="From Period" name="prof['+c+'][from]">\
        <option value="">From</option>\
        <option value="1970">1970</option>\
<option value="1971">1971</option>\
<option value="1972">1972</option>\
<option value="1973">1973</option>\
<option value="1974">1974</option>\
<option value="1975">1975</option>\
<option value="1976">1976</option>\
<option value="1977">1977</option>\
<option value="1978">1978</option>\
<option value="1979">1979</option>\
<option value="1980">1980</option>\
<option value="1981">1981</option>\
<option value="1982">1982</option>\
<option value="1983">1983</option>\
<option value="1984">1984</option>\
<option value="1985">1985</option>\
<option value="1986">1986</option>\
<option value="1987">1987</option>\
<option value="1988">1988</option>\
<option value="1989">1989</option>\
<option value="1990">1990</option>\
<option value="1991">1991</option>\
<option value="1992">1992</option>\
<option value="1993">1993</option>\
<option value="1994">1994</option>\
<option value="1995">1995</option>\
<option value="1996">1996</option>\
<option value="1997">1997</option>\
<option value="1998">1998</option>\
<option value="1999">1999</option>\
<option value="2000">2000</option>\
<option value="2001">2001</option>\
<option value="2002">2002</option>\
<option value="2003">2003</option>\
<option value="2004">2004</option>\
<option value="2005">2005</option>\
<option value="2006">2006</option>\
<option value="2007">2007</option>\
<option value="2008">2008</option>\
<option value="2009">2009</option>\
<option value="2010">2010</option>\
<option value="2011">2011</option>\
<option value="2012">2012</option>\
<option value="2013">2013</option>\
<option value="2014">2014</option>\
<option value="2015">2015</option>\
<option value="2016">2016</option>\
<option value="2017">2017</option>\
      </select>\
    </div>\
    <div class="inline-cntainer"> <span class="">To</span>\
      <select class="form-control required" alt="Time Period" name="prof['+c+'][to]">\
        <option value="">To</option>\
        <option value="1970">1970</option>\
<option value="1971">1971</option>\
<option value="1972">1972</option>\
<option value="1973">1973</option>\
<option value="1974">1974</option>\
<option value="1975">1975</option>\
<option value="1976">1976</option>\
<option value="1977">1977</option>\
<option value="1978">1978</option>\
<option value="1979">1979</option>\
<option value="1980">1980</option>\
<option value="1981">1981</option>\
<option value="1982">1982</option>\
<option value="1983">1983</option>\
<option value="1984">1984</option>\
<option value="1985">1985</option>\
<option value="1986">1986</option>\
<option value="1987">1987</option>\
<option value="1988">1988</option>\
<option value="1989">1989</option>\
<option value="1990">1990</option>\
<option value="1991">1991</option>\
<option value="1992">1992</option>\
<option value="1993">1993</option>\
<option value="1994">1994</option>\
<option value="1995">1995</option>\
<option value="1996">1996</option>\
<option value="1997">1997</option>\
<option value="1998">1998</option>\
<option value="1999">1999</option>\
<option value="2000">2000</option>\
<option value="2001">2001</option>\
<option value="2002">2002</option>\
<option value="2003">2003</option>\
<option value="2004">2004</option>\
<option value="2005">2005</option>\
<option value="2006">2006</option>\
<option value="2007">2007</option>\
<option value="2008">2008</option>\
<option value="2009">2009</option>\
<option value="2010">2010</option>\
<option value="2011">2011</option>\
<option value="2012">2012</option>\
<option value="2013">2013</option>\
<option value="2014">2014</option>\
<option value="2015">2015</option>\
<option value="2016">2016</option>\
<option value="2017">2017</option>\
      </select>\
    </div>\
  </div>\
</div>\
<a class="remove-btn" href="javascript:void(0)" onClick="removeProfession('+c+')"><i class="fa fa-times" aria-hidden="true"></i> Remove</a>\
 </div>';
		  
	
	 $('.mainprofession').append(appenddatra);
	 $('#proVal').val(c)
	
}
function removeProfession(id){
	 
	$('.remove'+id).remove();
}
function otherIndustry(val,keyval){
 if(val=="other"){
	  $(".other_"+keyval).removeAttr("style");	
	}
	else{
	$(".other_"+keyval).hide();	
	}
}
 
