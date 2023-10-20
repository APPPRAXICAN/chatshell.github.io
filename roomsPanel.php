<?php session_start(); include('databaseHandler.php');
$DB = new databaseHandler();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

 <style>
    body{
        background-color:rgb(27,43,43);
        margin : 0px; 
       /* border-left: 3px  solid yellow;
        border-right:3px solid yellow;*/
    }
    div.requestWarnMsgBack{
        background-color: rgb(80,127,128);
        position: absolute;
        top:350px;
        left: 300px;
        padding:10px;
        width: auto;
        height: auto;
        z-index: 99;
        display:none;
    }
    div.requestWarnMsgFront{
        padding:20px;
        width: auto;
        height: auto;
        background-color: rgb(27,43,43);
    }
    ul.topPanel{
        position: fixed;
        list-style-type:none;
        padding :0 ;
        margin :0;
        overflow: hidden;
        width:100%;
        border-bottom: 3px solid rgb(80,127,128);
        border-left: 3px solid rgb(80,127,128);
        border-right: 3px solid rgb(80,127,128);
        background-color: rgb(80,127,128);

    }
    li{
        float:left;
    }
    li *{
        display:block;
        padding:15px;
        text-align: center;
        color: rgb(210 , 224 , 224);
        text-decoration: none;
        font-size: larger;
    }
    .link{
        position: absolute;
        right:0px;
        font-size: xx-large;
        margin-top:0px;
        color :black;
        padding-bottom: 28px;
        transition: background-color 0.5s;
        transition-timing-function: cubic-bezier(0.1,0.1,0.1,0.1) ;
    }
    li a:hover {
      /*  background-color: darkorange;
        color :rgb(27,43,43);*/
    }
    button.roomButton{
        text-align: center;
        padding : 30px;
        width:250px;
        margin: 50px;
        background-color: rgb(80,127,128);
        transform: skew(20deg);
        border: none;
        transform: skew(0deg);
        font-size: xx-large;
        float :left ;
        z-index: -1;
        /*box-shadow: 20px 5px 15px yellow;
        */
        transition:background-color  , padding 1s , width 1s;
        transition-timing-function: cubic-bezier(2,0,0,0);
        transition-duration: 1s;
    }
    button.roomButton:hover{
        padding:30px;
        width:300px;
        margin-left:40px;
        background-color: cyan;
        box-shadow: 20px 5px 15px cyan;
        animation-name: buttonMotion;
        animation-duration: 15s;
        animation-timing-function: cubic-bezier(0.1,0.1,0.1,0.1);
        animation-iteration-count: infinite;
    }
    @keyframes buttonMotion {
        0%{
            box-shadow: 0px 5px 15px cyan;
            transform: rotateY(0deg);
        }25%{
            box-shadow: -20px 5px 25px cyan;
            transform: rotateY(30deg);
        }
        50%{
            box-shadow: 0px 5px 15px cyan;
            transform: rotateY(0deg);
        }
        75%{
            box-shadow: 20px 5px 15px cyan;
            transform: rotateY(-30deg);
        }
        100%{
            box-shadow: 0px 5px 15px cyan;
            transform: rotateY(0deg);
        }
    }
    .img{
        border-radius: 50%;
        width : 35% ;
    }
    .userName{
        margin-top: 10px;
        position:absolute;
        left :80px;
        font-size: xx-large;
    }
    .propertiesPanel{
        position:fixed;
        left: 0px;
        top:80px;
        padding:10px;
        height: 700px;
        width: 280px;
        z-index: 99;
        background-color: rgb(80,127,128);
    }
    .header1{
        border-bottom:1.5px solid rgb(80,127,128);
        color :rgb(80,127,128);
        text-align: center;
        padding:3px;
    }
    .roomFormPopup{
        display: none;
        background-color:rgb(27,43,43);
        width:100vw;
        height:100vh;
        z-index: 99;
        
    }
    .roomForm{
        position:absolute;
        left:40%;
        top:35%;
        padding:30px;
        background-color: rgb(80,127,128);
    }
    .errMsg{
        display: none;
        color:red;
        margin:3px;
    }
    .closeButton{
        background-color: red;
        color : rgb(210 , 224 , 224);
        padding:10px;
        font-size: larger;
        position:absolute;
        right:70px;
        top:100px;
        border:none;
        border-radius: 10px 10px 10px 10px;
    }
    .textBox{
        padding:10px;
        border:none; 
        margin:5px;
    }
    .confirmButton{
        background-color: rgb(27,43,43);
        color:rgb(210 , 224 , 224);
        padding:10px;
        border:none;
        font-size: larger;
        margin-top:5px;
        margin-left: 50px;
    }
    #buttonScreen{
        position:absolute;
        left:282px;
        top:105px;
        width:1179px;
        height:678px;
        overflow: auto;
        background-color: inherit;
        -ms-overflow-style: none;
    }
    div.buttonScreen::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Edge, Opera */
    }

    div.buttonScreen {
        -ms-overflow-style: none; /* IE and Edge */
        scrollbar-width: none; /* Firefox */
    }

    div.linksPanel{
        background-color:rgb(27,43,43);
        /*overflow: auto;
        */margin-top:-20px;
        z-index: -1;
        /*-ms-overflow-style: none;*/
    }
    div.friendZone{
        background-color:rgb(27,43,43);
        height: auto;
        -ms-overflow-style: none;
        margin-top:-15px;
    }
    div.roomZone{
        background-color:rgb(27,43,43);
        overflow: auto;
        height: auto;
        max-height: 210px;
        -ms-overflow-style: none;
        margin-top:5px;
    }
    div.roomZone h2 {
        color:rgb(80,127,128) ; 
        border-bottom: 1px solid rgb(80,127,128) ;
        text-align: center;
    }
    .list{
        list-style-type: none;
        padding:0;
        margin :0;
        overflow: auto;
    }
    .searchBox{
        width:400px;
        margin-top: 10px;
        margin-left: 330px;
        text-align: left;
        background-color: rgb(27,27,27,0.3);
        color: rgb(210 , 224 , 224);
        border: none;
        position: fixed;
        border-right: 1px solid rgb(27,43,43);
    }
    .searchImg{
        width:70px;
        height: 70px;
        position: absolute;
        top:-5px;
        /*right: 435px;*/
        margin-left: -20px; 
    }
    .searchButton{
        background-color: rgb(27,27,27,0.3);
        height:52px;
        width: 60px;
        border: none;
        margin-left:730px;
        position: fixed;
       /* right:443px;*/
        margin-top: 10px;
        overflow: hidden;
        cursor: pointer;
    }
    div.searchResult{
        position: relative;
        display: none;
        top:65px;
        left:563px;
        width:400px;
        height: 300px;
        max-height: 600px;
        background-color:rgb(27,27,27,0.8);
        border: 1px solid rgb(80,127,128);
        z-index: 99;
        overflow: auto;

    }
    div.person{
        border:2px solid rgb(80,127,128);
        font-size: larger;
        color:rgb(210 , 224 , 224);
        padding:10px;
        display:flex;
        /*justify-content: center;*/
    }
    div.notFound{
        text-align: center;
        border:2px solid rgb(80,127,128);
        font-size: larger;
        color : rgb(210 , 224 , 224);
    }
    .profileImg{
        border-radius: 50%;
        width : 25% ;
    }
    .userName1{
        color:rgb(210 , 224 , 224);
        font-size: larger;
        display: inline-block;
        margin-bottom:0px;
        margin-left : 25px;
        align-self: center;
    }
    [class*="status_"]{
        border-radius: 50%;
        width:10%;
    }
    .status_online{
        background-color: green;
    }
    .status_offline{
        background-color: red;
    }
    button.propertiesBtn{
        width:100%;
        background-color: inherit;
        border:1px solid rgb(80,127,128);
        color:rgb(210 , 224 , 224) ;
        padding:15px;
        font-size: larger;
    }
    button.propertiesBtn:hover{
        background-color: rgb(80,127,128);
        color:black;
        border:2px solid black;
    }
    a.propertiesLink{
        text-decoration: none;
        display: block;
        background-color: inherit;
        border:1px solid rgb(80,127,128);
        color:rgb(210 , 224 , 224) ;
        padding:15px;
        font-size: larger;
        text-align: center;
    }
    a.propertiesLink:hover{
        background-color: rgb(80,127,128);
        color:black;
        border:2px solid black;
    }
    div.requestsPanel{
        width:300px;
        height: auto;
        max-height: 450px;
        position: absolute;
        top:200px;
        left: 270px;
        max-height: 400px;
        background-color: rgb(80,127,128);
        display : none;
    }
    div.requestsPanel h2{
        text-align: center;
    }
    div.requestsContainer{
        height: auto;
        max-height: 280px;
        background-color:rgb(27,43,43);
        overflow: auto;
        width:250px;
        margin-left:25px;
        margin-bottom:5px;
    }
     * ::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Edge, Opera */
    }

     * {
        -ms-overflow-style: none; /* IE and Edge */
        scrollbar-width: none; /* Firefox */
    }
    div.requestBlock{
        padding: 10px;
        display:grid;
        border-bottom:1px solid rgb(80,127,128) ;
    }
    .requestLabel{
        font-size: larger;
        color: rgb(210 , 224 , 224);
        width: auto;
    }
    button.acceptBtn{
        background-color: lightgreen;
        border:none;
        margin:5px;
        font-size: large;
        cursor: pointer;
    }
    button.deniBtn{
        background-color: red;
        border:none;
        margin: 5px;
        font-size: large;
        cursor: pointer;
    }
    .warnPanel{
        padding: 50px;
        display: block;
        background-color: inherit;
    }
    .warnPanel .h2{
        text-align: center;
    }
    div.Container{
        height: auto;
        max-height: 190px;
        background-color:rgb(27,43,43);
        overflow: auto;
        margin-bottom:5px;
        margin-top: -20px;
    }
    div.friendBlock{
        display:flex;
        padding:10px;
        border-top:1px solid rgb(80,127,128) ;
    }
    div.friendBlock label{
        display: block;
        margin-right: 10px;
    }
    div.roomBlock{
        padding:10px;
        margin-top:0px;
        border-top: 1px solid rgb(80,127,128);
    }
    div.roomBlock label{
        display: block;
        text-align: center;
        color:rgb(210 , 224 , 224);
        font-size: x-large;
        cursor: pointer;
    }


 </style>

