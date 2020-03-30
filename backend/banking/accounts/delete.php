<?php 
    
    include_once "../../autoload.php";
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }     

    if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_SESSION["user_id"])) {     
        $account_id = $_POST["account_id"];
    
        $error = false;
        $bank = new Banking();

        if(empty($account_id)) {
            $error = true;
            echo "Please ensure all fields are populated!";
        }    

        if(!is_numeric($account_id) && !$error) {
            $error = true;
            echo "Please enter a valid account!";
        }

        if(empty($bank->accountExists($account_id)) && !$error) {
            $error = true;
            echo "Please enter a valid account!";
        }

        if($bank->getAccountType($account_id) == 1 && !$error) {
            $error = true;            
            echo "Cannot delete current account!";
        }
    
        if($error) {
            http_response_code(400);
        }else {
            http_response_code(200);            

            $bank->deleteAccount($_SESSION["user_id"], $account_id);
            echo "Account deletion successful!";
        }
    }
    
?>