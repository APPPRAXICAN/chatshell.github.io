<?php

    session_start();
    require_once ('databaseHandler.php');
    $DB = new databaseHandler();
    $requests = ['friendRequestSet' => $DB->getFriendRequestSet($_SESSION['userName']) ,'roomRequestSet' => $DB->getRoomRequestSet($_SESSION['userName'])];
    /*if(count($DB->getFriendRequestSet($_SESSION['userName']))  > 0){
        $requests['friendRequestSet'] = $DB->getFriendRequestSet($_SESSION['userName']) ;
    }
    if(count($DB->getRoomRequestSet($_SESSION['userName']) )>0){
        $requests['roomRequestSet'] = $DB->getRoomRequestSet($_SESSION['userName']);
    }*/
    

    $_POST['requests']=$requests ; 
    if(isset($_POST['requests'])){
        echo json_encode($_POST['requests']);
    }
    if(isset($_POST['isFriendRequestAccepted']) && $_POST['isFriendRequestAccepted']){
        if(isset($_POST['friendName'])){
            $DB->makeFriend($_POST['friendName'] , $_SESSION['userName']);
            $DB->deleteOldFriendRequest($_POST['friendName'] , $_SESSION['userName']);
        }
    }
    if(isset($_POST['isFriendRequestAccepted']) && $_POST['isFriendRequestAccepted']==0){
        if(isset($_POST['friendName'])){
            $DB->deleteOldFriendRequest($_POST['friendName'] , $_SESSION['userName']);
        }
    }
    if(isset($_POST['isRoomRequestAccepted']) && $_POST['isRoomRequestAccepted']){
        if(isset($_POST['roomName'])){
            //echo $_POST['roomName'];
            $DB->addUserToRoom($_SESSION['userName'] , $_POST['roomName']);
            $DB->deleteOldRoomRequest($_POST['roomName'] , $_SESSION['userName']);
        }
    }
    if(isset($_POST['isRoomRequestAccepted']) && $_POST['isRoomRequestAccepted'] == 0){
        if(isset($_POST['roomName'])){
            $DB->deleteOldRoomRequest($_POST['roomName'] , $_SESSION['userName']);
        }
    }   
?>