</head>
<body >
    <ul class="topPanel">
        <li><img src="<?php echo $DB->getUserProfileImage($_SESSION['userName']); ?>"class ='img'></li>
        <li><label class="userName" id="userNameLabel" style="margin-left:10px; color:black;"><?php echo $_SESSION['userName']; ?></label></li>
        <li><input type="text" class="searchBox" id="searchBox" placeholder="Search for persons...."></li>
        <li><button class="searchButton" id="searchButton"><img src="search.png" class="searchImg"></button></li>
        <li><a href ="index.html" class="link">Logout</a></li>
        
    </ul>
    <div class="searchResult" id="searchResult">

    </div>
        
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method ="POST">
        
    </form>
    <div class='propertiesPanel'>
        <div class='linksPanel'>
            <h2 class='header1'>Properties</h2>
            <a class="propertiesLink" href="sginUP.php">Create New User</a>
            <a class="propertiesLink" href="profileEdit.php">Update profile</a>
            <button class="propertiesBtn" id="requestBtn">Requists</button>
        </div>
        <div class="requestsPanel" id ="requestsPanel">
            <h2>ALL Requests</h2>
            <div class="requestsContainer" id="requestsContainer"></div>
        </div>
        
        <div class='friendZone' id="friendZone">
            <h2 class='header1'>Friend Zone</h2>
            <div class="Container"  id="friendContainer"></div>
            
        </div>

        <div class="roomZone" id="roomZone">
            <h2 class="header2">Room Zone</h2>
            <div class="Container" id="roomContainer"></div>
        </div>
    </div>
    

    <div class="buttonScreen" id ="buttonScreen" >
            <script>//creating & reading  room section
                   

            </script>

        <div class="roomFormPopup" id="roomFormPopup">
                <input type ="submit" id="closeButton" class="closeButton" value="X">
                <form  method="POST" class="roomForm">
                    <input type = "text" placeholder="Enter Room Name"  class="textBox" id="roomNameText" name="roomName">
                    <label id="roomNameMsg" class="errMsg"></label><br>
                    <input type="text" placeholder="Enter Capacity" class="textBox"  id="capacityText" name="capacity">
                    <label id="capacityMsg" class="errMsg"></label><br>
                    <!--<input type ="text" placeholder="Enter Room Key" class="textBox"  id ="keyText" name="key">
                    <label id="keyMsg" class="errMsg"></label><br>----->
                    <input type="submit" class="confirmButton" id="roomButtonConfirmation" name="roomButtonConfirmation" value="Confirm">
                    
                </form>
        </div>


    </div>
    <div class="requestWarnMsgBack" id="requestWarnMsg"><div class="requestWarnMsgFront" id="requestWarnMsgFront">d</div></div>

    <?php include('introDesign.php');?>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!---------------------------------------------------propertiesPanel--------------------------------------------------------->
