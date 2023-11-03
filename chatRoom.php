 
<?php include('databaseHandler.php');
$DB = new databaseHandler();
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatshell/Chat</title>
</head>
<body>
    <style>
         * ::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Edge, Opera */
        }
        *{
            box-sizing: border-box;
        }

         * {
            -ms-overflow-style: none; /* IE and Edge */
            scrollbar-width: none; /* Firefox */
        }
        body{
            display: flex;
            align-items: stretch;
            gap:30px;
            /*justify-content: centr;*/ 
            margin:0px;
            padding:0px;
            background-color: /*rgb(27,27,27)*/ rgb(27,43,43);
        }
        div.roomInfo{
            background-color: rgb(80,127,128) ; 
            display: flex;
            flex-direction: column;
            gap:10px;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            width: 324px;
            height: 100vh;    
        }
        div.roomInfo button{
            background-color: rgb(27,43,43);
            padding : 10px;
            font-size: larger;
            color:rgb(210 , 224 , 224);
        }
        div.roomInfo button:hover{
            box-shadow: 1px 1px 30px 5px rgb(27,43,43);
        }
        .imgPanel{
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: /*rgb(27,27,27)*/ rgb(27,43,43);
            padding:60px;
            border-radius: 0 0 10% 10%;
            height: 230px;
        }
        .imgPanel a{
            position :absolute;
            bottom:10px;
        }
        .imgPanel img{
            border-radius: 50%;
            width:100px;
        }
        div.info{
            background-color: rgb(27,43,43);
            display: flex;
            flex-direction: column;
            flex-wrap:wrap ;
            justify-content: space-between;
            align-items: center;
            padding:10px;
            overflow: auto;
        }
        div.info h2{
            text-align: center;
            color: rgb(210 , 224 , 224);
            border-bottom: 2px solid rgb(80,127,128);
        }
        div.grandPanel{
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: normal;
            width:1085px;
            background-color:rgb(27,43,43);

        }
        div.header{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            background-color:rgb(27,43,43);
        }
        div.header h1{
            text-align: center;
            color:rgb(210 , 224 , 224);
        }
        div.chatScreen{
            /* margin-top: 20px;
            margin-left:50px;
            width:91%;*/
            height: 641px;
            background-color: lightsteelblue ; 
            border-radius: 2%;
            overflow: auto;
            padding-top: 50px;
        }
        div.typingPanel{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color:rgb(27,43,43);
            padding:10px;
        }
        div.typingPanel textarea{
            background-color:lightsteelblue;
            border: none;
            font-size: x-large;
            max-width: 80%;
            min-width: 80%;
            max-height: 40px;
            min-height: 40px;
        }
        button.submitBtn {
            border: none;
            border-radius: 0%;
            background-color: rgb(80,127,128);
            cursor: pointer;
        }
        button.submitBtn img {
                width:34px;
        }
        div.subscriberBlock{
            display: flex;
            border-top: 1px solid rgb(210 , 224 , 224);
            padding:3px;
            width:250px;
        }
        div.subscriberBlock img{
            width: 60px;
            border-radius: 50%;
            margin-left: 5px;
        }
        div.subscriberBlock label{
            font-size: larger;
            color:white;
            align-self:center;
            margin-left: 20px;
        }
        div.subscriberBlock button {
            background-color:darkred;
            border:none;
            padding:0px;
            margin-left: 90px;
            margin-top: 20px;
            width:auto;
            height: 30px;
            font-size: small;
            border-radius: 10%;
            cursor: pointer;
        }
        div.subscriberBlock button:hover{
            box-shadow: none;
            background-color: red;
        }
        div.container{
            height: auto;
            max-height: 400px;
            background-color:rgb(27,43,43);
            overflow: auto;
            margin-bottom:5px;
            margin-top: -20px;
        }
        div.container h2 {
            text-align: center;
            border:none;
        }
        div.informationPanel{
            display: flex;
            flex-direction: column;
            padding: 10px;
            background-color: rgb(27,43,43);
            width:80%;
        }
        div.informationPanel h3{
            margin-left: 10px;
            color:rgb(210 , 224 , 224);
        }
        div.msgContainer{
            padding:15px;
            margin-top:auto;
            display:block;
            overflow: hidden;
        }
        div.MyBubbleMsg{
            padding:10px;
            margin:0px;
            background-color:/*rgb(27,43,43)*/ rgb(80,127,128) ;
            border-radius: 10%; 
           /* margin-right: 825px;*/
           float :left;
        }
        div.MyBubbleMsg label {
            font-size: larger;
            color:orchid;
            display: block;
            margin-left:60px;
            margin-top:-37px;
        }
        div.MyBubbleMsg a{
            display: block;
        }
        div.MyBubbleMsg img  {
            width:50px;
            border-radius: 50%;
        }
        div.MyBubbleMsg h3{
            text-align: left;
            color :rgb(210 , 224 , 224);
            white-space: pre-wrap;
            display: block;
            margin-left:10px;
            margin-top: 25px;
            
        }
        div.otherBubbleMsg{
            padding:10px;
            margin:0px;
            background-color:rgb(27,43,43) ;
            border-radius: 10%; 
           /* margin-left: 825px;*/
           float :right !important;
        }
        div.otherBubbleMsg label {
            font-size: larger;
            color:orchid;
            display: block;
            margin-left:60px;
            margin-top:-37px;
        }
        div.otherBubbleMsg a{
            display: block;
        }
        div.otherBubbleMsg img  {
            width:50px;
            border-radius: 50%;
        }
        div.otherBubbleMsg h3{
            text-align: left;
            color :rgb(210 , 224 , 224);
            white-space: pre-wrap;
            display: block;
            margin-left:10px;
            margin-top: 25px;
        }

    </style>
    <div class="roomInfo">
        <div class="imgPanel">
            <a href="profileEdit.php">
                <img src="<?php echo $DB->getUserProfileImage($_SESSION['userName'])?>">
            </a>
        </div>
        <div class="info" id="infoPanel">
            <h2>Members</h2>
            <div class="container" id="memberContainer"></div>
        </div>
        <div class="informationPanel">
            <h3 id="capacity">Capacity : </h3>
            <h3 id="numOfMembers">Members : </h3>
            <h3 id="freePlaces">Free Places : </h3>
        </div>
        <button id="leaveBtn">Leave</button>
    </div>
    <div class="grandPanel">
            <div class ="header">
                    <h1 class="roomName"><?php echo $_SESSION['roomName']?></h1>
            </div>
            <div class="chatScreen" id ="chatScreen">
                        <!--creating div's from js -->
          
                        
            </div>
            <div class="typingPanel">
                <textarea class="typeingBox" id="typeingBox"></textarea>
                <button class="submitBtn" id="submitBtn"><img src="send-mail.png" ></button>
            </div>
    </div>
