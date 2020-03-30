<?php 
    include_once "../autoload.php";    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }     

    if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_SESSION["user_id"])){
        $transfer_amount = $_POST["transfer_amount"];
        $recipient_id = $_POST["recipient_id"];
        $transfer_account = $_POST["transfer_account"];
        $account_balance;

        $error = false;
        $usr = new User();
        $bank = new Banking();

        //self transfer
        if($_SESSION["user_id"] == $recipient_id || $_SESSION["email"] == $recipient_id) {
            echo "You can't transfer yourself money!";
            $error = true;
        }        

        // empty fields
        if(empty($transfer_amount) || empty($recipient_id) || empty($transfer_account) && !$error) {
            echo "Please ensure all fields are populated!";
            $error = true;
        }

        if(!is_numeric($transfer_account) && !$error) {
            echo "Please provide a valid account!";
            $error = true;
        }        

        if(empty($bank->accountExists($transfer_account)) && !$error) {
            echo "Please provide a valid account!";
            $error = true;
        }

        // transfer amount not number
        if(!is_numeric($transfer_amount) && !$error) {
            echo "Please ensure transfer amount is a number!";
            $error = true;
        }

        // transfer amount negative
        if($transfer_amount < 0 && !$error) {
            echo "Please ensure the transfer amount is a positive number!";
            $error = true;
        }

        // balance check
        if(is_numeric($transfer_amount) && !$error) {
            if(($_SESSION["balance"] - $transfer_amount) < 0) {
                echo "Insufficient balance!";
                $error = true;
            }
        }       

        // user ID validation
        if(!$error) {
            if(!is_numeric($recipient_id)) {            
                if(empty($usr->doesEmailExist($recipient_id))) {
                    echo "No user with this email could be found!";
                    $error = true;
                }else {
                    $recipient_id = $usr->getUserID($recipient_id);
                }
            }else {
                if(empty($usr->doesUserExist($recipient_id))) {
                    echo "No user with this ID could be found!";                
                    $error = true;
                }
            }
        }

        if(!Banking::moneyValid($transfer_amount)) {
            echo "Please provide a valid amount to transfer!";
            $error = true;
        }

        if(is_numeric($transfer_account) && !$error) {
            $account_balance = $bank->getAccountBalance($transfer_account);
            if(($account_balance - $transfer_amount) < 0) {
                echo "Insufficient balance!";
                $error = true;
            }
        }

        if($error) {
            http_response_code(400);
        }else {
            http_response_code(200);    

            $new_balance = $_SESSION["balance"] - $transfer_amount;
            $account_balance = $account_balance - $transfer_amount;
            $bank = new Banking();
            $bank->transferMoney($_SESSION["user_id"], $recipient_id["id"], $transfer_amount, $transfer_account, $account_balance);
            $_SESSION["balance"] = $new_balance;            

            echo "Transfer Successful!";
        }
    }
?>