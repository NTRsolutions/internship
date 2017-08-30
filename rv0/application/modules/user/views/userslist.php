
<div class="rightpanel">
  <ul class="breadcrumbs">
    <li><a href="<?php echo base_url();?>admin/dashboard"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
    <!-- <li><a href="table-static.html">Tables</a> <span class="separator"></span></li> -->
    <li>List of pages</li>
  </ul>
  <div class="pageheader">
    <div class="pageicon"><span class="iconfa-table"></span></div>
    <div class="pagetitle">
      <h5>Summary of pages</h5>
      <h1>List of pages</h1>
    </div>
  </div>
  <!--pageheader-->
  
  <div class="maincontent">
    <div class="maincontentinner">
      <h4 class="widgettitle">Data Table</h4>
      <table id="dyntable" class="table table-bordered responsive">
        <colgroup>
        <col class="con0" />
        <col class="con1" />
        <col class="con0" />
        <col class="con1" />
        <col class="con0" />
        </colgroup>
        <thead>
          <tr>
            <th class="head0">Display name</th>
            <th class="head1">User email</th>
            <th class="head0">User status</th>
            <th class="head1">User role</th>
            <th class="head0 center">Options</th>
          </tr>
        </thead>
        <tbody>
          <?php 
						if($list != 0){
						foreach($list as $val) { ?>
        <td><?=$val->admin_displayname ?></td>
          <td><?=$val->admin_email ?></td>
          <td><? if($val->admin_status 	 == 1) { ?>
            Active
            <? } else { ?>
            Inactive
            <? } ?></td>
          <td><? if($val->admin_role == 1) { ?>
            Super Admin
            <? } else { ?>
            Admin
            <? } ?></td>
          <td class="center"><a class="icon-edit" href="<?php echo base_url();?>admin/users/edituserform1/<?=$val->admin_id ?>"></a>&nbsp;&nbsp; <a class="icon-remove" href="<?php echo base_url();?>admin/users/deleteuserform1/<?=$val->admin_id ?>"></a></td>
        </tr>
        <? }} ?>
          </tbody>
        
      </table>
      <div class="footer">
        <div class="footer-left"> <span>Sparity Admin Template.</span> </div>
        <div class="footer-right"> <span>Designed by: <a href="http://www.sparity.com/">Sparity</a></span> </div>
      </div>
      <!--footer--> 
      
    </div>
    <!--maincontentinner--> 
  </div>
  <!--maincontent--> 
  
</div>
<!--rightpanel--> 
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/jquery.dataTables.min.js"></script> 
<script type="text/javascript">	 
    jQuery(document).ready(function(){
        // dynamic table
        jQuery('#dyntable').dataTable({
            "sPaginationType": "full_numbers",
            "aaSortingFixed": [[0,'asc']],            
            "fnDrawCallback": function(oSettings) {
                //jQuery.uniform.update();
            }
        });
        
        jQuery('#dyntable2').dataTable( {
            "bScrollInfinite": true,
            "bScrollCollapse": true,
            "sScrollY": "300px"
        });
        
    });
</script> 
