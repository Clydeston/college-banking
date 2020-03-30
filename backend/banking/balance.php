<?php 

    include_once "../autoload.php";   

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_SESSION["user_id"])){
        $bank = new Banking();
        $usr = new User();
        $usr->id = $_SESSION["user_id"];
        $usr->id = $_SESSION["balance"];
        $balance = $bank->checkBalance($_SESSION["user_id"]);
        $account_balances = $bank->getAccountBalances($_SESSION["user_id"]);

        $user_balance_check = $bank->validateUserBalance($usr);        
        if($user_balance_check != null) {
            echo $user_balance_check . ";";            
        }else {
            echo $balance["balance"] . ";";
        }        
        foreach($account_balances as $account) {            
            echo $account["id"] . ":" . $account["balance"] . "|";            
        }
        
    }

?>