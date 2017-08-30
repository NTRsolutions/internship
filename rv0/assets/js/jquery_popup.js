$(document).ready(function() {
$("#onclick").click(function() {
$("#contactdiv").show();
});
$("#contact #cancel").click(function() {
$(this).parent().parent().hide();
});

});