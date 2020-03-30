<?php 
    
    include_once "autoload.php";
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }     

    if($_SERVER["REQUEST_METHOD"] === "POST") {     
        // new user object
        $user = new User();   
        $bank = new Banking();   

        $email = $_POST["email"];
        $password = $_POST["password"];   
        $user->password = $password;     
        $user->email = $email;
    
        $error = false;

        if(empty($email) || empty($password)) {
            $error = true;
            echo "Please ensure all fields are populated!";
        }    

        if(!$user->checkPassword($user)) {
            $error = true;
            echo "The username or password may be incorrect, please try again!";
        }
    
        if($error) {
            http_response_code(400);
        }else {
            http_response_code(200);
            
            $user->setUserInfo($user);
            $_SESSION["user_id"] = $user->id;
            $_SESSION["balance"] = $user->balance;
            $_SESSION["email"] = $user->email;

            $user_balance_check = $bank->validateUserBalance($user);
            if($user_balance_check != null) {
                $_SESSION["balance"] = $user_balance_check;
            }
            echo "Login successful! Redirecting...";
        }
    }
    
?>