<script>
    function sendUserProfile (name){
        $(function(){
                        $.ajax({
                            url:'',
                            method:'POST',
                            data:{userProfile : name},
                            success:function(data){
                                
                            }
                        });
                    });
    }
    function sendFriendAcceptance(friend){
        $(function(){
            $.ajax({
                url:'requestServer.php',
                method:'POST',
                data:{isFriendRequestAccepted : true , friendName:friend },
                success:function(data){}     
            });
        });
    }
    function sendUserDeclineFriend(sender){
        $(function(){
            $.ajax({
                url:'requestServer.php',
                method:'POST',
                data:{isFriendRequestAccepted : 0 , friendName:sender},
                success:function(data){}     
            });
        });
    }
    function sendRoomAcceptance(room){
        $(function(){
            $.ajax({
                url:'requestServer.php',
                method:'POST',
                data:{isRoomRequestAccepted : true , roomName:room},
                success:function(data){}     
            });
        });
    }
    function sendUserDeclineRoom(room){
        $(function(){
            $.ajax({
                url:'requestServer.php',
                method:'POST',
                data:{isRoomRequestAccepted : 0 , roomName:room},
                success:function(data){}     
            });
        });
    }
    let requestBtn = document.getElementById('requestBtn');
    let requestPanel = document.getElementById('requestsPanel');
    let requestContainer = document.getElementById('requestsContainer');
    function requestFactory(admin , requestText , path , room  ,type) {
        let requestBlock  = document.createElement('div');
        requestBlock.classList.add('requestBlock');
        let textLabel = document.createElement('label');
        textLabel.textContent = requestText;
        textLabel.classList.add('requestLabel');
        let profileLink = document.createElement('a');

        profileLink.href = "profile_show.php";
        let profileImg = document.createElement('img');
        profileImg.style.marginLeft= "75px";
        profileImg.classList.add("profileImg");
        profileImg.src= path;
        profileLink.appendChild(profileImg);
        profileLink.onclick = function(){
            sendUserProfile(admin);
        }
        let acceptBtn = document.createElement('button');
        acceptBtn.textContent = 'Accept';
        acceptBtn.classList.add("acceptBtn");
        acceptBtn.onclick = function(){
            console.log("Accept");
            if(type == 'friendRequest'){
                sendFriendAcceptance(admin);
                console.log('friendRequest accepted'); 
            }
            if(type =='roomRequest'){
                $(function(){
                    $.ajax({
                        url:"roomServer.php",
                        dataType:"json",
                        data:{roomName : room ,adminName :admin},
                        method:"POST",
                        success:function(data){
                            console.log(data);
                            if(data.canSend){
                                sendRoomAcceptance(room);//roomName
                                console.log('roomRequest accepted ' , room);
                            }
                            else{
                                console.log('sorry room is full');
                                let BackPanel = document.getElementById('requestWarnMsgBack');
                                let FrontPanel = document.getElementById('requestWarnMsgFront');
                                let msg = document.createElement('h2');
                                msg.innerHTML="Room is full" ;
                                msg.style.color = 'red';
                                FrontPanel.appendChild(msg);
                                BackPanel.style.display="block";
                                document.addEventListener('mouseup', function (event){
                                    if(!BackPanel.contains(event.target)){
                                        BackPanel.style.display="none" ;
                                    }
                                });   
                            }
                        },
                        error:function(xhr , status , error){
                            console.log(error);
                        }
                    });
                });
               
            }
            requestContainer.removeChild(requestBlock);
        };
        let deniBtn = document.createElement('button');
        deniBtn.textContent="Decline";
        deniBtn.classList.add("deniBtn");
        deniBtn.onclick=function(){
            console.log("Decline");
            if(type == 'friendRequest'){
                sendUserDeclineFriend(admin);
            }
            if(type=='roomRequest'){
                sendUserDeclineRoom(room);//roomName
            }
            requestContainer.removeChild(requestBlock);
        };
        requestBlock.appendChild(profileLink);
        requestBlock.appendChild(textLabel);
        requestBlock.appendChild(acceptBtn);
        requestBlock.appendChild(deniBtn);
        requestContainer.appendChild(requestBlock);
    }
    function displayRequests(){
        $(function() {
            $.ajax({
                url:'requestServer.php',
                method:'POST',
                dataType:'json',
                success:function(data){
                    if( data.roomRequestSet.profiles.length === 0 && data.friendRequestSet.length === 0){
                        console.log('no requests');
                        let warnPanel = document.createElement('div');
                        let warnMsg = document.createElement('h2');
                        warnMsg.style.color = 'red';
                        warnMsg.textContent ='NO REQUESTES :(';
                        warnPanel.classList.add('warnPanel');
                        warnPanel.appendChild(warnMsg);
                        requestContainer.appendChild(warnPanel);
                    }
                    else{
                            for(let friend in data.friendRequestSet){
                                fRequestText = friend + " wants to be a friend with you " ;
                                path = data.friendRequestSet[friend];
                                requestFactory(friend , fRequestText , path ,'' , 'friendRequest');
                            }
                            for(let admin in data.roomRequestSet.requests){
                                path = data.roomRequestSet.profiles[admin];
                                for (let i = 0 ; i < data.roomRequestSet.requests[admin].length ; i++){
                                    requestText = admin + " invite you to room '" + data.roomRequestSet.requests[admin][i]+"'"  ;  
                                    requestFactory(admin ,requestText  , path , data.roomRequestSet.requests[admin][i] , 'roomRequest');
                                } 
                            }
                    }
               
                    
                },
                error: function(xhr , status , error){
                    console.log(error);
                }
            });
        });
    }
    
    setInterval(function(){
          // displayRequests();
           
        } ,1);
    requestBtn.onclick=function(){
        requestPanel.style.display="block";
        displayRequests();
        document.addEventListener('mouseup', function (event){
            if(!requestPanel.contains(event.target)){
                requestPanel.style.display="none" ;
                requestContainer.innerHTML="";
                  
            }
            if(!requestPanel.contains(event.target) && !requestBtn.contains(event.target)){
                window.location.reload();
            }
        });
    }
   
    
