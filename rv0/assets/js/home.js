$(document).ready(function() { 
		   var options =  {
			   beforeSubmit: function(arr, $form, options) { 
				    show_site_loader();
				},
				success:       showResponse
				};
         if($('#postcontent').length>0)
         {
			 $('#postcontent').ajaxForm(options);
		 } 
			 function showResponse(responseText)
			 {
				 console.log(responseText);
				 var msg = jQuery.parseJSON(responseText);
				 var str='';
				 
					if(msg.profile_thumb_image === null || msg.profile_thumb_image==''){
						str +='<li class="list-group-item justpost"><img class="user-thumb" src="'+assets+'assets/img/user-thumb.jpg" alt="user-thumb">';
						
					}else{
						str +='<li class="list-group-item justpost"><img class="user-thumb" src="resize.php?src='+msg.profile_thumb_image+'&h=80&w=80" alt="user-thumb">';
					}
					str +='<div class="activity-content"><p class="activity-header"><a href="'+base_url+'connections/profile/'+msg.id+'">'+msg.display_name+'</a> posted an update ';
					str +='<span class="activity-time">0 minuite ago</span></p>';
					//str +='<p><i class="bp-activity-visibility fa fa-globe"></i></p>';
				   str +='<a href="'+base_url+'posts/postdetailes/'+msg.post_id+'" class="activity-description">'+msg.post_description+'</a>';
				  str +='<a class="activity-comment" id="commentshow_'+msg.post_id+'" onClick="showCommentsData(this,\'comments-container\',\''+msg.post_id+'\',\'post\')" href="javascript:void(0)">See Comments </a>'; 
			       str +='<a class="hide-comment" href="javascript:void(0)" style="display:none" onClick="hideCommentsData(this)" id="hidecomments_'+msg.post_id+'">Hide Comments</a>';
				   str +='<a type="button" class="read-btn" data-toggle="modal" data-target="#myModal_'+msg.post_depcrypt+'">Read more</a>';
			       str +='<div style="display:none" id="commentsdata_'+msg.post_id+'" class="comments-container"></div>';
				   str +='<div class="modal fade comments-modal" id="myModal_'+msg.post_depcrypt+'" role="dialog">\
				   <div class="modal-dialog">\
				   <div class="modal-content">\
                    <div class="modal-header">\
					 <span>'+msg.display_name+'</span> posted\
                      <button type="button" class="close" data-dismiss="modal">&times;</button>\
                      </div>\
                    <div class="modal-body scrollbox6" >\
                    <div class="modal-description">\
					  <span>'+msg.post_description+'</span>\
					 </div>\
                   </div>\
                   </div>\
                </div>\
	            </div>';
			 str+='<div class="dropdown">\
								<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> <span class="caret"> </span> </button>\
								<ul class="dropdown-menu">\
								  <li><a href="javascript:void(0)" onclick="editPost(\''+msg.post_id+'\',this)"><i class="fa fa-pencil-square-o"></i> Edit Post</a></li>\
								  <li><a href="javascript:void(0)" onclick="removePost(\''+msg.post_id+'\',this)"><i class="fa fa-trash" ></i> Remove </a></li>\
								</ul>\
						  </div></div>';
				    str+='</li>';
					$("#postdes").val('');
					$(".jFiler-row").remove('');
					$('#postdata').prepend(str);
				    hide_site_loader();
					  setTimeout(function() {
							 
										 $('.justpost').removeClass('no-home-animate').addClass('show'); 
						}, 10);
			 }
			 if($('.login-holder').hasClass('openLogin'))
			 {
				 
				   $("#myModal").modal("show");
			 }
			 
			 setTimeout(function() {
					$( ".no-home-animate" ).each(function() {
								 $(this).removeClass('no-home-animate').addClass('show');
						});
			}, 10); 
			
jQuery('.stat-count').show();
jQuery(".stat-count").each(function() { 
  jQuery(this).data('count', parseInt(jQuery(this).html()));
  jQuery(this).html('0');
  count(jQuery(this));
}); 		 
});
 
function count($this){
		var current = parseInt($this.html(), 10);
		current = current + 50; /* Where 1 is increment */ 
		$this.html(++current); 
		if(current > $this.data('count')){
			$this.html($this.data('count'));
		} else {
			setTimeout(function(){count($this)}, 50);
		}
}
function loadmore(){
		$('.load-span').hide();
		$('.load-image').show();
		var len = $("li.activity-list-item").length - 1;	     
	        
		var id=$("li.activity-list-item:eq("+len+")").attr('id'); 
		 
		$.ajax({
		url: base_url+"home/getpost",
		method: "POST",
		data: { post_id: id},
		dataType: "json",
		async: false
	}).done(function(msg){
		if(!msg){
			$('#lodedel').remove();
			return false;
		}
		$('#postdata').append(msg);
		 setTimeout(function() {
			 
					$( ".no-home-animate" ).each(function() {
								 $(this).removeClass('no-home-animate').addClass('show');
						});
			}, 10);
		
		$('.load-image').hide();
		$('.load-span').show(); 
	});
} 
function doHomeLogin()
{
		   if(formSubmit('home_login_user'))
		   {
			   
			        $('.load-home-login-image').show();
					var email = $('#home_login_email').val(); 
					var pass = $('#home_login_pass').val();
					var dest_url = $('#dest_url').val();
					$.ajax({
						url:  base_url+ 'user/doLogin' ,
						type: 'POST',
						async : false,
						data: 'ajax=true&email='+email+'&pass='+pass+'&dest_url='+dest_url,
						success: function(data, textStatus, jqXHR)
						{   
							
							var msg = jQuery.parseJSON(data); 
							 if(msg.isLoggedin)
							 {
								if(msg.email_exist)
							       {
									    if(dest_url!='')
											window.location.href=dest_url;
										 else
											window.location.href=base_url;
								   }
							     else
							       window.location.href=base_url+'user/registeremail';
						     } 
							   else
							   {
									$('.home_login_error_msg').html('<i class="fa fa-times-circle"></i> Invalid Username or Password').css('display','block')
									$('.load-home-login-image').hide();
									return false;
							   }
							    
						}
					}); 
		   }
		  
		   return false;
}
function homeHelpBlock()
{
	$('#myModal').modal("show");
	$('.error_msg').css('display','none');
	$('.login_error_msg').css('display','none');
	$('.login-holder').css('display','none');
    $('.forgot-holder').css('display','block');
}
 
