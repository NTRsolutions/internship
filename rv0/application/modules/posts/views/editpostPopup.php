<!-- post demo modal -->

 <div class="modal fade latestAct-widget" id="editpostmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form class="formcontroler" name="editcontent" id="editcontent" action="<?php echo base_url();?>home/editpost"  method="post" enctype="multipart/form-data" onSubmit="return formSubmit('editcontent')">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Post Update</h4>
      </div>
      <div class="modal-body">
        <div id="editpost">
		
          <textarea id="edit_post_desc" name="edit_post_desc"></textarea>
          <input type="hidden" id="edit_post_id" class="required" name="edit_post_id"/>
          <input class="browse-file " type="file" name="updatefiles[]" id="eidt_filer_input" multiple value="Post Image">
         
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- post demo modal ending--> 