</script>
<?php
   
?>
<!---------------------------------------------------friendZone-------------------------------------------------------------->
<script>
    let friendZone = document.getElementById('friendZone');
    let friendContainer = document.getElementById('friendContainer');
    function friendFactory(friend ,path){
        let friendBlock = document.createElement('div');
        friendBlock.classList.add('friendBlock');
        let friendLabel = document.createElement('label');
        friendLabel.textContent = friend;
        friendLabel.classList.add('userName1');
        
        let link = document.createElement('a');
        link.onclick= function (){
            sendUserProfile(friend);
        }
        link.href = 'profile_show.php';
        let profileImg = document.createElement('img');
        profileImg.classList.add('profileImg');
        profileImg.src = path ;
        link.appendChild(profileImg);
        let friendStatus = document.createElement('div');
        friendBlock.appendChild(link);
        friendBlock.appendChild(friendLabel);
        friendContainer.appendChild(friendBlock);
    }
    function getFriendStatus(friend){
       $(function(){
        $.ajax({
            url:'',
            method:'POST',
            dataType: 'json',
            success: function(data){

            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(errorThrown);
            }
        })
       })
    }
    function getFriendsList(){
        $(function() {
            $.ajax({
                url:'friendServer.php',
                method:'POST',
                dataType:'json',
                success: function(data){
                    console.log(data);
                    if(Object.keys(data).length === 0){
                        console.log('No friends');
                        let warnPanel  = document.createElement('div');
                        warnPanel.classList.add('warningPanel');
                        let warnMsg = document.createElement('h2');
                        warnMsg.innerHTML = "No friends yet &#9888; ";
                        warnMsg.style.color = 'red';
                        warnMsg.style.margin = '30px';
                        warnMsg.style.alignSelf="center";
                        warnPanel.appendChild(warnMsg);
                        friendZone.appendChild(warnPanel);
                    }
                    else{
                        for(let friend in data){
                            friendFactory(friend , data[friend]);
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(errorThrown);
                }
            });
        });
    }
    getFriendsList();
</script>
<!-----------------------------------------------------roomZone-------------------------------------------------------------->
<script>
    function roomFactory(roomName){
        let roomBlock = document.createElement('div');
        roomBlock.classList.add('roomBlock');
        let roomLabel = document.createElement('label');
        roomLabel.textContent = roomName;
        roomBlock.appendChild(roomLabel) ;
        roomBlock.onclick = function(){
            sendRoomName(roomName);
            window.location.assign('chatRoom.php');
        }
        document.getElementById('roomContainer').appendChild(roomBlock);
    }
    function getSubscribedRooms(){
        $(function (){
            $.ajax({
                url:'roomServer.php',
                method:'POST',
                dataType:'json',
                data:{subscribedRooms : ''} ,
                success: function(data){
                    for(let room of data.subscribedRoom){
                        roomFactory(room);
                    }
                    if(data.subscribedRoom.length == 0){
                        let warn = document.createElement('h2');
                        warn.innerHTML = 'you have no subscribed rooms yet &#9888;';
                        warn.style.color = 'red';
                        warn.style.border ='none';
                        document.getElementById('roomZone').appendChild(warn);
                    }
                },
                error:function (jqXHR, textStatus, errorThrown){
                    console.log(errorThrown);
                }
            })
        });
    }
    getSubscribedRooms();
</script>
<!---------------------------------------------------userStatus-------------------------------------------------------------->
<script>//detect if user left
document.onvisibilitychange=function() {
    let c = 0;
    if(document.visibilityState==="hidden"){
        document.cookie="status="+0 ;
        console.log("hidden state : "+document.cookie);
        window.location.reload();
    }
    if(document.visibilityState==="visible"){
        document.cookie="status="+1 ;
        console.log("visibility state : "+document.cookie);
        window.location.reload();
    }
};
function clearCookies(){
        var cookies = document.cookie.split(";");
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i];
            var eqPos = cookie.indexOf("=");
            var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
            document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
        }
    }
