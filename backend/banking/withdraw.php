<?php 
    include_once "../autoload.php"; 
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }        

    if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_SESSION["user_id"])){
        $withdraw_amount = $_POST["withdraw_amount"];
        $withdraw_account = $_POST["withdraw_account"];
        $account_balance;

        $error = false;
        $bank = new Banking();

        if(empty($withdraw_amount) || empty($withdraw_account)){
            echo "Please ensure all fields are populated!";
            $error = true;
        }

        if(!is_numeric($withdraw_account)) {
            echo "Please provide a valid account!";
            $error = true;
        }        

        if(empty($bank->accountExists($withdraw_account))) {
            echo "Please provide a valid account!";
            $error = true;
        }

        if(!is_numeric($withdraw_amount)) {
            echo "Please ensure withdraw amount is a number!";
            $error = true;
        }

        if($withdraw_amount < 0) {
            echo "Please ensure the withdraw amount is a positive number!";
            $error = true;
        }

        if(is_numeric($withdraw_amount) && !$error) {
            if(($_SESSION["balance"] - $withdraw_amount) < 0) {
                echo "Insufficient balance!";
                $error = true;
            }

            $account_balance = $bank->getAccountBalance($withdraw_account);
            if(($account_balance - $withdraw_amount) < 0) {
                echo "Insufficient balance!";
                $error = true;
            }
        }        

        if(!Banking::moneyValid($withdraw_amount)) {
            echo "Please provide a valid amount to withdraw!";
            $error = true;
        }

        if($error) {
            http_response_code(400);
        }else {
            http_response_code(200);    
            $account_balance = $account_balance - $withdraw_amount;
            $new_balance = $_SESSION["balance"] - $withdraw_amount;
            $bank = new Banking();
            $bank->withdrawAmount($new_balance, $withdraw_account, $account_balance, $withdraw_amount);
            $_SESSION["balance"] = $new_balance;

            echo "Withdraw Successful!";
        }
    }
?>