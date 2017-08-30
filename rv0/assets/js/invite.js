 $(document).ready(function() {
		 $("#group").change(function() {
			var dis = this;
			FB.getLoginStatus(function(response) {
				
				
				if (response.status === 'connected') {
					 
						if(dis.checked) {
							getGroups();
						}else
						{
							$('#groups-select').parent('.select-container').fadeOut('slow');
						}
      
    
				} else if (response.status === 'not_authorized') {
					fbAuth();
      
				} else {
                       fbAuth();
           
				}
				 
               
            });
			 
			
		});
		$("#pages").change(function() {
			var dis = this;
			FB.getLoginStatus(function(response) { 
				
				if (response.status === 'connected') {
					
						if(dis.checked) {
							getPages();
						}else
						{
							$('#pages-select').parent('.select-container').fadeOut('slow');
						}
      
    
				} else if (response.status === 'not_authorized') {
                       fbAuth();
				} else {
       
						fbAuth();
				}
				
				 
				
				 });
			//checkLoginState();
			
		})
})
function getGroups()
{
	
	/* FB.api(
    "/726864660787742/feed",
    "POST",
    {
        "message": "rightlink",
        "link":'http://rightlink.org',
        "picture":"https://rightlink.org/wp-content/uploads/2015/10/rightlink.png",
        "message":"message",
        "caption":"caption",
        "description":"description"
        
    },
    function (response) {
      if (response && !response.error) {
         
      }
    }
);*/
show_site_loader();
	 FB.api(
			"/me/groups",
			function (response) {
				 
			  if (response && !response.error) {
				   console.log(response.data);
				   var str = '';
				   $.each(response.data, function( index, value ) {
					   
					   str += '<option value="'+value.id+'">'+value.name+'</option>'; 
						 
					});
					
					$('#groups-select').html(str); 
					$('#groups-select').multiselect();
					$('#groups-select').parent('.select-container').fadeIn('slow');
					hide_site_loader();
			  }
			}
		);
}
function shareonFB()
{
	
      var pic= $('.navbar-brand img').attr('src'); alert(pic);
      var linkv = base_url;
	 var groupids = [];
	 if($("#group").is(":checked")){
		   var groups = $('#groups-select option:selected'); 
		    
			$(groups).each(function(index, brand){
				console.log($(this).val());
				groupids.push([$(this).val()]);
			});
	 }
	 var pagesids = [];
	 if($("#pages").is(":checked")){
		    var pages = $('#pages-select option:selected'); 
			$(pages).each(function(index, brand){
				console.log($(this).val());
				pagesids.push([$(this).val()]);
			});
	 }
	 if(confirm('Do you really want to share on FB'))
	 {
		 show_site_loader();
		 $.each(groupids, function( index, value ) {
		  FB.api(
			"/"+value+"/feed",
			"POST",
			{ 
				"name":"Register Now for the ‘Reunion’",
				"caption":"Connect with your Alma",
				"link":linkv,
				 "picture":pic,  
				"description":"Hey friends, I've signed up with our school alumni portal. Register now to gain access. Connect with your Alma Mater, relive your nostalgia, and participate in community activities. If you have news or are in touch with our past pupils, invite them to register. Spread the word!"
				
			},
			function (response) {
			  if (response && !response.error) {
				 
			  }
			   
			}
		);
	 });
	 
	  $.each(pagesids, function( index, value ) {
		  alert('');
		  FB.api(
			"/"+value+"/feed",
			"POST",
			{
				"message": "rightlink",
				 
				 
				
			},
			function (response) {
			  if (response && !response.error) {
				 
			  }
			}
		);
	 });
	 hide_site_loader();
   }
    
}
function getPages()
{
	show_site_loader();
	 FB.api(
			"/me/accounts",
			function (response) {
				 
			  if (response && !response.error) {
				   
				    
				   var str = '';
				   $.each(response.data, function( index, value ) {
					   
					   str += '<option value="'+value.id+'">'+value.name+'</option>'; 
						 
					});
					 
					$('#pages-select').html(str); 
					$('#pages-select').multiselect();
					$('#pages-select').parent('.select-container').fadeIn('slow');
					hide_site_loader();
			  }
			}
		);
}
// This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
	   
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '207107406347205',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use version 2.2
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
  function timeline() { 
	  
	    var pic= $('#navbar-brand img').attr('src'); 
        var linkv = $('#navbar-brand').attr('href');
      
        /*FB.api('/me/feed', 'post', { name:'Rightlink',type:'photo',message: 'We have been moulding kids into motivated, enterprising and compassionate adults, for 37 years ',icon:'https://dev.rightlink.io/cdn/images/favicon.png',picture:pic,link:'http://rightlink.io',caption:'Rightlink' }, function(response) {
         console.log( response);
         if (!response || response.error) {
            alert('Error occured');
          } else {
            alert('Post ID: ' + response);
          }
        }); */
       
        
         
			FB.ui({
			  method: 'feed',
			  link: linkv,
			  picture:pic,
			  description:'Hey friends, I just signed up with our school alumni portal. Register now to gain access. Connect with your Alma Mater, relive your nostalgia, and participate in community activities. If you have news or are in touch with our past pupils, invite them to register. Spread the word!',
			  
			  
			}, function(response){
		 	
		}); 
			
			/*FB.api("/me?fields=id,name,education",
				function (response) {
					 
				  if (response && !response.error) {
					  console.log(response);
					 
				   }
    }
					);*/
 }
  
 function fbAuth() {
	 
	 
    FB.login(function(response) {
      if (response.authResponse) {
		   
		  
          
      } else {
        alert('User canceled login or did not fully authorize the app.');
      }
    }, { scope: 'public_profile,email,publish_actions,user_education_history' });
}
 $('#myModal1').on('show.bs.modal', function (e) {
   // alert('');
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
 
