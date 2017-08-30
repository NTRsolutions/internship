<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css" /> <!-- reset css -->
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/mootools-core-1.4.5-nocompat.js"></script>

<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/jquery.min.js"></script>

<style>
    body{ background-color: ivory; padding:10px;}
    #canvas{border:1px solid red;}
</style>

<script>

<?php echo base_url('uploads/store/'.$data[0]->img);?>
  

$(function(){
    var canvas=document.getElementById("canvas");
    var ctx=canvas.getContext("2d");

    var canvasOffset=$("#canvas").offset();
    var offsetX=canvasOffset.left;
    var offsetY=canvasOffset.top;

    var startX;
    var startY;
    var isDown=false;


    var pi2=Math.PI*2;
    var resizerRadius=4;
    var rr=resizerRadius*resizerRadius;
    var draggingResizer={x:0,y:0};
    var imageX=canvas.width/2;
    var imageY=canvas.height/2;
    var imageWidth,imageHeight,imageRight,imageBottom;
    var draggingImage=false;
    var startX;
    var startY;
    var img = new Image();
    var bg = new Image();
    bg.src="<?php echo base_url('uploads/store/'.$data[0]->img);?>";
     bg.onload = function () {
    ctx.drawImage(bg,0,0,bg.width,bg.height,0,0,canvas.width,canvas.height);
    
  }



    var imageLoader = document.getElementById('imageLoader');
    imageLoader.addEventListener('change', handleImage, false);



    function handleImage(e){

            var reader = new FileReader();
            reader.onload = function(event){
                
                img.onload = function(){
                    imageWidth=canvas.width/7;
        imageHeight=canvas.height/7;
        imageRight=imageX+imageWidth;
        imageBottom=imageY+imageHeight;
                    draw(true,false);
                }
                img.src = event.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);     

}


  function draw(withAnchors,withBorders){

        // clear the canvas
        ctx.clearRect(0,0,canvas.width,canvas.height);
        ctx.drawImage(bg,0,0,bg.width,bg.height,0,0,canvas.width,canvas.height);
        // draw the image
        ctx.drawImage(img,0,0,img.width,img.height,imageX,imageY,imageWidth,imageHeight);

        // optionally draw the draggable anchors
        if(withAnchors){
            drawDragAnchor(imageX,imageY);
            drawDragAnchor(imageRight,imageY);
            drawDragAnchor(imageRight,imageBottom);
            drawDragAnchor(imageX,imageBottom);
        }

        // optionally draw the connecting anchor lines
        if(withBorders){
            ctx.beginPath();
            ctx.moveTo(imageX,imageY);
            ctx.lineTo(imageRight,imageY);
            ctx.lineTo(imageRight,imageBottom);
            ctx.lineTo(imageX,imageBottom);
            ctx.closePath();
            ctx.stroke();
        }

    }

    function drawDragAnchor(x,y){
        ctx.beginPath();
        ctx.arc(x,y,resizerRadius,0,pi2,false);
        ctx.closePath();
        ctx.fill();
    }

    function anchorHitTest(x,y){

        var dx,dy;

        // top-left
        dx=x-imageX;
        dy=y-imageY;
        if(dx*dx+dy*dy<=rr){ return(0); }
        // top-right
        dx=x-imageRight;
        dy=y-imageY;
        if(dx*dx+dy*dy<=rr){ return(1); }
        // bottom-right
        dx=x-imageRight;
        dy=y-imageBottom;
        if(dx*dx+dy*dy<=rr){ return(2); }
        // bottom-left
        dx=x-imageX;
        dy=y-imageBottom;
        if(dx*dx+dy*dy<=rr){ return(3); }
        return(-1);

    }


    function hitImage(x,y){
        return(x>imageX && x<imageX+imageWidth && y>imageY && y<imageY+imageHeight);
    }


    function handleMouseDown(e){
      //alert("down");
      startX=parseInt(e.clientX-offsetX);
      startY=parseInt(e.clientY-offsetY);
      draggingResizer=anchorHitTest(startX,startY);
      draggingImage= draggingResizer<0 && hitImage(startX,startY);
    }

    function handleMouseUp(e){
      //alert("up");
      draggingResizer=-1;
      draggingImage=false;
      draw(true,false);
    }

    function handleMouseOut(e){
      //alert("out");
      handleMouseUp(e);
      draw(false,false);
    }

    function handleMouseMove(e){
     // alert("move");

      if(draggingResizer>-1){

          mouseX=parseInt(e.clientX-offsetX);
          mouseY=parseInt(e.clientY-offsetY);

          // resize the image
          switch(draggingResizer){
              case 0: //top-left
                  imageX=mouseX;
                  imageWidth=imageRight-mouseX;
                  imageY=mouseY;
                  imageHeight=imageBottom-mouseY;
                  break;
              case 1: //top-right
                  imageY=mouseY;
                  imageWidth=mouseX-imageX;
                  imageHeight=imageBottom-mouseY;
                  break;
              case 2: //bottom-right
                  imageWidth=mouseX-imageX;
                  imageHeight=mouseY-imageY;
                  break;
              case 3: //bottom-left
                  imageX=mouseX;
                  imageWidth=imageRight-mouseX;
                  imageHeight=mouseY-imageY;
                  break;
          }

          // enforce minimum dimensions of 25x25
          if(imageWidth<15){imageWidth=15;}
          if(imageHeight<15){imageHeight=15;}

          // set the image right and bottom
          imageRight=imageX+imageWidth;
          imageBottom=imageY+imageHeight;

          // redraw the image with resizing anchors
          draw(true,true);

      }else if(draggingImage){

          imageClick=false;
          mouseX=parseInt(e.clientX-offsetX);
          mouseY=parseInt(e.clientY-offsetY);
          // move the image by the amount of the latest drag
          var dx=mouseX-startX;
          var dy=mouseY-startY;
          imageX+=dx;
          imageY+=dy;
          imageRight+=dx;
          imageBottom+=dy;
          // reset the startXY for next time
          startX=mouseX;
          startY=mouseY;
          // redraw the image with border
          draw(false,true);
      }
    }

  

    $("#canvas").mousedown(function(e){handleMouseDown(e);});
    $("#canvas").mousemove(function(e){handleMouseMove(e);});
    $("#canvas").mouseup(function(e){handleMouseUp(e);});
    $("#canvas").mouseout(function(e){handleMouseOut(e);});
    


}); // end $(function(){});
function myfunction(){
var canvas=document.getElementById("canvas");
 var png=canvas.toDataURL();
var pid="<?php echo $data[0]->pid;?>";
document.getElementById('notify').innerHTML="Saved";
document.getElementById("notify").disabled=true;




   var png=canvas.toDataURL();

                $.post("http://localhost/new/rv0/store/logoimage", { imgdb : png,pid : pid}, function(data) {
                });
window.close();
window.onunload = function(){
  window.opener.getcustom_img(pid)
  //window.opener.location.reload();
}


      return true;


        
}
function myfunctionn()
{
  var pid="<?php echo $data[0]->pid;?>";
  var a="<?php echo base_url('uploads/store/customize').'/';?>";
  
   $.post("http://localhost/new/rv0/store/store_custom", {pid : pid}, function(data) {
                    document.getElementById('logoimg').src="<?php echo base_url('uploads/store/customize').'/';?>"+data;

                });
}
</script>
 
</head>

<body bgcolor="blue">
</div>
    <input type="file" id="imageLoader" name="imageLoader"/>
    <canvas id="canvas" width=250 height=250 ></canvas><br>
    <button type="button"  id="notify" onclick="myfunction()">Save Changes</button>
</body>
</html>

