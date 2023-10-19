<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatROOM</title>
<style>
  *{
    box-sizing: border-box;
  }
div.topPanel{
  position: fixed;
  background-color: rgb(80,127,128);
  top : 0px ; 
  left : 0px;
  width : 100% ;
  padding : 15px;
}
div.formPanel{
  position: absolute;
  background-color: rgb(27, 27, 27 , 0.5);
  top : 250px; 
  left : 420px ;
  width:550px;
  height: 350px;
  padding : 10px;
}
div.hexagon{
  position: absolute;
  background-color: rgb(80,127,128) ;
  top : 120px ;
  left : 400px ; 
  padding :300px ;
  opacity: 0.5;
  clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
  animation-name: hexagonMotion;
  animation-duration: 200s;
  animation-timing-function: cubic-bezier(0.1,0.1,0.1,0.1);
  animation-iteration-count: infinite;
}
div.lightHole {
  position : fixed;
  background-color: rgb(80,127,128) ;
  bottom : 0px ; 
  left  : 0px;
  width : 100% ; 
  height: 15px; 
  box-shadow: 30px 30px 20px 35px rgb(80,127,128);
}
body{
  background-color: rgb(27,43,43);
}

.button{
background-color: rgb(80,127,128);
padding : 10px;
width :150px;
font-size: larger;
}
.button:hover{
  box-shadow: 1px 1px 30px 5px rgb(80,127,128);
}
@keyframes hexagonMotion {
  from{
    transform: rotate(0deg);
  }to{
    transform: rotate(360deg);
  }
  
}

[class*="circle-"]{
  padding:3px;
  border-radius: 100%;
  position: fixed;
  bottom:0px;
  background-color: rgb(80,127,128);
  animation-name: circleMotion1;
  animation-duration: 50s;
  animation-timing-function:cubic-bezier(0.1,0.1,0.1,0.1) ;
  animation-iteration-count: infinite;
  box-shadow: 1px 1px 11px 1px rgb(80,127,128);
}
@keyframes circleMotion1 {
  from{
    bottom:0px;
    opacity:1;
  }to{
    bottom:250px;
    opacity: 0;
  }
}
/*    <button class="signUP" style="margin-left:25px;" name="signUP"><h3>sginUP</h3></button>
    <button calss="signIN" style="margin-left:150px;" name="signIN"><h3>sginIN</h3></button>*/ 

input.text{
  background-color : rgb(27,27,27,0.5);
  border:none;
  border-bottom: 0.2px solid black;
  color:white;
  font-size: large;
}
label.Err{
  color:red; 
  font-size: large;
  display: none;
  margin-left: 30px;
}

</style>

</head>
<body>
  <div class= "topPanel"><h1 style="text-align:center;">Login</h1></div>
  <div class="hexagon"></div>
<div class="formPanel">
  <form id='form' name='form' action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
    <h2 calss="username" style ="margin-top : 40px; margin-left :25px;">Username : </h2>
    <input data-parsley-pattern="/^[a-zA-Z\s]+$/" type ="text" id="userText" name="username" class="text" style ="margin : 10px;margin-left:25px; padding : 7px; width : 450px;" >
    <label id ="userNameErr" class="Err"></label>
    <h2 class="password" style ="margin : 10px; margin-left:25px;">password : </h2>
    <input data-parsley-minlength="6" data-parsley-maxlength="25" data-parsley-pattern="[0-9a-zA-Z]" type ="password" id="passwordText" name="password" class="text" style ="margin : 10px;margin-left:25px; padding : 7px; width : 450px;" >
    <label id ="passwordErr" class="Err"></label>
    <input type="submit" value="Register" name="sginUP" style="margin-left:25px;" class="button">
    <input type="submit" value="Login" name="sginIN" style="margin-left:150px;" class="button">
    
  </form>
</div>


<div class="circle-1" style="left:130px; padding:2px;animation-duration: 15s;"></div>
<div class="circle-2" style="left:160px;padding:2px;animation-duration: 20s;"></div>
<div class="circle-3" style="left:190px;padding:2px;animation-duration: 25s;"></div>

<div class="circle-4" style="left:220px;padding:2px;animation-duration: 13s;"></div>
<div class="circle-5" style="left:250px;padding:3px;"></div>
<div class="circle-6" style="left:280px;padding:2.5px;animation-duration: 22s;"></div>

