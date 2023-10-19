<?php
    session_start();
    require_once('databaseHandler.php');
    require_once('Encryption.php');
    $DB = new databaseHandler();
    $encryptor= new Encryptor();
    $list = $DB->getSubscribersList($_SESSION['roomName'] , $_SESSION['userName']);
    $capacity = $DB->getRoomCapacity($_SESSION['roomName'] ,$DB->getUserNameByID($DB->getAdminIDOfRoom($_SESSION['roomName'])));
    $freePlaces = $DB->getNumberOfFreePlaces($_SESSION['roomName'] ,$DB->getUserNameByID($DB->getAdminIDOfRoom($_SESSION['roomName'])) ) ; 
    $numOfMembers= count($list)+1;
    $msgSet = $DB->getMsgSet($_SESSION['roomName']);
    //print_r($list);
   /* for ($i=0; $i<count($msgSet); $i++){
        $msgSet[$i][2] = $encryptor->decrypt($msgSet[$i][2]);
    }*/
    //var_dump($msgSet);
    //echo 'capacity = '.$capacity."  freePlaces = ".$freePlaces."   members =  ".$numOfMembers ;
    //$_POST['roomInformation'] = [$capacity  , $freePlaces  , $numOfMembers] ;
    $id = 0 ;
    if(isset($_POST['memberName'])){
        $id= $DB->getConnectionID($_SESSION['userName']);
        unset($_POST['memberName']);
    }
    $_POST['chatRoomData']= ['memberList' => $list , 'roomInformation' => [$capacity   , $numOfMembers , $freePlaces ]  , 'id' => $id  , 'msgSet' => $msgSet ] ; 
    if(isset($_POST['msg'])){
        $cypherMsg = $_POST['msg'] ; //$encryptor->encrypt($_POST['msg']);
        $_POST['chatRoomData']['cypherMsg'] = $cypherMsg ;
    }
    if(isset($_POST['cypherMsg'])){
        $_POST['chatRoomData']['plainMsg'] = $_POST['cypherMsg'];//$encryptor->decrypt($_POST['cypherMsg']);
    }
    if(isset($_POST['chatRoomData'])){
        echo json_encode($_POST['chatRoomData']) ;
    }
    if(isset($_POST['leaveType'])){
      if($_POST['leaveType'] == 1){
            if($DB->getUserNameByID($DB->getAdminIDOfRoom($_SESSION['roomName'])) == $_SESSION['userName'] ){
                $DB->AdminRemoveRoom($_SESSION['userName'] , $_SESSION['roomName']);
            }
            else{
                $DB->removeUserFromRoom($_SESSION['userName'] , $_SESSION['roomName']);
            }
      }
    }
    if(isset($_POST['kickedMember'])){
        $DB->removeUserFromRoom($_POST['kickedMember'] , $_SESSION['roomName']);
    }
    if(isset($_POST['msg']) && $_POST['sender']){
    //    $DB->msgCapture($_POST['msg'], $_POST['sender'],$_SESSION['roomName']) ;
        $DB->msgCapture($cypherMsg, $_POST['sender'],$_SESSION['roomName']) ;
        
    }
    