</body>
</html>
<?php
$DB->setConnectionID($_SESSION['userName'] , md5(uniqid())) ;
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    red= Math.floor(Math.random() * (255 - 0 + 1)) + 0 ;
    green = Math.floor(Math.random() * (255 - 0 + 1)) + 0 ;
    blue =  Math.floor(Math.random() * (255 - 0 + 1)) + 0 ;
    let color = [red , green , blue];

    let userName = <?php echo json_encode($_SESSION['userName']) ; ?> ; 
    let admin  = <?php echo json_encode($DB->getUserNameByID($DB->getAdminIDOfRoom($_SESSION['roomName'])));?>;
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

    function kickUser (name){
        $(function(){
            $.ajax({
                url:'chatRoomServer.php',
                method:'POST',
                data:{kickedMember : name},
                success:function(data){
                    console.log(data);
                }
            });
        });
    }

    function subscriberFactory(name, path){
            let subBlock = document.createElement('div');
            subBlock.classList.add('subscriberBlock');
            let memberName  = document.createElement('label');
            memberName.textContent = name;
            let link = document.createElement('a');
            link.href = 'profile_show.php';
            let profileImg = document.createElement('img');
            /*if(is_array(path)){
                userName.textContent += ' (Admin)' ;
                profileImg.src = path[0];
            }
            else{*/
                profileImg.src = path;
            //}
            link.onclick=function(){
                sendUserProfile(name);
            }
            
            link.appendChild(profileImg);
            subBlock.appendChild(link);
            subBlock.appendChild(memberName);
            if(userName == admin ){
                let kickBtn = document.createElement('button');
                kickBtn.textContent= 'kick';
                kickBtn.onclick=function(){
                    kickUser(name);
                    window.location.reload();
                };
             subBlock.appendChild(kickBtn);   
            }
            document.getElementById('memberContainer').appendChild(subBlock);
            let status = document.createElement('div');
    }
   // let infoPanel = ;
    function subscribers_Work(){ 
            $(function(){
            $.ajax({
                url:'chatRoomServer.php',
                method:'POST',
                data:{subscribers : ''},
                dataType:'json',
                success: function(data){
                       console.log(data.memberList);
                       if(Object.keys(data.memberList).length > 0){
                            for(let name in data.memberList){
                            subscriberFactory(name , data.memberList[name] );
                            //console.log(name);
                        }
                       }
                       else{
                            let warn = document.createElement('h2') ; 
                            warn.style.color=  "red";
                            warn.textContent = "No Members Yet !" ;
                            document.getElementById('memberContainer').appendChild(warn);
                       }
                       
                },
                error : function(jqXHR, textStatus, errorThrown){
                    console.log(errorThrown);
                }
            });
        }); 
   }
   subscribers_Work();

   let capacity=document.getElementById('capacity');
   let members=  document.getElementById('numOfMembers');
   let free = document.getElementById('freePlaces');

   function getRoomInfo(){
    $(function() {
        $.ajax({
            url:'chatRoomServer.php',
            method:'POST',
            dataType:'json',
            data:{roomInformation : ''},
            success: function(data){
                //console.log(data.roomInformation);
                capacity.textContent += data.roomInformation[0];
                members.textContent += data.roomInformation[1];
                free.textContent += data.roomInformation[2]; 
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(errorThrown);
            }     
        });
    });
   }
    getRoomInfo();

   let leaveBtn = document.getElementById('leaveBtn');
   function sendLeaveAction(){
    $(function (){
        $.ajax({
            url:'chatRoomServer.php',
            method:'POST',
            data:{leaveType : 1 },
            success:function(data){
                window.location.assign('roomsPanel.php');
                //console.log(data);
            }
        });
    });
   }
   
   leaveBtn.onclick= function(){
        sendLeaveAction();
        console.log('hay');
   };
    $('#form').on('submit',function(event){
    event.preventDefault(); //this will avoid web page from reloading
    });


    var conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function(e) {
        console.log("Connection established!");
    };


    function msgFactory( senderName , msg , path , type , color ){
        let screen  = document.getElementById('chatScreen');
        let container = document.createElement('div');
        container.classList.add("msgContainer");
        let msgBlock = document.createElement('div');
        if(type == "other"){
            msgBlock.classList.add("otherBubbleMsg");
           /* msgBlockStyle = window.getComputedStyle(msgBlock);
            if(msgBlockStyle.getPropertyValue())*/
        }
        else{
            msgBlock.classList.add("MyBubbleMsg"); 
        }
        let msgText = document.createElement('h3');
        msgText.textContent = msg ; 
        let userTitle  = document.createElement('label');
        userTitle.textContent = senderName ;
        userTitle.style.color = "rgb("+String(color[0])+","+String(color[1])+","+String(color[2])+")";
        let link = document.createElement('a');
        link.onclick=function(){
            sendUserProfile(senderName);
        };
        link.href="profile_show.php";
        let profileImg = document.createElement('img');
        profileImg.src=path ; 
        link.appendChild(profileImg);
        msgBlock.appendChild(link);
        msgBlock.appendChild(userTitle);
        msgBlock.appendChild(msgText);
        container.appendChild(msgBlock);   
        screen.appendChild(container);
        screen.scrollTop = screen.scrollHeight;
    }

    function displayOldData(){
        $(function(){
            $.ajax(
                {
                    url: 'chatRoomServer.php',
                    method: 'POST',
                    dataType: 'json',
                    success:function(data){// userName , profile , msg
                        console.log('length',data.msgSet.length);
                        if(data.msgSet.length >0){
                            for(var i = 0; i < data.msgSet.length ; i++){
                                if(userName == data.msgSet[i][0]){
                                msgFactory('ME' , data.msgSet[i][2] , data.msgSet[i][1] , 'me' , color) ;
                                }else{
                                    msgFactory(data.msgSet[i][0] , data.msgSet[i][2] , data.msgSet[i][1] , 'other' , color) ;
                                }
                            }
                        }
                    }
                }
            );
        });
    }
    displayOldData();

    function sendMsg(){
        let memberListForMsg = <?php echo json_encode($DB->getSubscribersList($_SESSION['roomName'] , $_SESSION['userName'])) ;?>;
        let username = <?php echo json_encode($_SESSION['userName']) ; ?> ; 
        let idSet = <?php echo json_encode($DB->getConnectionIdSet($_SESSION['roomName']));?>;
        let sendBtn= document.getElementById('submitBtn');
        let textBox  = document.getElementById('typeingBox');
        sendBtn.onclick = function(){
            if(textBox.value == ""){
                return ; 
            }
            let cypherMsg = "";
            $(function(){
                $.ajax({
                url:'chatRoomServer.php' ,
                method: 'POST',
                dataType : 'json',
                data : {sender:username , msg : textBox.value},
                success:function(data){
                    console.log('success');
                    cypherMsg = data.cypherMsg; 
                } ,
                error:function(jhx , status , error){
                    console.log('error');
                }
            });
            });

            for(let name in memberListForMsg){
                for(let id of idSet){
                    $(function(){
                    $.ajax(
                        {
                            url:"chatRoomServer.php",
                            method:'POST',
                            dataType:'json',
                            //any value sent to server will duplicated 
                            data :{memberName : name},
                            success:function(data){ //console.log('id : ', id , 'data.id : ' , data.id);
                                if(id == data.id){
                                    console.log(memberListForMsg);
                                    let dataObj = {
                                        sender : username ,
                                        //msg : textBox.value ,
                                        msg :cypherMsg ,
                                        room : <?php echo json_encode($_SESSION['roomName']);?> ,
                                        path : <?php echo json_encode($DB->getUserProfileImage($_SESSION['userName']));?>
                                    };
                                    conn.send(JSON.stringify(dataObj));console.log('sent : ' , data);console.log('dataObj : ' , dataObj);
                                    msgFactory('me' , textBox.value , <?php echo json_encode($DB->getUserProfileImage($_SESSION['userName']));?> , 'me' , color);
                                    textBox.value="";
                                    return;
                                }
                            },
                            error : function (xhr , status , error){
                                console.log(error);
                            }

                        }
                    );
                });
                //can do nothing here
                }
                return;
            }
           
        
          
        };
    }
    sendMsg();

   
    
    conn.onmessage = function(e) {
        //console.log(e.data);
        let memberListForMsg = <?php echo json_encode($DB->getSubscribersList($_SESSION['roomName'] , $_SESSION['userName'])) ;?>;
        let username = <?php echo json_encode($_SESSION['userName']) ; ?> ; 
        let idSet = <?php echo json_encode($DB->getConnectionIdSet($_SESSION['roomName']));?>;
        let screen = document.getElementById('chatScreen');
        let currentRoom = <?php echo json_encode($_SESSION['roomName']) ;?>;
       // let dataObj = JSON.parse(e.data);
        
       // memberListForMsg[username] = <?php //echo json_encode($DB->getUserProfileImage($_SESSION['userName']));?>;
        //console.log("members : ",memberListForMsg);
        //console.log("idset : " ,idSet );
        for(let name in memberListForMsg){
              
            for(let id of idSet){
                      
                $(function(){
                    dataObj = JSON.parse(e.data);
                    console.log(e.data);//whach it 
                    $.ajax(
                        {
                            url:"chatRoomServer.php",
                            method:'POST',
                            dataType:'json',
                            data : {memberName : name , cypherMsg:dataObj.msg},
                            success:function(data){
                                //console.log(data);
                                console.log( "name : ", name , " usrID : " , data.id);
                                console.log("id : ",id);
                                if(id == data.id && currentRoom == dataObj.room ){
                                    console.log('msg Sent 1111 : ' , data );
                                    msgFactory(dataObj.sender ,data.plainMsg ,dataObj.path ,'other' , color);
                                }
                            },
                            error:function(xhr , status, errors){
                                console.log(errors);
                            }
                        }
                    );
                });
                

            }
            return;
        }
    };

</script>
<?php
    if(isset($_POST['userProfile'])){
        $_SESSION['userProfile'] = $_POST['userProfile'];
    }
?>