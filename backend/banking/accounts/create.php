<?php 
    
    include_once "../../autoload.php";
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }     

    if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_SESSION["user_id"])) {     
        $account_type = $_POST["account_type"];
    
        $error = false;
        $bank = new Banking();

        if(empty($account_type)) {
            $error = true;
            echo "Please ensure all fields are populated!";
        }    

        if(!is_numeric($account_type) && !$error) {
            $error = true;
            echo "Please enter a valid account type!";
        }

        if($account_type != 2 && $account_type != 3 && !$error) {
            $error = true;
            echo "Please enter a valid account type!";
        }
    
        if($error) {
            http_response_code(400);
        }else {
            http_response_code(200);            

            $bank->createAccount($_SESSION["user_id"], $account_type);
            echo "Account creation successful!";
        }
    }
    
?>