</script>
<?php // record user status
    if(isset($_COOKIE['status'])){
        $status = $_COOKIE['status'];
        $DB->setUserStatus($_SESSION['userName'],$status);
?>
<script>
        clearCookies();
        console.log("after deletionist : "+document.cookie);
</script>
<?php
    }
?>


<!---------------------------------------------------buttonSection-------------------------------------------------------------->

<script>//buttons section
    let myButtons =[];
    let addButton = document.createElement('button');
    addButton.classList.add('roomButton');
    addButton.textContent="+";
    //myButtons.push(addButton);
    document.getElementById("buttonScreen").appendChild(addButton);
    addButton.onclick=function(){
        document.getElementById('roomFormPopup').style.display="block";
        console.log("hello");
    }
    let closeButton = document.getElementById('closeButton');
    closeButton.onclick=function(){
        document.getElementById('roomFormPopup').style.display="none";
    }
    let roomNameMsg = document.getElementById('roomNameMsg');
    let capacityMsg = document.getElementById('capacityMsg');
    //let keyMsg = document.getElementById("keyMsg");
    let roomNameText = document.getElementById("roomNameText");
    let capacityText = document.getElementById("capacityText");
    //let keyText = document.getElementById("keyText");
    let confirmationButton = document.getElementById('roomButtonConfirmation');
    confirmationButton.addEventListener("click", function(event){
        event.preventDefault()
    });
    confirmationButton.onclick=function(){
        var itsOk =true;
        if(!roomNameText.value.match(/^[a-zA-Z]+\s*[a-zA-Z0-9]*/m)){
            if(roomNameText.value ==''){roomNameMsg.textContent="Room Name cannot be  Blank";}
            else{roomNameMsg.textContent="Please Enter a valid Room Name";} 
            roomNameMsg.style.display="block";
            itsOk=false;
        }
        if(!capacityText.value.match(/[0-9]+/g)|| capacityText.value  <= 0){
            if(capacityText.value ==''){capacityMsg.textContent="Capacity cannot be Blank";}
            else {capacityMsg.textContent="Please Enter a valid Capacity";}
            capacityMsg.style.display="block";
            itsOk=false;
        }
       /* if(!keyText.value.match(/[a-zA-Z0-9]+/g)){
            if(keyText.value ==''){keyMsg.textContent="key cannot be Blank";}
            else {keyMsg.textContent="Please Enter a valid Key";}
            keyMsg.style.display="block";
            itsOk=false;
        }*/
        if(itsOk){
            console.log("ok");
            document.getElementById("roomFormPopup").style.display="none";
            document.cookie="roomName="+roomNameText.value;
            document.cookie="capacity="+capacityText.value;
            document.cookie="key="+ 0;
            roomNameMsg.style.display="none";roomNameText.textContent="";
            capacityMsg.style.display="none";capacityText.textContent="";
            //keyMsg.style.display="none";keyText.textContent="";
            console.log("cookies before deletion : "+document.cookie );
            window.location.reload();
        }
    }
 
    function createRoomButton(RoomName){
        for(let name of RoomName){
            let button = document.createElement('button');
            button.classList.add('roomButton');
            button.textContent = name;
            myButtons.push(button);
            document.getElementById("buttonScreen").appendChild(button);
            console.log("Room is created");
        }
        clearCookies();
        console.log("cookies After deletion : "+document.cookie );
    }
    function sendRoomName(roomName){
        $(function(){
            $.ajax({
                url:'roomServer.php',
                method:'POST',
                data:{roomNameToSession:roomName},
                success: function(data){
                    console.log(data);
                }
            });
        });
    }
    
    function reviveRoomButton(buttonList){
        for(let button of buttonList){
            button.onclick=function(){ //to do: put room name into session 
                console.log(button.innerText);//go to chat room 
                roomName = button.innerText;
                sendRoomName(roomName);
                window.location.assign('chatRoom.php');
            }
        }
    }

