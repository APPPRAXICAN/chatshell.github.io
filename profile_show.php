<?php session_start(); require("databaseHandler.php");$DB = new databaseHandler();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
    body{
        background-color: rgb(27,43,43);
    }
    div.main {
        position: absolute;
        top:0px;
        left:300px;
        width: 800px;
        height: 1200px;
        background-color: rgb(27, 27, 27 , 0.5);
        margin-bottom : 30px;
        padding-bottom: 30px;
        background-color: rgb(80,127,128);
    }
    div.imagePanel{
        position: absolute;
        left :30%;
        border-radius: 0% 0% 35% 35%;
        width:300px;
        height: 500px;
        background-color: rgb(27,43,43);
        box-shadow: 10px 10px 10px rgb(27,43,43);
        /*animation-name: baxShadowAnimation;
        animation-duration: 5s;
        animation-iteration-count: infinite;
        animation-timing-function: cubic-bezier(0.1,0.1,0.1,0.1);*/
    }
    @keyframes baxShadowAnimation {
        0%{
            box-shadow: 10px 10px 10px blue;
        }50%{
            box-shadow: 10px 10px 10px blueviolet;
        }
        100%{
            box-shadow: 10px 10px 10px blue;    
        }
    }
    img{
        position: inherit;
        top:250px;
        left: 50px;
        border-radius: 50%;
    }
    
    div.informationPanel{
        padding:5px;
        position: absolute;
        margin:15px;
        top :500px;
        left:50px;
        width:80%;
        height: 600px;
        background-color: rgb(27,43,43);
        
    }
    label{
        font-size: xx-large;
        display: block;
        margin-top: 20px;
        margin-left: 30px;
        color:rgb(80,127,128);
    }
    input[type='text']{
        font-size: x-large;
        padding:5px;
        margin:5px;
        margin-left:35px;
        width: 500px;
        background-color: lightgray;
        border:none;
    }
    input[type='submit']{
        font-size: larger;
        padding:15px;
        border:none;
        background-color: rgb(80,127,128);
        margin:15px;
        margin-top: 50px;
        margin-left:50px;
    }
    div.roomsContainer{
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
        top:300px;
        left:200px;
    }
    div.warnMsg h2{
        color:green;
        text-align: center;
    }

</style>

