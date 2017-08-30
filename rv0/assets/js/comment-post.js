function showCommentsData(containerId,containerDiv,id,type){
      $(containerId).hide();   
	  $(containerId).parents('li').find('.hide-comment').show();
      commentData(containerId,containerDiv,id,type);
	
}
function hideCommentsData(ele){
	 $(ele).hide(); 
	 $(ele).parents('li').find('.activity-comment').show();
	 $(ele).parents('li').find('.comments-container').hide();
	  
}
function showCommentsDataPopup(containerId,containerDiv,id,type){
      $(containerId).hide();   
	  $(containerId).parents('li').find('.hide-comment-popup').show();
      commentData(containerId,containerDiv,id,type);
	
}
function hideCommentsDataPopup(ele){
	 $(ele).hide(); 
	 $(ele).parents('li').find('.activity-comment-popup').show();
	 $(ele).parents('li').find('.comments-popup-container').hide();
	  
}
function commentData(containerEle,containerDiv,id,type){
	            var userImageUrl = $('#profileimage').attr('src');
				 //console.log(containerEle);
				 var container = $(containerEle).parents('li').find('.'+containerDiv);
				 //console.log(container);
				 var commentContainer =  $(container).comments({
					profilePictureURL:userImageUrl,
					roundProfilePictures: true,
					textareaRows: 1,
					enableAttachments: false,					 
					item_id: id,
					item_type: type,
					enableUpvoting: false, 
                    enableNavigation: false,      					
					getComments: function(success, error) {
						 
						  $.ajax({
						  url: base_url+"home/getCommentdata",
						  type: "POST",
						  data: {'postId':id,'post_type':type},
						  success: function(msg)
							{
								
								 var commentsArray  = jQuery.parseJSON(msg );
								 setTimeout(function() {
													success(commentsArray);
													$(container).show();
													
												}, 500);
								  
								}
							});
	             },
					postComment: function(data,successpost, error) {
						console.log(data);
						  $.ajax({
						  url: base_url+"home/insertCommentdata",
						  type: "POST",
						  data: data,
						  success: function(msg)
							{
								  
								 
								var msg  = jQuery.parseJSON(msg);
								   setTimeout(function() {
//data.fullname="azarrr";									   
									//data.comment_id= 	msg.id;							   
													successpost(msg);
													//$("#commentsdata_"+containerId).show();
												}, 500);
								}
								
							});
				      },
					putComment: function(data, successpost, error) {
						 $.ajax({
						  url: base_url+"home/updateCommentdata",
						  type: "POST",
						  data: data,
						  success: function(msg)
							{
								 
								 var commsg  = jQuery.parseJSON(msg );
								
								   setTimeout(function() {	
                  						   successpost(commsg);
													//$("#commentsdata_"+containerId).show();
												}, 500);
								}
						   });
				     },
					deleteComment: function(data,successpost,error) {
						  
						 $.ajax({
						  url: base_url+"home/deleteCommentdata",
						  type: "POST",
						  data: data,
						  success: function(msg)
							{
								 
								 var commsg  = jQuery.parseJSON(msg );
								
								   setTimeout(function() {	
                  						   successpost(msg);
													//$("#commentsdata_"+containerId).show();
												}, 500);
								}
						   });
					},
					upvoteComment: function(data, success, error) {
						 setTimeout(function() {
							success(data);
						}, 500);
					},
				   uploadAttachments: function(data,successpost,error) {
        var responses = 0;
        var successfulUploads = [];

        var serverResponded = function() {
            responses++;

            // Check if all requests have finished
            if(responses == data.length) {
                
                // Case: all failed
                if(successfulUploads.length == 0) {
                    error();

                // Case: some succeeded
                } else {
                    successpost(successfulUploads)
                }
            }
        }

        $(data).each(function(index, commentJSON) {

            // Create form data
            var formData = new FormData();
            $(Object.keys(commentJSON)).each(function(index, key) {
                var value = commentJSON[key];
                if(value) formData.append(key, value);
            });

            $.ajax({
                url: '<?php echo base_url();?>home/imagesCommentdata',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(commentJSON) {
					console.log(commentJSON);
                    successfulUploads.push(commentJSON);
                    serverResponded();
                },
                error: function(data) {
                    serverResponded();
                },
            });
        });
    },
				});
}