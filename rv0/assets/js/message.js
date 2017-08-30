document.getElementById("attachment").onchange = function() {
    document.getElementById("uploadFile").value = this.value;
};
$( document ).ready(function () {
    $.ajax({
        type: 'POST',
        url: base_url+"message/unreadCounter",
        dataType: "json",
        success: function(data) {
            $( "#inbox" ).append(data.inbox);
            $( "#sent" ).append(data.send);
        }
    });
});
$( ".select2" ).select2( { placeholder: "Select username", maximumSelectionSize: 6 } );
$( ".guargianID" ).select2( { placeholder: "Select Guardian" , maximumSelectionSize: 6 } );

$( "button[data-select2-open]" ).click( function() {
	$( "#" + $( this ).data( "select2-open" ) ).select2( "open" );
});