<div class='main'>
    <div class='imagePanel'>
        <img src="<?php echo $DB->getUserProfileImage($_SESSION['userProfile']);?>" class="img">
    </div>
    <div class='informationPanel' id="informationPanel">
        <label style="margin-top:70px">Username:</label><br>
        <input type ="text" readonly name="userName" value="<?php echo $_SESSION['userProfile'] ?>">
        <br>
        <label>Age:</label><br>
        <input type="text" name="age" readonly value="<?php echo $DB->getUserAge($_SESSION['userProfile'])?>">
        <br>
        <label>Gender:</label><br>
        <input type="text" name="gender" readonly value="<?php echo $DB->getUserGender($_SESSION['userProfile'])?>">
        <br>
        <input type="submit" id="addFriendBtn" name="friendBtn" value="+add Friend">
        <input type="submit" id="addToRoomBtn" name="addToRoom" value="Invite to Room" style="margin-left:200px;">
        <div class='roomsContainer' id='roomsContainer'>
            <div class="container" id="container">
            </div>
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
<?php
    $roomSet = $DB->getRoomsNameList($_SESSION['userName']);
    if(!$DB->isAlreadyfriend($_SESSION['userProfile'] , $_SESSION['userName'])){
        $isAlreadyFriend = 0 ;
    }else{
        $isAlreadyFriend = $DB->isAlreadyfriend($_SESSION['userProfile'] , $_SESSION['userName']);
    }
    
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    console.log('world is online');
   
   
   let addFriendBtn = document.getElementById('addFriendBtn');
   let addToRoomBtn = document.getElementById('addToRoomBtn');
   let from = <?php echo json_encode($_SESSION['userName']);?> ;
   let to = <?php echo json_encode($_SESSION['userProfile']);?> ;
   let roomsContainer = document.getElementById('roomsContainer');
   let container = document.getElementById('container');
   
   let isAlreadyFriend = <?php echo json_decode($isAlreadyFriend)?>;
   

   function displayMsg(msg , color){
        let panel = document.createElement('div');
        panel.classList.add('warnMsg');
        let title = document.createElement('h2');
        title.innerHTML = msg;
        color != null ? title.style.color = color : false ;
        panel.appendChild(title);
        panel.style.display = 'block';
        document.getElementById('informationPanel').appendChild(panel);
        document.addEventListener('mouseup', function (event){
            if(!panel.contains(event.target)){
               panel.style.display = 'none';
            }
        });
   }
   
    function sendFriendRequest(from , to){
        $(function(){
            $.ajax({
                url:'' , 
                method :'POST',
                data:{fromUser:from , toUser:to},
                success:function(data){
                    console.log(data);
                    displayMsg('friend request sent') ; 
                }
            });
        });// already sent condition
   }
   function sendRoomRequest(from , to){
    $(function(){
        $.ajax({
            url:'',
            method:'POST',
            data:{fromRoom:from , toUser:to},
            success:function(data){
                displayMsg('room request sent') ; 
            }
        });
    });// already sent condition 
   }
   function sendOrderToRemoveFriend(from , to){
    $(function(){
        $.ajax({
            url:'',
            method:'POST',
            data:{fromUser:from , toUser:to , type : 'removeFriend'},
            success:function(data){
                displayMsg('friend removed successfully') ; 
            }
        });
    });
   }
   function displayRooms(container , toUser){
        let roomsNameList =<?php echo json_encode($roomSet);?>; 
        console.log(roomsNameList.length);
        if(roomsNameList.length > 0){
            for(let roomName of roomsNameList) {
                let room = document.createElement('div');
                room.classList.add('roomDiv');
                let roomLabel = document.createElement('h2');
                roomLabel.textContent = roomName;
                room.appendChild(roomLabel);
                room.style.cursor="pointer";
                container.appendChild(room);
                room.onclick=function(){
                    $(function(){
                        $.ajax({
                            url:"profile_show_server.php",
                            dataType:"json",
                            success:function(data){
                                console.log(data);
                                if(data){
                                    displayMsg('Room is Full' , 'red');
                                }else{
                                    sendRoomRequest(roomName ,toUser);
                                }
                            }
                        })
                    });
                  
                    roomsContainer.style.display="none"; // ajax condition ...
                };
            }
            console.log('see : ' , roomsNameList.length);
        }
        else{
            let warningLabel = document.createElement('label');
            warningLabel.innerHTML ="you don't have any Room yet, please go and create one &#9888;";
            warningLabel.style.color = "red";
            container.appendChild(warningLabel);
        }

   }
   
   console.log('isAlreadyFriend = ' , isAlreadyFriend);
   if(isAlreadyFriend == 1) {
        console.log(addFriendBtn.value);
        addFriendBtn.value="remove friend";
        addFriendBtn.onclick=function(){
            sendOrderToRemoveFriend(from , to);
           
        }
   }
   else{
            addFriendBtn.onclick = function(){
            sendFriendRequest(from , to ) ;
            
        }
   }

   
   
   addToRoomBtn.onclick=function(){
        roomsContainer.style.display = 'block';
        let title = document.createElement('h1');
        title.textContent = 'My Room';
        title.classList.add("roomsContainerTitle");
        roomsContainer.appendChild(title);
        displayRooms(container ,to);
        roomsContainer.appendChild(container);
   }
   document.addEventListener('mouseup', function (event){
            if(!roomsContainer.contains(event.target)){
                roomsContainer.style.display="none" ;
                roomsContainer.innerHTML='';
                container.innerHTML='' ;
            }
        });
</script>
<?php
    if(isset($_POST['fromUser'])&&isset($_POST['toUser'])){
        if(!$DB->isFriendRequestAlreadySent($_POST['fromUser'] ,$_POST['toUser']) && !$DB->isAlreadyfriend($_POST['fromUser'],$_POST['toUser'])){
            $DB->sendFriendRequest($_POST['fromUser'] ,$_POST['toUser']);
            $_POST['friendRequestSent']=true;
        }
        else{
          //  $_SESSION['requestWarn']['fAlreadySent']=true;
        }
    }
    if(isset($_POST['fromRoom'])&&isset($_POST['toUser'])){
        if(!$DB->isRoomRequestAlreadySent($_POST['fromRoom'] ,$_POST['toUser']) && !$DB->isUserAlreadyInRoom($_POST['toUser'] ,$_POST['fromRoom'] )){
            if($DB->getNumberOfFreePlaces($_POST['fromRoom'] , $_SESSION['userName']) > 0 ){
                $DB->sendRoomRequest($_POST['fromRoom'] ,$_POST['toUser']);
            }
            else{
                $_SESSION['roomIsFull'] = true;
               // $_SESSION['requestWarn']['roomIsFull'] = true;
            }
        }
        else{
           // $_SESSION['requestWarn']['rAlreadySent'] = true;
        }
    }
    if(isset($_POST['fromUser']) &&isset($_POST['toUser']) && isset($_POST['type'])){
        if($_POST['type'] == 'removeFriend'){
            $DB->removeFriend($_POST['fromUser'] , $_POST['toUser']);
            echo $_POST['type'];
        }
    }
?>
</body>
</html>