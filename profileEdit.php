<?php session_start(); require("databaseHandler.php");$DB = new databaseHandler();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatshell/MyProfile</title>
</head>
<body>
<style>
    body{
        background-color: rgb(27,43,43);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    *{
        box-sizing: border-box;
    }
    div.main {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        width: 70%;
        gap: 32px;
        background-color: rgb(80,127,128);
    }
    div.imagePanel{
        display: flex;
        flex-direction: column;
        justify-content: end;
        align-items: center; 
        border-radius: 0% 0% 35% 35%;
        width:300px;
        height: 500px;
        background-color: rgb(27,43,43);
        box-shadow: 10px 10px 10px rgb(27,43,43);
    }
    @keyframes baxShadowAnimation {
        0%{
            box-shadow: 10px 10px 10px rgb(80,127,128);
        }50%{
            box-shadow: 10px 10px 10px rgb(27,43,43);
        }
        100%{
            box-shadow: 10px 10px 10px rgb(80,127,128);    
        }
    }
    img{
        /* position: inherit;
        top:250px;
        left: 50px; */
        border-radius: 50%;
    }
    
    div.informationPanel{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding:52px;
        margin:39px;
        width: 83%;
        background-color: rgb(27,43,43);
        
    }
    label{
        font-size: xx-large;
        display: block;
        color:rgb(80,127,128);
    }
    input[type='text']{
        font-size: x-large;
        padding:5px;
        background-color: lightgray;
        border:none;
    }
    input[type='submit']{
        font-size: larger;
        padding:15px;
        border:none;
        width: 66px;
        background-color:rgb(80,127,128);
        /* margin-left:113px; */
        border-radius: 10%;
    }
    div.roomsContainer{
        border: 1px solid red;
        width:350px;
        height: auto;
        position:inherit;
        display:none;
        top:300px;
        right: 150px;
        max-height: 400px;
        background-color: rgb(80,127,128);
    }
    div.roomDiv{
        border:1px solid green;
        padding: 10px;
    }
    .roomsContainerTitle{
        display: block;
        border-bottom: 2px solid rgb(80,127,128);
        text-align: center;
    }       
    h2{
        color: rgb(80,127,128);
    }
    div.container{
        height: auto;
        max-height: 280px;
        background-color: rgb(27,43,43);
        overflow: auto;
        -ms-overflow-style: none; /* IE and Edge */
        scrollbar-width: none; /* Firefox */
        width:300px;
        margin-left:25px;
        margin-bottom:5px;
    }
    div.warnMsg{
        padding:30px;
        border:20px solid rgb(80,127,128);
        background-color: rgb(27,43,43); 
        display: none;
        position:absolute;
        top:750px;
        left:430px;
    }
    div.warnMsg h2{
        color:red;
        text-align: center;
    }
    label.warn{
        color: red;
        font-size: larger;
        padding:0px;
        margin:0px;
        display: none;
        text-align: left;
        margin-left: 40px;
    }

</style>

<div class='main'>
    <div class='imagePanel'>
        <img src="<?php echo $DB->getUserProfileImage($_SESSION['userName']);?>" class="img">
    </div>
    <div class='informationPanel' id="informationPanel">
        <label >Username:</label><br>
        <input type ="text" readonly name="userName" value="<?php echo $_SESSION['userName'] ?>">
        <br>
        <label>password:</label><br>
        <input type ="text" id="password" name="password" value="<?php echo $DB->getUserPassword($_SESSION['userName']) ?>">
        <br>
        <label class="warn" id="passwordWarn"></label><br>
        <label>Age:</label><br>
        <input type="text" name="age" id="ageBox"  value="<?php echo $DB->getUserAge($_SESSION['userName'])?>"><br>
        <label class="warn" id="Agewarn">d</label>
        <br>
        <label >Gender:</label><br>
        <input type="text" name="gender" readonly value="<?php echo $DB->getUserGender($_SESSION['userName'])?>">
        <br>
        <div style="display: flex; justify-content:center ; align-items:center;">
            <input type="submit" id="edit" name="edit" value="Edit" >
        </div>
    </div>
    <?php
       // print_r($_SESSION);
    ?>
    
</div>
<footer>
    <?php
        require('introDesign.php');
    ?>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     function displayMsg(msg){
        let panel = document.createElement('div');
        panel.classList.add('warnMsg');
        let title = document.createElement('h2');
        title.innerHTML = msg;
        title.style.color = 'lightgreen';
        panel.appendChild(title);
        panel.style.display = 'block';
        document.getElementById('informationPanel').appendChild(panel);
        document.addEventListener('mouseup', function (event){
            if(!panel.contains(event.target)){
               panel.style.display = 'none';
            }
        });
   }
    function sendNewData(age ,password){
        $(function(){
            $.ajax({
                url:'',
                method:'POST',
                data:{newAge:age , newPassword:password},
                success:function(data){
                    displayMsg('your Edition has been saved');
                }
            });
        });
    }
    let editBtn = document.getElementById('edit');
    let AgeBox = document.getElementById('ageBox');
    let Agewarn = document.getElementById('Agewarn');
    let password = document.getElementById('password');
    let passwordWarn = document.getElementById('passwordWarn');
    editBtn.onclick = function(){
        if(AgeBox.value==""){
            Agewarn.textContent = "Warning: Age is blank.";
            Agewarn.style.display="block";
        }
        else if(!AgeBox.value.match(/[0-9]+/)){
            Agewarn.textContent="Please Enter a Valid Age";
            Agewarn.style.display="block";
        }
        else if(password.value==""){
            passwordWarn.textContent="Warning: Password is blank.";
            passwordWarn.style.display="block";
        }
        else if(!password.value.match(/[0-9A-Za-z]/)){
            passwordWarn.textContent="please enter a valid password";
            passwordWarn.style.display="block";    
        }
        else{
            Agewarn.style.display="none";
            passwordWarn.style.display="none";
            sendNewData(AgeBox.value , password.value);
        }
        
    }
</script>
<?php
if(isset($_POST['newAge'])){
    $DB->userUpdateAge($_SESSION['userName'] , $_POST['newAge']);
}
if(isset($_POST['newPassword'])){
    $DB->userUpdatePassword($_SESSION['userName'] , $_POST['newPassword']);
}
?>
