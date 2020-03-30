<?php 

    include_once "../../autoload.php";

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_SESSION["user_id"])){
        $error = false;
        $bank = new Banking();    
        
        $accounts = $bank->getAccounts($_SESSION["user_id"]);        
        echo json_encode($accounts);        
    }

?>