<?php
session_start();
require_once('databaseHandler.php'); 
$_POST['sginResponse'] =[]; 
$isOk =false ; 
$DB= new databaseHandler; 
if(isset($_POST['username'])){
    if($DB->isUserAlreadyExists($_POST['username'])){
        $_POST['sginResponse']['nameFailure'] = "Warning : username already exists";
    }
}
         
if(isset($_POST['password']) && isset($_POST['gender']) && 
isset($_POST['age']) && isset($_POST['username']) && isset($_POST['confirmPassword'])){
    if(!$DB->isUserAlreadyExists($_POST['username'])){
        include('profileImageHandler.php');
        $img_obj = new Image(200,200,strtoupper($_POST['username'][0]));
        $DB->createNewUser($_POST['username'] , $_POST['password'] ,$img_obj->getPath(),$_POST['gender'],$_POST['age']);
        $_SESSION['userName'] = $_POST['username'] ;
        $_POST['sginResponse']['success'] = true; 
    }
}
if(isset($_POST['sginResponse'])){
    echo json_encode($_POST['sginResponse']);
}