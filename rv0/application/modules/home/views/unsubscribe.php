
<div id="unsubscribe">test

<span onClick="setunsubscribe(<?php $id;?>)">submit</span>
</div>
<div id="updateunsubscribe" style="display:none;">
success
</div>
<script>
function setunsubscribe(val){
	$.ajax({
	  method: "POST",
	  url: "home/updateunsubscribe",
	  data: { id: val }
	})
	  .done(function( msg ) {
		if(msg.success=='success'){
			$('#unsubscribe').css('display','none');
			$('#updateunsubscribe').css('display','block');
		}
	  });
}
</script>

