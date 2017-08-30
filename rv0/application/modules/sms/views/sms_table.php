<center>
<form method="post">
<table align=center border=1>

 <tr>
       <th>Name</th>
       <th>RollNo</th>
       <th>Class</th>
       <th>Section</th>
       <th>FatherName</th>
       <th>MotherName</th>
       <th>FatherNo</th>
       <th>MotherNo</th>
      
 </tr>
 
       
           
        <?php

           foreach($user as $key=>$value)
           {

               $name=$value->name;
               $rollno=$value->rollno;
               $class=$value->class;
               $section=$value->section;
               $fathername=$value->fathername;
               $mothername=$value->mothername;
               $fatherno=$value->fatherno;
               $motherno=$value->motherno;
            echo "<tr>

            <td>$name</td>
            <td>$rollno</td>
            <td>$class</td>
            <td>$section</td>
            <td>$fathername</td>
            <td>$mothername</td>
            <td>$fatherno</td>
            <td>$motherno</td>
            
            </tr>";
           }
       ?>
 	
 
 </table>

  
 </form>
 </center>