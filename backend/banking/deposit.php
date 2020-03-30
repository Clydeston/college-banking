<?php 
    include_once "../autoload.php";    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }     

    if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_SESSION["user_id"])){
        $deposit_amount = $_POST["deposit_amount"];
        $deposit_account = $_POST["deposit_account"];
        $account_balance;

        $error = false;
        $bank = new Banking();

        if(empty($deposit_amount) || empty($deposit_account)) {
            echo "Please ensure all fields are populated!";
            $error = true;
        }

        if(!is_numeric($deposit_amount)) {
            echo "Please ensure deposit amount is a number!";
            $error = true;
        }

        if($deposit_amount < 0) {
            echo "Please ensure the deposit amount is a positive number!";
            $error = true;
        }

        if(!is_numeric($deposit_account)) {
            echo "Please provide a valid account!";
            $error = true;
        }        

        if(empty($bank->accountExists($deposit_account))) {
            echo "Please provide a valid account!";
            $error = true;
        }

        if(is_numeric($deposit_account) && !$error) {
            $account_balance = $bank->getAccountBalance($deposit_account) + $deposit_amount;
        }

        if(!Banking::moneyValid($deposit_amount)) {
            echo "Please provide a valid amount to deposit!";
            $error = true;
        }

        if($error) {
            http_response_code(400);
        }else {
            http_response_code(200);    

            $new_balance = $_SESSION["balance"] + $deposit_amount;            
            $bank = new Banking();
            $bank->depositAmount($new_balance, $deposit_account, $account_balance, $deposit_amount);
            $_SESSION["balance"] = $new_balance;

            echo "Deposit Successful!";
        }
    }
?>