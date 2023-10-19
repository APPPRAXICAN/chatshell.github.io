<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


</head>
<style>
  
    *{
        box-sizing: border-box;
    }
    body::-webkit-scrollbar{
        display:none;
    }
    div.topPanel{
      position: fixed;
      background-color: rgb(80,127,128);
      top : 0px ; 
      left : 0px;
      width : 100% ;
      padding : 15px;
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
    border: none;
    /*position: absolute;
    left:50px;top:500px;
    */
    margin-left:180px;
    margin-top: 30px;
    
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
    input.text{
      background-color : rgb(27,27,27,0.5);
      border:none;
      border-bottom: 0.2px solid black;
      color:white;
      font-size: large;
    }
    .container input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
    }
    .checkmark {
      position: absolute;
      height: 25px;
      width: 25px;
      background-color: #eee;
      border-radius: 50%;
    }
    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark {
      background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */
    .container input:checked ~ .checkmark {
      background-color: rgb(80,127,128);
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .container input:checked ~ .checkmark:after {
      display: block;
    }

    /* Style the indicator (dot/circle) */
    .container .checkmark:after {
      top: 9px;
      left: 8.3px;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: black;
    }
    .container{
      font-size: larger;
      display: inline-block;
      align-self:center;

    }
    label.warn {
      display:none ; 
      font-size: large;
      color:red ;
      margin-left: 25px;
    }
    h2{
      margin:8px ;
    }
</style>
<body>
    <div class ="topPanel"><h1 style="text-align:center">Sgin UP<h1></div>
    <div class="hexagon"></div>
    <div calss="formPanel" style="  position: absolute;
  background-color: rgb(27, 27, 27 , 0.5);/*rgb(27, 27, 27 , 0.5)*/
  top : 150px; 
  left : 420px ;
  width:550px;
  /*height: 550px;*/
  height:auto;
  padding : 10px;">
        <form id = "form" action="sginUP.php" method="POST">
            <h2 style ="margin-top : 20px; margin-left :25px;">Username:</h2>
            <input id="userNameBox" type="text" class="text" name="username"style ="margin : 1px;margin-left:25px; padding : 7px; width : 450px;">
            <label class="warn" id="userWarn">a</label>
            <h2 style =" margin-left :25px;">Password:</h2>
            <input id="passwordBox" type="password" name="password" class="text" style ="margin : 1px;margin-left:25px; padding : 7px; width : 450px;">
            <label class="warn" id="passwarn">a</label>
            <h2 style =" margin-left :25px; ">Confirm password</h2>
            <input id="confirmPasswordBox" type="password" name="passwordConfirmation" class="text" style ="margin : 1px;margin-left:25px; padding : 7px; width : 450px;">
            <label class="warn" id="confirmPasswarn">a</label>
            <h2 style ="margin-left:25px;">Age</h2>
            <input  id="ageBox" type="text" class="text" name="age" style ="margin : 1px;margin-left:25px; padding : 7px; width : 450px;">
            <label class="warn" id="ageWarn">a</label>
            <div style="margin-top:10px;">
              <label style ="margin-left:25px; font-size:x-large;">Gender :</label>
              <label class="container" style="position:absolute; left:180px;" >Male<input type ="radio" id="maleRadio" name="genderRadio" value="0"><span class="checkmark" style="left:-35px;"></span></label>
              <label class="container" style="position:absolute;right:180px;">Female <input type ="radio" id="femaleRadio" name="genderRadio" value="1"><span class="checkmark" style="right:70px;" ></span></label><br>  
              <label class="warn" id="genderWarn"></label>
            </div>
            <!--<input type="submit" value="Back" name="Back" class="button" style="margin-left:25px;">-->
            <!--<input type="submit" value="Confirm" name="confirm" class="button" style="margin-left:150px;" id ="submit">
  -->
            
          </form>
          <button class="button" , id="submit" name="btn">Confirm</button>
        </div>

{
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

      <div class="lightHole"></div>
}             
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  let usernameBox = document.getElementById('userNameBox');
  let passwordBox = document.getElementById('passwordBox');
  let confirmPasswordBox = document.getElementById('confirmPasswordBox');
  let ageBox = document.getElementById('ageBox');
  let userWarn = document.getElementById('userWarn');
  let passwarn = document.getElementById('passwarn');
  let confirmPasswarn = document.getElementById('confirmPasswarn');
  let ageWarn = document.getElementById('ageWarn');
  let genderWarn = document.getElementById('genderWarn');
  let maleRadioBtn = document.getElementById('maleRadio');
  let femaleRadioBtn = document.getElementById('femaleRadio');
  let gender=-1 ; //error is occurred
  let submit = document.getElementById('submit');
  submit.onclick = function(){
    let isok = false ; 
    if(!usernameBox.value.match(/^[a-zA-Z][a-zA-Z0-9]/g)){
      userWarn.textContent="please pick a valid username , with litter first.";
      userWarn.style.display="block";
    }
    if(usernameBox.value ==""){
      userWarn.textContent="Warning: usrename can't be blank.";
      userWarn.style.display="block"; 
    }
    if(!passwordBox.value.match(/[a-zA-Z0-9]/g)){
      passwarn.textContent="Warning : password must contain a character and numbers only.";
      passwarn.style.display="block";
    }
    if(passwordBox.value ==""){
      passwarn.textContent="Warning : password can't be blank.";
      passwarn.style.display="block";  
    }
    if(passwordBox.value != confirmPasswordBox.value){
      confirmPasswordBox.textContent="" ;  confirmPasswarn.textContent="Warning: password is not identical , please try again"; confirmPasswarn.style.display="block";
    }
    if(!ageBox.value.match(/[0-9]/g)){
      ageWarn.textContent="Warning: age must contain numbers only.";
      ageWarn.style.display="block";
    }
    if(ageBox.value == ""){
      ageWarn.textContent="Warning: age can't be blank.";
      ageWarn.style.display="block";
    }
    if(!maleRadioBtn.checked && !femaleRadioBtn.checked) {
      genderWarn.textContent = "Warning: Please select gender";
      genderWarn.style.display="block";
    }
    if(maleRadioBtn.checked)gender= 0 ; 
    if(femaleRadioBtn.checked) gender = 1 ;
    if(ageBox.value.match(/[0-9]/g) &&
     passwordBox.value.match(/[a-zA-Z0-9]/g) && 
     usernameBox.value.match(/^[a-zA-Z][a-zA-Z0-9]/g)&&
     passwordBox.value==confirmPasswordBox.value){
      maleRadioBtn.checked || femaleRadio.checked ? isok =true : isok =false;
    }else console.log(isok);
    $(function(){
      if(isok){
          $.ajax({
          url:"sginUP_server.php",
          method:'POST',
          dataType:'json',
          data:{ username: usernameBox.value  , password: passwordBox.value ,confirmPassword:confirmPasswordBox.value, age : ageBox.value , gender : gender},
          success:function(data){
            console.log(data);
            userWarn.textContent=""; passwarn.textContent=""; confirmPasswarn.textContent=""; ageWarn.textContent="";genderWarn.textContent="";   
            if(data.success){
              window.location.assign('roomsPanel.php');
            }
            if(data.nameFailure != null){
              userWarn.textContent = data.nameFailure ; userWarn.style.display="block";
            }
            
          }
          ,
          error:function(xhr , status , error){
            console.log(error);
          }
        });
      }
    });
  };
</script>