</script>
<?php
    if(isset($_COOKIE['roomName'])&&isset($_COOKIE['key'])&&isset($_COOKIE['capacity'])){//porblem : creating room for ever
        $DB->makeRoom($_COOKIE['roomName'],$_COOKIE['key'],$_SESSION['userName'],$_COOKIE['capacity']);
        //echo "<h1 style='position:fixed;top:30%;right:0px;color:rgb(210 , 224 , 224);'>".$DB->numberOFRooms($_SESSION['userName'])."<h1>";
    }
    $roomName= $DB->getRoomsNameList($_SESSION['userName']);//its an array of rooms name

?>
<script>//creating & reading  room section
            let roomNameList = <?php echo json_encode($roomName); ?>;
            if(roomNameList!="null"){
                createRoomButton(roomNameList);
                reviveRoomButton(myButtons);
 
            }
</script>
<!--------------------------------------------------------searchEngine---------------------------------------------------------------------------->
<?php // search engine section
    $nameSet = $DB->getNameSet($_SESSION['userName']);
    $profile =[];
    for($i=0;$i<count($nameSet);$i++){
        $profile[$nameSet[$i]] = $sql->getUserProfileImage($nameSet[$i]);
    }
?>
            <!-----------------
                    //get user Status 
                           /*let status = document.createElement("div");
                status.classList.add("");
                document.cookie = "otherUsersName="+name;
                let userStatus = <?php //json_encode($DB->getUserStatus($_COOKIE['otherUsersName']));?>
                console.log(name + " "+userStatus);
                */
            ----------------->
