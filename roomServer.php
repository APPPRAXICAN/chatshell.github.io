<?php
session_start();
require_once('databaseHandler.php');
$DB = new databaseHandler();
$data  ;
//print_r($_POST);
    if(isset($_POST['roomName']) && $_POST['adminName']){
        $freePalces = $DB->getNumberOfFreePlaces($_POST['roomName'],$_POST['adminName']);
        if($freePalces > 0){
            $data['canSend']=true ;
        }
    }
    if(isset($_POST['roomNameToSession'])){
        //echo "hello : ".$_POST['roomNameToSession'];
        $_SESSION['roomName'] = $_POST['roomNameToSession'];
    }
    $_POST['subscribedRoom'] =$DB->getSubscribedRooms($_SESSION['userName']);
    if(isset($_POST['subscribedRoom'])){
        $data['subscribedRoom'] =$_POST['subscribedRoom'];
    }
    echo json_encode($data);

?>