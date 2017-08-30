<div class="main-content news-page mail-page">
  <div class="box-body">
        
            <div class="col-md-3 col-sm-3">
              <a href="<?=base_url('message/add')?>" class="btn btn-info btn-block margin-bottom"><?=$this->lang->line('add_title')?></a>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$this->lang->line('folder')?></h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked message">
                    <li><a href="<?=base_url('message/index')?>"><i class="fa fa-inbox"></i> <?=$this->lang->line('inbox')?> <span class="label label-info pull-right" id="inbox"></span></a></li>
                    <li class="active"><a href="<?=base_url('message/sent')?>"><i class="fa fa-envelope-o"></i> <?=$this->lang->line('sent')?><span class="label label-info pull-right" id="sent"></span></a></li>
                   <!-- <li class="active"><a href="<?=base_url('message/fav_message')?>"><i class="fa fa-star-o"></i> <?=$this->lang->line('favorite')?></a></li>-->
                    <li><a href="<?=base_url('message/trash')?>"><i class="fa fa-trash-o"></i> <?=$this->lang->line('trash')?></a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
            <div class="col-md-9 col-sm-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$this->lang->line('favorite')?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="margin-bottom">
                        <div class="btn-group">
                            <button class="btn btn-primary btn-sm" id="refresh" data-original-title="Refresh" data-toggle="tooltip" data-placement="top">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div id="hide-table">
                        <table id="example1" class="table table-hover dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?=$this->lang->line('status')?></th>
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
                                  <td data-title="<?=$this->lang->line('status')?>" class="mailbox-star"><a class="fav" href="#" value="<?=$message->messageID?>"><?php if ($message->fav_status == 0) {?><i class="fa fa-star-o text-yellow"></i><?php } else {?> <i class="fa fa-star text-yellow"></i><?php } ?></a></td>
                                  <td data-title="<?=$this->lang->line('name')?>" class="mailbox-name"><a href='<?=base_url("message/view/$message->messageID")?>'><?=(isset($message->sender))?$message->sender:$message->useremail?></a></td>
                                  <td data-title="<?=$this->lang->line('subject')?>" class="mailbox-subject"><a href='<?=base_url("message/view/$message->messageID")?>'> <b><?=substr($message->subject, 0,10).".."?></b> </a></td>
                                  <td data-title="<?=$this->lang->line('attach')?>" class="mailbox-attachment"><?php if ($message->attach != '') {?><i class="fa fa-paperclip"></i><?php } ?></td>
                                  <?php $newDateTime = date('h:i:m A', strtotime($message->create_date));?>
                                  <td data-title="<?=$this->lang->line('time')?>" class="mailbox-date"><?=date('d M Y H.i A', strtotime($message->create_date))?></td>
                                </tr>
                            <?php $i++; }} ?>
                           <?php if(count($messages_sent)) {$i = 1; foreach($messages_sent as $message) { ?>
                                <tr>
                                  <td data-title="#"><input id="<?=$message->messageID?>" type="checkbox" value="<?=$message->messageID?>" class="checkbox btn btn-warning" data-original-title="Select mail" data-toggle="tooltip" data-placement="top"/></td>
                                  <td data-title="<?=$this->lang->line('status')?>" class="mailbox-star"><a class="fav" href="#" value="<?=$message->messageID?>"><?php if ($message->fav_status_sent == 0) {?><i class="fa fa-star-o text-yellow"></i><?php } else {?> <i class="fa fa-star text-yellow"></i><?php } ?></a></td>
                                  <td data-title="<?=$this->lang->line('to')?>" class="mailbox-name"><a href='<?=base_url("message/view/$message->messageID")?>'><?=(isset($message->sender))?$message->sender:$message->email?></a></td>
                                  <td data-title="<?=$this->lang->line('subject')?>" class="mailbox-subject"><b><?=substr($message->subject, 0,10).".."?></b> </td>
                                  <td data-title="<?=$this->lang->line('attach')?>" class="mailbox-attachment"><?php if ($message->attach != '') {?><i class="fa fa-paperclip"></i><?php } ?></td>
                                  <?php $newDateTime = date('h:i:m A', strtotime($message->create_date));?>
                                  <td data-title="<?=$this->lang->line('time')?>" class="mailbox-date"><?=date('d M Y H.i A', strtotime($message->create_date))?></td>

                                </tr>
                            <?php $i++; }} ?>
                            </tbody>
                        </table>
                    </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
        
    </div>
</div>

<script type="text/javascript">
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