<div class="circle-7" style="left:310px;padding:2.5px;"></div>
<div class="circle-8" style="left:340px;padding:2px;animation-duration: 16s;"></div>
<div class="circle-9" style="left:370px;padding:3px;animation-duration: 18s;"></div>

<div class="circle-10" style="left:400px;padding:2px;"></div>
<div class="circle-11" style="left:430px;padding:2px;animation-duration: 16s;"></div>
<div class="circle-12" style="left:460px;padding:2px;animation-duration: 15s;"></div>

<div class="circle-13" style="left:590px;padding:3px;animation-duration: 27s;"></div>
<div class="circle-14" style="left:520px;padding:2px;"></div>
<div class="circle-15" style="left:550px;padding:3px;animation-duration: 23s;"></div>

<div class="circle-16" style="left:680px;padding:3px;"></div>
<div class="circle-17" style="left: 710px;padding:2px;animation-duration: 30s;"></div>
<div class="circle-18" style="left:740px;padding:3px;animation-duration: 35s;"></div>

<div class="circle-19" style="left:770px;padding:3px;"></div>
<div class="circle-20" style="left:800px;padding:2px;animation-duration: 30s;"></div>
<div class="circle-21" style="left:830px;padding:1.5px;animation-duration: 35s;"></div>

<div class="circle-22" style="left:860px;padding:3px;"></div>
<div class="circle-23" style="left:890px;padding:3px;animation-duration: 16s;"></div>
<div class="circle-24" style="left:920px;padding:3px;"></div>

<div class="circle-25" style="left:950px;padding:1.5px;animation-duration: 18s;"></div>
<div class="circle-26" style="left:980px;padding:3px;animation-duration: 19s;"></div>
<div class="circle-27" style="left:1010px;padding:2.5px;animation-duration: 20s;"></div>

<div class="circle-28" style="left:1040px;padding:1.9px;"></div>
<div class="circle-29" style="left:1070px;padding:2.5px;animation-duration: 25s;"></div>
<div class="circle-30" style="left:2000px;padding:3px;animation-duration: 27s;"></div>

<div class="circle-31" style="left:2030px;padding:2.5px;animation-duration: 26s;"></div>
<div class="circle-32" style="left:2060px;padding:3px;"></div>
<div class="circle-33" style="left:2090px;padding:1.8px;animation-duration: 30s;"></div>





<div class = "lightHole"></div>
     
</body>
</html>
<script>

$(document).ready(function()
{
  $('#form').parsley();
});

$('#form').on('submit',function(event){
  event.preventDefault(); //this will avoid web page from reloading
});
</script>

<?php
 if(isset($_POST['sginUP'])){
?>

  <script>
    window.location.assign("sginUP.php");
  </script>

<?php

 }
 //echo "<h1 style = 'color:red; position:fixed; top:250px;'>"."userName : ".$_POST['username'] ." password: ".$_POST['password']."</h>";
 
 $error = '';
 require_once("databaseHandler.php");
 $DB = new databaseHandler();
 



 if(isset($_POST['sginIN'])){
    if(isset($_POST['username']) && isset($_POST['password'])){
      //echo "<h1 style = 'color:red; position:fixed; top:250px;'>".$DB->isUser($_POST['username'],$_POST['password'])." accessable</h>";      
      if($DB->isUser($_POST['username'],$_POST['password'])){
        //echo "<h1 style = 'color:red; position:fixed; top:250px;'>"."userName : ".$_POST['username']." accessable</h>";
        $_SESSION['userName']=$_POST['username'];
        $_SESSION['password']=$_POST['password'];
        $DB->userLogin($_SESSION['userName']);
?>
  <script>
    let userNameErr = document.getElementById('userNameErr') ;
    let passwordErr = document.getElementById('passwordErr') ;
    userNameErr.style.display="none";
    passwordErr.style.display="none";
    document.getElementById('userText').value = '';
    window.location.assign('roomsPanel.php');
  </script>
<?php
    $_POST = array();
      }
      else{
        //echo "<h1 style = 'color:red; position:fixed; top:250px;'>"."userName : ".$_POST['username']." access denied</h>";
        $_POST = array();
?>
  <script>
    userNameErr.textContent = "wrong userName";
    passwordErr.textContent = "wrong password";
    userNameErr.style.display = "block";
    passwordErr.style.display = "block";
  </script>
<?php

      }
      $_POST = array();
    }
 }

?>