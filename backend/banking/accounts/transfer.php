<?php 
    
    include_once "../../autoload.php";
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }     

    if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_SESSION["user_id"])) {     
        $account_id = $_POST["account_id"];
        $account_deposit_to_id = $_POST["account_deposit_id"];
        $deposit_amount = $_POST["transfer_amount"];
    
        $error = false;
        $bank = new Banking();

        if(empty($account_id) || empty($account_id) || empty($account_id))  {
            $error = true;
            echo "Please ensure all fields are populated!";
        }    

        if(!is_numeric($account_id) && !$error) {
            $error = true;
            echo "Please enter a valid account to withdraw from!";
        }

        if(!is_numeric($account_deposit_to_id) && !$error) {
            $error = true;
            echo "Please enter a valid account to deposit to!";
        }
        

        if(empty($bank->accountExists($account_id)) && !$error) {
            $error = true;
            echo "Please enter a valid account to withdraw from!";
        }

        if(empty($bank->accountExists($account_deposit_to_id)) && !$error) {
            $error = true;
            echo "Please enter a valid account to deposit to!";
        }

        if(!is_numeric($deposit_amount) && !$error) {
            $error = true;
            echo "Please enter a valid amount to deposit!";
        }

        if(($_SESSION["balance"] - $deposit_amount) < 0 && !$error) {
            $error = true;
            echo "Insufficient balance!";
        }
        
        if(($bank->getAccountBalance($account_id) - $deposit_amount) < 0 && !$error) {
            $error = true;
            echo "Insufficient balance!";
        }

        if(!Banking::moneyValid($deposit_amount) && !$error) {
            echo "Please provide a valid amount to deposit!";
            $error = true;
        }
    
        if($error) {
            http_response_code(400);
        }else {
            http_response_code(200);            

            $bank->transferAccountBalance($account_id, $account_deposit_to_id, $deposit_amount);
            echo "Account transfer successful!";
        }
    }
    
?>