<script>//search engine section
    let nameSet = <?php echo json_encode($nameSet); ?>;
    let profilePathSet = <?php echo json_encode($profile); ?>;console.log(profilePathSet);
    let searchButton = document.getElementById("searchButton");
    let searchBox = document.getElementById("searchBox");
    let resultPanel = document.getElementById("searchResult");
    searchButton.onclick= function(){
        resultPanel.textContent="";
        console.log("here i am");
        function search(text,nameSet){//TODO : use binary search algorithm and search for the first character of the name
            let showableResults =[];
            if(text.length >0){
                for(let name of nameSet){
                    if(name.includes(text)){
                        showableResults.push(name);
                        console.log(showableResults);
                    }
                }
            }
            return showableResults;
        }
        if(search(searchBox.value ,nameSet).length>0){
            for(let name of search(searchBox.value ,nameSet)){
                let person = document.createElement("div");
                person.classList.add("person");
                let userName = document.createElement("label");
                //name=name.charAt(0).toUpperCase()+name.slice(1);console.log(name);
                userName.textContent=name;
                userName.classList.add("userName1");
                let profileImg = document.createElement("img");
                let link = document.createElement("a");
                //add path of the image from the profile ;
                profileImg.src =profilePathSet[name];
                profileImg.classList.add("profileImg");
                link.href = "profile_show.php";
                link.appendChild(profileImg);
                link.onclick=function(){
                    //ajax request
                    sendUserProfile(name);
                }
                person.appendChild(link);
                //add status for specific person
             
                person.appendChild(userName);
                resultPanel.appendChild(person);
            }
            resultPanel.style.display="block";
        }
        else{
            let notFound = document.createElement("div");
            notFound.classList.add("notFound");
            notFound.textContent="NO RESULTS";
            resultPanel.appendChild(notFound);
            resultPanel.style.display="block";
        }
        document.addEventListener('mouseup', function (event){
            if(!resultPanel.contains(event.target)){
                resultPanel.style.display="none" ;
            }
        });
        
    }
    document.addEventListener('mousemove', function (event){
        if(resultPanel.contains(event.target)){
            window.addEventListener('keydown' , function (event) { // press enter to get results
                    if(event.keyCode == 'Enter'){
                        //todo : call search function
                    }
             });
        }
    });

</script>
<?php
    if(isset($_POST['userProfile'])){
        $_SESSION['userProfile'] = $_POST['userProfile'];
    }
?>

<!------------------------------------------------------------------------------------------------------------------------------------>


<!------------------------------------------------------------------------------------------------------------------------------------>
<script>//chatServer
   /* var conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function(e) {
        console.log("Connection established!");
    };
    conn.onmessage = function(e) {
        console.log(e.data);
    };*/
</script>


<script>
// test here :
</script>