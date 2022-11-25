<?php //call database connection link file db.php
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatApp</title>
    <link rel="stylesheet" href="style.css">
    <script> //javascript coding for page-refresh age 
        function aj(){
            var req = new XMLHttpRequest();
            req.onreadystatechange = function(){
                if(req.readyState==4 && req.status==200){
                   document.getElementById('chat').innerHTML=req.responseText;
                }
            }
        req.open('POST', 'chat.php', true); 
        req.send(); 
        } //end of js function
        setInterval(function(){aj()}, 1000);
    </script> 
</head>
<body onload="aj();" > <!-- see db.php-->
   <div id="container">
       <div id="chatbox">
        <div id="chat"></div> <!--for connect js see above new var named chat-->
        
       </div>
    <form action="index.php" method="post">
          <input type="text" name="name" placeholder="Your name please">
          <textarea type="text" name="msg" placeholder="Your message please"></textarea>
          <input type="submit" name="submit" value="SEND">
    </form>
    <?php //codes for insert and send 
    if(isset($_POST['submit'])){
        $n = $_POST['name'];
        $m = $_POST['msg'];
        $insert = "INSERT INTO chat(name, msg) VALUES('$n','$m')";
        $run_insert = mysqli_query($con, $insert);
        if($run_insert){ // for alert msg sound
            echo '<embed loop="false" hidden="true" src="SMSalert.mp3" autoplay="true">';
        }
    header('location: index.php');
    }
    ?>     
    </div>
</body>
</html>