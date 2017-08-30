$(document).ready(function() {
    
    //Example 1
    $('#filer_input').filer({
		showThumbs: true
    });
    
    //Example 2
    $("#filer_input2").filer({
        limit: 6,
        maxSize: null,
        extensions: ['jpg', 'jpeg', 'png', 'gif'],
        changeInput: '<a class="jFiler-input-choose-btn blue">Browse Files</a>',
        showThumbs: true,
        theme: "dragdropbox",
        templates: {
            box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
            item: '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        <span class="jFiler-item-others">{{fi-size2}}</span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li>{{fi-progressBar}}</li>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
            itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                            <span class="jFiler-item-others">{{fi-size2}}</span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </div>\
                        </li>',
            progressBar: '<div class="bar"></div>',
            itemAppendToEnd: false,
            removeConfirmation: true,
            _selectors: {
                list: '.jFiler-items-list',
                item: '.jFiler-item',
                progressBar: '.bar',
                remove: '.jFiler-item-trash-action'
            }
        } ,
        uploadFile: {
            url: "./php/upload.php",
            data: null,
            type: 'POST',
            enctype: 'multipart/form-data',
            beforeSend: function(){},
            success: function(data, el){
                var parent = el.find(".jFiler-jProgressBar").parent();
                console.log(parent);
                el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                    $("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");    
                });
            },
            error: function(el){
                var parent = el.find(".jFiler-jProgressBar").parent();
                el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                    $("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");    
                });
            },
            statusCode: null,
            onProgress: null,
            onComplete: null
        },
        files: [],
        addMore: false,
        clipBoardPaste: true,
        excludeName: null,
        beforeRender: null,
        afterRender: null,
        beforeShow: null,
        beforeSelect: null,
        onSelect: null,
        afterShow: null,
        onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl){
            var file = file.name;
            $.post('./php/remove_file.php', {file: file});
        },
        onEmpty: null,
        options: null,
        captions: {
            button: "Choose Files",
            feedback: "Choose files To Upload",
            feedback2: "files were chosen",
            drop: "Drop file here to Upload",
            removeConfirmation: "Are you sure you want to remove this file?",
            errors: {
                filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
                filesType: "Only Images are allowed to be uploaded.",
                filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
                filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
            }
        }
    });
    
});


/* edit post */
     var filerKit = '';
	 var elt = '';
	function editPost(id,elem)
	{
		elt = elem;
		$.ajax({
		url: base_url+"home/getpostdata",
		method: "POST",
		data: { post_id: id},
		dataType: "json",
		async: false
			}).done(function(msg){
				 $('#edit_post_desc').val(msg.post_description);
				 $('#edit_post_id').val(msg.id);
				 openEditWindow(msg.post_images,elem)
				
				//$('.load-image').hide();
				//$('.load-span').show(); 
			});
	}
	function removePost(id,elem)
	{
		if(confirm('Are you want to delete post?'))
		{
				elt = elem;
				$.ajax({
				url: base_url+"posts/deletepost",
				method: "POST",
				data: { post_id: id},
				dataType: "json",
				async: false
					}).done(function(msg){
						 
						  if(msg==1)
						  {
							   if($('.gallery').length>0)
							  {
								 
								   window.location = base_url;
							  }else
							  {
								   $(elt).parents('li.list-group-item').remove();
								    
							  }
							 
							   
						  }else
						  {
							   alert('You are not authorized to delete this post.'); 
							   
						  }
						  
					});
		}
	}
	function openEditWindow(post_images)
	{
		 
		var filerKit = $("#eidt_filer_input").prop("jFiler"); 
		 console.log(filerKit);
		 filerKit.reset();
		// filerKit.files = post_images;
		$.each(post_images, function( index, value ) {
            filerKit.append(value);  
        });
		
		// filerKit.append(post_images);
		//filerKit.remove();
		 
		//callFiles(post_images);
		$("#editpostmodel").modal(); 
	}
	 
    function callFiles(post_images)
    {
		 
     // do something 
     	    var filerKit='';	
	    filerKit =  $("#eidt_filer_input").filer({
        limit: 6,
        maxSize: null,
        extensions: ['jpg', 'jpeg', 'png', 'gif'],
         changeInput: '<a class="jFiler-input-choose-btn blue">Browse Files</a>',
        showThumbs: true,
       // theme: "dragdropbox",
        templates: {
            box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
            item: '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li>{{fi-progressBar}}</li>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
            itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </div>\
                        </li>',
            progressBar: '<div class="bar"></div>',
            itemAppendToEnd: false,
            removeConfirmation: true,
            _selectors: {
                list: '.jFiler-items-list',
                item: '.jFiler-item',
                progressBar: '.bar',
                remove: '.jFiler-item-trash-action'
            }
        } ,
        uploadFile: {
            url: "./php/upload.php",
            data: null,
            type: 'POST',
            enctype: 'multipart/form-data',
            beforeSend: function(){},
            success: function(data, el){
                var parent = el.find(".jFiler-jProgressBar").parent();
                console.log(parent);
                el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                    $("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");    
                });
            },
            error: function(el){
                var parent = el.find(".jFiler-jProgressBar").parent();
                el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                    $("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");    
                });
            },
            statusCode: null,
            onProgress: null,
            onComplete: null
        },
        files: [],
        addMore: false,
        clipBoardPaste: true,
        excludeName: null,
        beforeRender: null,
        afterRender: null,
        beforeShow: null,
        beforeSelect: null,
        onSelect: null,
        afterShow: null,
        onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl){
            var file = file.name;
            $.post('./php/remove_file.php', {file: file});
        },
        onEmpty: null,
        options: null,
        captions: {
            button: "Choose Files",
            feedback: "Choose files To Upload",
            feedback2: "files were chosen",
            drop: "Drop file here to Upload",
            removeConfirmation: "Are you sure you want to remove this file?",
            errors: {
                filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
                filesType: "Only Images are allowed to be uploaded.",
                filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
                filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
            }
        }
     });
     
     // show modal
    // $("#editpostmodel").modal();
     
 

	}
	
	$(document).ready(function() {
		if($('.isedit').length>0) 
		{
			
			var postimages= [];
		    callFiles();
		
			var options =  {  
				success:       showResponse
				};
			 if($('#editcontent').length>0)
			 {
				 $('#editcontent').ajaxForm(options);
			 } 
			 function showResponse(responseText)
			 {
				   
				  var msg = jQuery.parseJSON(responseText); 
				  $(elt).parents('.activity-content').find('.activity-description').text(msg.post_description+'...');
				  
				  // updating images
				  if($('.gallery').length>0  && msg.post_images)
				  {
					  imggallery = '';
					  $.each(msg.post_images, function( index, value ) {
							 imggallery +='<li><a href="'+value+'" rel="prettyPhoto[gallery2]" ><img src="'+value+'" width="123" height="123" /></a></li>';
					  });
					  $('.gallery').html(imggallery);
					  animateImages();
			      }
			      
			      
				  $("#editpostmodel").modal('hide');
				    
			 }
		}
	 });
/* edit post end*/
