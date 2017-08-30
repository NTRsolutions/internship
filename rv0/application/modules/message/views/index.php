<div class="main-content news-page mail-page">
  <?php if($success_msg!='') { ?>
  <p class="error-helful bg-success"><i class="fa fa-check-circle-o"></i> <?php echo $success_msg; ?> </p>
  <?php } ?>
  <?php if($error_msg!='') { ?>
  <p class="error-helful bg-danger"><i class="fa fa-times-circle"></i>  <?php echo $error_msg; ?></p>
  <?php } ?>
  <div class="box-body">
    <div class="col-md-3 col-sm-3 mail-left-panel"> <a href="<?=base_url('message/add')?>" class="btn btn-info btn-block margin-bottom">
      <?=$this->lang->line('add_title')?>
      </a>
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <?=$this->lang->line('folder')?>
          </h3>
        </div>
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked message">
            <li class="active"><a href="<?=base_url('message/index')?>"><i class="fa fa-inbox"></i>
              <?=$this->lang->line('inbox')?>
              <span class="label label-info pull-right" id="inbox"></span></a></li>
            <li><a href="<?=base_url('message/sent')?>"><i class="fa fa-envelope-o"></i>
              <?=$this->lang->line('sent')?>
              <span class="label label-info pull-right" id="sent"></span></a></li>
            <!-- <li><a href="<?=base_url('message/fav_message')?>"><i class="fa fa-star-o"></i>
                <?=$this->lang->line('favorite')?>
                </a></li>-->
            <li><a href="<?=base_url('message/trash')?>"><i class="fa fa-trash-o"></i>
              <?=$this->lang->line('trash')?>
              </a></li>
          </ul>
        </div>
        <!-- /.box-body --> 
      </div>
      
      <!-- /. box --> 
    </div>
    <!-- /.col -->
    
    <div class="col-md-9 col-sm-9 mail-right-panel">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">
            <?=$this->lang->line('inbox')?>
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="margin-bottom">
            <div class="btn-group">
              <button id="all" class="btn btn-info btn-md" data-original-title="Selete mail" data-toggle="tooltip" data-placement="top" title="Select all"> <i class="fa fa-square-o"></i> </button>
              <button class="btn btn-danger btn-md" id="delete_submit" data-original-title="Delete mail" data-toggle="tooltip" data-placement="top" title="Delete"> <i class="fa fa-trash-o"></i> </button>
              <button class="btn btn-primary btn-md" id="refresh" data-original-title="Refresh" data-toggle="tooltip" data-placement="top" title="Refresh"> <i class="fa fa-refresh"></i> </button>
            </div>
          </div>
          <div id="hide-table">
            <table id="example1" class="table table-hover dataTable no-footer">
              <thead>
                <tr>
                  <th>#</th>
                  <!-- <th><?=$this->lang->line('status')?></th>-->
                  <th><?=$this->lang->line('name')?></th>
                  <th><?=$this->lang->line('subject')?></th>
                  <th><?=$this->lang->line('attach')?></th>
                  <th><?=$this->lang->line('time')?></th>
                </tr>
              </thead>
              <tbody>
                <?php if(count($messages)) {$i = 1; foreach($messages as $message) { ?>
                <tr class="<?=$message->read_status==0 ? "unread" : "read"?>">
                  <td data-title="#"><input id="<?=$message->messageID?>" type="checkbox" value="<?=$message->messageID?>" class="checkbox btn btn-warning" data-original-title="Select mail" data-toggle="tooltip" data-placement="top"/></td>
                  <!--  <td data-title="<?=$this->lang->line('status')?>" class="mailbox-star"><a class="fav" href="#" value="<?=$message->messageID?>"><?php if ($message->fav_status == 0) {?><i class="fa fa-star-o text-yellow"></i><?php } else {?> <i class="fa fa-star text-yellow"></i><?php } ?></a></td>-->
                  <td data-title="<?=$this->lang->line('name')?>" class="mailbox-name"><a href='<?=base_url("message/inbox/view/$message->messageID")?>'>
                    <?=(isset($message->sender))?$message->sender:$message->sender?>
                    </a></td>
                  <td data-title="<?=$this->lang->line('subject')?>" class="mailbox-subject"><a href='<?=base_url("message/inbox/view/$message->messageID")?>'> <b>
                    <?=substr($message->subject, 0,10).".."?>
                    </b> </a></td>
                  <td data-title="<?=$this->lang->line('attach')?>" class="mailbox-attachment"><?php if ($message->attach != '') {?>
                    <i class="fa fa-paperclip"></i>
                    <?php } ?></td>
                  <?php $newDateTime = date('h:i:m A', strtotime($message->create_date));?>
                  <td data-title="<?=$this->lang->line('time')?>" class="mailbox-date"><?=date('d M Y H.i A', strtotime($message->create_date))?></td>
                </tr>
                <?php $i++; }} ?>
              </tbody>
            </table>
          </div>
          <!-- /.mail-box-messages --> 
        </div>
        <!-- /.box-body --> 
      </div>
      <!-- /. box --> 
    </div>
    <!-- /.col --> 
    
  </div>
</div>
<script type="text/javascript">
    $('#all').click(function() {
        if(!$('.checkbox').is(':checked'))
            $('.checkbox').prop('checked', true)
        else
            $('.checkbox').prop('checked', false);
    });
    $('.fav').click(function () {
        var messageID = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: "<?=base_url('message/fav_status')?>",
            data: "id=" + messageID,
            dataType: "html",
            success: function(data) {
                window.location.href = data;
            }
        });
    });
    $('#delete_submit').click(function() {
        var messages = "";
        var selected = false;
        var result = [];
         $('input:checkbox.checkbox').each(function (index) {
			if(this.checked)
			{
				  messages = $(this).attr('id');
				  selected = true;
			}else
			{
				  messages = "";
			}
         //   (this.checked ? $(this).attr('id') : "");
             result.push(messages);

        });
        
        if (selected) {
                $.ajax({
                type: 'POST',
                url: "<?=base_url('message/delete_inbox')?>",
                data: "id=" + result,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }else
        {
			alert('Please select atleast one message');
		}
    });
    $('#refresh').click(function(){
        location.reload();
    });
    $( document ).ready(function () {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('message/unreadCounter')?>",
            dataType: "json",
            success: function(data) {
                $( "#inbox" ).append(data.inbox);
                $( "#sent" ).append(data.send);
            }
        });
    });

</script> 
