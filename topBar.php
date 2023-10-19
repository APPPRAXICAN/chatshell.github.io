<?php session_start(); include('databaseHandler.php');
$DB = new databaseHandler();?>
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
        background-color: rgb(27,27,27);
        margin : 0px; 
       /* border-left: 3px  solid yellow;
        border-right:3px solid yellow;*/
    }
    ul.topPanel{
        position: fixed;
        list-style-type:none;
        padding :0 ;
        margin :0;
        overflow: hidden;
        width:100%;
        border-bottom: 3px solid orangered;
        border-left: 3px solid orangered;
        border-right: 3px solid orangered;
        background-color: orangered;

    }
    li{
        float:left;
    }
    li *{
        display:block;
        padding:15px;
        text-align: center;
        color: white;
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
        background-color: darkorange;
        color : rgb(27,27,27);
    }
    button.roomButton{
        text-align: center;
        padding : 30px;
        width:250px;
        margin: 50px;
        background-color: orangered;
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
        border: 1px solid red;
        background-color: rgb(27,27,27,0.3);
        z-index: -1;
        background-color: orangered;
    }
    .header1{
        border-bottom:1.5px solid orangered;
        color :orangered;
        text-align: center;
        padding:3px;
    }
    .roomFormPopup{
        display: none;
        background-color:rgb(27,27,27,0.8);
        width:100vw;
        height:100vh;
        z-index: 99;
        
    }
    .roomForm{
        position:absolute;
        left:40%;
        top:35%;
        padding:30px;
        background-color: orange;
    }
    .errMsg{
        display: none;
        color:red;
        margin:3px;
    }
    .closeButton{
        background-color: red;
        color : white;
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
        background-color: cyan;
        color:black;
        padding:10px;
        border:none;
        font-size: larger;
        margin-top:5px;
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
        background-color: rgb(27,27,27);
        overflow: auto;
        margin-top:30px;
        -ms-overflow-style: none;
    }
    div.friendZone{
        background-color: rgb(27,27,27);
        overflow: auto;
        -ms-overflow-style: none;
        margin-top:5px;
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
        color: white;
        border: none;
        position: fixed;
        border-right: 1px solid orange;
    }
    .searchImg{
        width:70px;
        height: 70px;
        position: fixed;
        top:4px;
        right: 435px; 
        
    
    }
    .searchButton{
        background-color: rgb(27,27,27,0.3);
        height:52px;
        width: 60px;
        border: none;
        position: fixed;
        right:443px;
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
        height: 600px;
        background-color:rgb(27,27,27,0.8);
        border: 1px solid orangered;
        z-index: 99;
        overflow: auto;

    }
    div.person{
        border:2px solid orangered;
        font-size: larger;
        color:white;
        padding:10px;
        display:flex;
        /*justify-content: center;*/
    }
    div.notFound{
        text-align: center;
        border:2px solid orangered;
        font-size: larger;
        color : white;
    }
    .profileImg{
        border-radius: 50%;
        width : 15% ;
    }
    .userName1{
        color:white;
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
 </style>



<ul class="topPanel">
        <li><img src="<?php echo $DB->getUserProfileImage($_SESSION['userName']); ?>"class ='img'></li>
        <li><label class="userName" id="userNameLabel" style="margin-left:10px; color:black;"><?php echo $_SESSION['userName']; ?></label></li>
        <li><input type="text" class="searchBox" id="searchBox" placeholder="Search for persons or Rooms"></li>
        <li><button class="searchButton" id="searchButton"><img src="search.png" class="searchImg"></button></li>
        <li><a href ="loginSite.php" class="link">Logout</a></li>
    </ul>
    <div class="searchResult" id="searchResult">

    </div>
      
</body>
</html>