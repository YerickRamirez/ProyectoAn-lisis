<html>
   <head>
      <title>Ajax Example</title>
      
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
      
      <script>
          function a(){
            $.get('/getmsg', function(data){ 
                alert(data);
    }).fail(function(){
        alert("Error. :c");
    });
            }
        
            </script>
   </head>
   
   <body>
      <div id = 'msg'>This message will be replaced using Ajax. 
         Click the button to replace the message.</div>
      <?php
         echo Form::button('Replace Message',['onClick'=>'a()']);
      ?>
   </body>

</html>