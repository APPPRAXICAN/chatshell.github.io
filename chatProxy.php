<?php
    
    session_start();
    $_POST['first'] = 4 ;
    print_r($_SESSION);
    echo "<br>" ; 
    print_r($_POST);
    require('databaseHandler.php');
    $DB= new \databaseHandler();
    if(isset($_SESSION['connectionID'])){
        echo "Connection established";
        $DB->setConnectionID($_SESSION['userName'] ,$_SESSION['connectionID'] );
    }

