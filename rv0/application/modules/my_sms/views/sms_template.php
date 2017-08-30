<html>
<head>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

 <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

  <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>

  <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js" type="text/javascript"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

  

  });
</script>


  </head>
 <script>
           $(document).ready(function(){

    $("#selectcsv").change(function(){
     // alert($(this).val());
      if($(this).val()=='Select_Specfic_class')
      {
              //alert($(this).val()) 
                      $.post("http://localhost/new/rv0/sms/selectclass",{val:$(this).val()},function(data){
                       document.getElementById('class_seg').style.display='block';
                        $("#cla").html(data);
                        
                        $("#cla").multiselect();
                        
                        
                        
            });
        }
        else
        {
           document.getElementById('class_seg').style.display='none';
           document.getElementById('sectionrow').style.display='none';
        }
            });
  });

            </script>
  
          
      <script>
          $(document).ready(function(){
    $("#cla").change(function(){
              //alert($(this).val()) 
              
             var selectedValues = $('#cla').val();
            
            /* var foo = []; 
              $('#cla :selected').each(function(i, selected){ 
                foo[i] = $(selected).text(); 
                alert(foo[i]);
              });*/
              
              $.post("http://localhost/new/rv0/sms/selectsection",{class:selectedValues},function(data){
               //$("#section").html(data);
                document.getElementById('sectionrow').style.display='block';
               $('#section').html(''); // clear out old list
              $('#section').multiselect('destroy');  // tell widget to clear itself
              $('#section').html(data); // add in the new list
              $('#section').multiselect(); // re-initialize the widget
              //$('#section').multiselect();
                
        
    });
            });
  });

            </script>
            <script type="text/javascript">
              $(document).ready(function(){
    $("#appro").click(function(){
            $.post("http://localhost/new/rv0/sms/selectsection",{class:selectedValues});
       });
  });
            </script>
             <!--<script>
          $(document).ready(function(){
    $("#section").change(function(){
              //alert($(this).val()) 
              
             var selectedValues = $('#section').val();
            
            /* var foo = []; 
              $('#cla :selected').each(function(i, selected){ 
                foo[i] = $(selected).text(); 
                alert(foo[i]);
              });*/
              alert('hi');
              $.post("http://localhost/new/rv0/sms/selectstudent",{sections:selectedValues},function(data){
               //$("#section").html(data);
               $('#section').html(''); // clear out old list
              $('#section').multiselect('destroy');  // tell widget to clear itself
              $('#section').html(data); // add in the new list
              $('#section').multiselect(); // re-initialize the widget
              //$('#section').multiselect();
                
        
    });
            });
  });

            </script>-->




<body>




<div id="dd" >
</div>

   

<form method="post" action="http://localhost/new/rv0/sms/store">
<center>
<h1>Schedule the Campaign and Send it</h1>
<table align="center" cellpadding="8">
<tr>
<td>Date :&emsp;<input type="date" name="date">
</td>
</tr>
<tr>
<td>Time :&emsp;<input type="time" name="time" placeholder="Select time"></td>
</tr>
<tr>
<td>Campaign Name :&emsp;<input type="text" name="name" placeholder="Enter name"></td>
</tr>
 <tr>
    <td>
      Select CSV :&emsp;
       <select name="selectcsv" id="selectcsv" class="select-style">
       <option selected="selected" >Select option</option>
       <option value="AllStudents" >All Students</option>
       <option value="Select_Specfic_class">Select_Specfic_class</option>
       </select>
       
    </td>
 </tr>

    <tr id="class_seg" style="display:none;">
    <td >Class :&emsp;&emsp; <select name="cla[]" id="cla"  multiple="multiple" >
        <option selected="selected">Select Class</option>
        </select>
    </td>
    </tr>

    <tr id="sectionrow" style="display:none;">
    <td>Section : &emsp;
        <select name="section[]" id="section"  multiple="multiple">
        <option >Select Section</option>
        <option >St Section</option>
      </select>
    </td>
    </tr> 
    <tr>
<td>Content :&emsp;<textarea name="content" rows="4" cols="40"></textarea></td>
</tr>
</table>
<center>
<input  type="submit" name="approve" id="approve" value="Approve Template">
</center>
</center>
</form>
</body>

</html>
