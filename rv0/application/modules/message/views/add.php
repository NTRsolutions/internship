<link href="<?php echo ASSETS;?>assets/css/select2.css" rel="stylesheet">
<link href="<?php echo ASSETS;?>assets/css/select2-bootstrap.css" rel="stylesheet">

<div class="main-content news-page mail-page">
	 <?php if($success_msg!='') { ?>
      	<p class="error-helful bg-success"><i class="fa fa-check-circle-o"></i>
      	<?php echo $success_msg; ?>
         </p>
        <?php } ?>
         <?php if($error_msg!='') { ?>
      	<p class="error-helful bg-danger"><i class="fa fa-times-circle"></i>
		 <?php echo $error_msg; ?></p>
     <?php } ?>
  <div class="box-body">
        
            <div class="col-md-3 col-sm-3 mail-left-panel">
              <a href="<?=base_url('message/add')?>" class="btn btn-info btn-block margin-bottom"><?=$this->lang->line('add_title')?></a>
              <div class="box box-solid">
				  
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$this->lang->line('folder')?></h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked message">
                    <li><a href="<?=base_url('message/index')?>"><i class="fa fa-inbox"></i> <?=$this->lang->line('inbox')?> <span class="label label-info pull-right" id="inbox"></span></a></li>
                    <li class="active"><a href="<?=base_url('message/sent')?>"><i class="fa fa-envelope-o"></i> <?=$this->lang->line('sent')?><span class="label label-info pull-right" id="sent"></span></a></li>
                   <!-- <li><a href="<?=base_url('message/fav_message')?>"><i class="fa fa-envelope-o"></i> <?=$this->lang->line('favorite')?></a></li>-->
                    <li><a href="<?=base_url('message/trash')?>"><i class="fa fa-trash-o"></i> <?=$this->lang->line('trash')?></a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->

            <div class="col-md-9 col-sm-9 mail-right-panel">
              <div class="box box-primary">
                <div class="box-header with-border">
					<?php if(isset($selectadminusers[0]->id)){?>
					  <div class="item-header">
						<?php if($selectadminusers[0]->profile_image!='') { ?>
                            <img src="<?php echo $selectadminusers[0]->profile_image;?>" alt="user image" class="online"/>
                        <?php }else{ ?>
							<img  src="<?php echo ASSETS;?>assets/img/emp-none.png" alt="user image" class="online"/>
						<?php } ?>
						<div class="message">
                            <span class="mes-name"><?php echo $selectadminusers[0]->display_name; ?></span>
							<p class="content_enter message-description"><?php echo $selectadminusers[0]->aboutMe; ?></p>
                        </div>
                      </div>
				  <?php } ?>
                  <h3 class="box-title"><?=$this->lang->line('compose_new')?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form role="form" method="post" name="message_form"  id="message_form" enctype="multipart/form-data" onsubmit="return formSubmit('message_form')">
                      <div class="form-group">
                        <div class="select2-wrapper">
                            <select class="form-control select2 required" alt="To " name="to" placeholder="To">
                                <option></option>
                                 <optgroup label="Admin Users">
                                <?php foreach ($adminusers as $item): ?>
                                    
                                        <option value="admin,<?php echo $item->id.','.$item->email ?>" <?php if($item->id==$selectadminusers[0]->id){?>selected="selected"<?php } ?>><?php echo $item->display_name; ?></option>
                                    
                                        
                                <?php endforeach ?>
                               </optgroup>
                                <!--<optgroup label="<?=$this->lang->line('student_select_label')?>">-->
                                 <optgroup label="Alumni">
                                <?php foreach ($users as $item): ?>
                                    <?php if($item->email==$email) { ?>
                                        <option value="alumni,<?php echo $item->id.','.$item->email ?>" disabled><?php echo $item->display_name; ?></option>
                                    <?php } else {?>
                                        <option value="alumni,<?php echo $item->id.','.$item->email ?>"><?php echo $item->display_name; ?></option>
                                    <?php } ?>
                                <?php endforeach ?>
                               </optgroup>
                                 
                            </select>
                        </div>
                        <div class="has-error">
                            <?php if (form_error('to')): ?>
                                <p class="text-danger"> <?php echo form_error('to'); ?></p>
                            <?php endif ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <input class="form-control" name="subject" alt="Subject" value="<?=set_value('subject')?>" placeholder="Subject:"/>
                        <div class="has-error">
                            <?php if (form_error('subject')): ?>
                                <p class="text-danger"> <?php echo form_error('subject'); ?></p>
                            <?php endif ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <textarea class="form-control" name="message" alt="Message" rows="10" placeholder="Message"><?=set_value('message')?></textarea>
                        <div class="has-error">
                            <?php if (form_error('message')): ?>
                                <p class="text-danger"> <?php echo form_error('message'); ?></p>
                            <?php endif ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="btn btn-info btn-file">
                          <i class="fa fa-paperclip"></i> <?=$this->lang->line('attachment')?>
                          <input type="file" id="attachment" name="attachment"/>
                        </div>
                          
                        <div class="col-sm-3" style="padding-left:0;">
                            <input class="form-control"  id="uploadFile" placeholder="Choose File" disabled />
                        </div>
                        <div class="has-error">
                            <p class="text-danger"> <?php if(isset($attachment_error)) echo $attachment_error; ?></p>
                        </div>
                      </div>
                      <div class="pull-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> <?=$this->lang->line('send')?></button>
                      </div>
                      <a href="<?=base_url('message/discard')?>" class="btn btn-danger"><i class="fa fa-times"></i> <?=$this->lang->line('discard')?></a>
                    </form>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
        
    </div>
</div>
 <script  type="text/javascript"  src="<?php echo ASSETS;?>assets/js/validation.js"></script>
 <script  type="text/javascript"  src="<?php echo ASSETS;?>assets/js/select2.js"></script>
  <script  type="text/javascript"  src="<?php echo ASSETS;?>assets/js/message.js"></script>
 
