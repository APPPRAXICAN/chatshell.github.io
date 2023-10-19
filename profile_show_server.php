<?php
session_start();
if(isset( $_SESSION['roomIsFull'])){
    echo json_encode($_SESSION['roomIsFull']);
    $_SESSION['roomIsFull'] = false;
}