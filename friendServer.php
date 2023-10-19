<?php
    session_start();
    require_once ('databaseHandler.php');
    $DB = new databaseHandler();
   if(isset($_SESSION['userName'])){
     $_POST['friendList']= $DB->getFriendList($_SESSION['userName']) ;
   }
    // $_POST['friendList']= $DB->getFriendList('jhon') ;
    if(isset($_POST['friendList'])){
        echo json_encode($_POST['friendList']);
    }
?>