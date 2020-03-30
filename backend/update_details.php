<?php 
    include_once "autoload.php";    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }     

    if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_SESSION["user_id"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $new_password = $_POST["new_password"];
        $password_confirm = $_POST["confirm_password"];

        $error = false;
        $usr = new User();    
        $usr->email = $_SESSION["email"];
        $usr->password = $password;
        $usr->id = $_SESSION["user_id"];

        $email_valid = User::validateEmail($email);
        $password_valid = User::validatePassword($new_password, $password_confirm);

        
        if(empty($email) && empty($password) && empty($new_password) && empty($password_confirm)) {
            $error = true;
            echo "Please ensure all fields are populated!";            
        }

        if(empty($password) && !$error) {
            $error = true;
            echo "Please enter your password to update any details!";  
        }
        
        if(!$usr->checkPassword($usr) && !$error) {
            $error = true;
            echo "The password is incorrect!";
        }else {
            $usr->email = $email;
        }  

        if($email != $_SESSION["email"]) {                             
            if($email_valid != null && !$error) {
                $error = true;
                echo $email_valid;
            }        
        }

        if($password_valid != null && !$error && !empty($new_password)) {
            $error = true;
            echo $password_valid;
        }     

        if($new_password != $password_confirm && !$error) {
            $error = true;
            echo "Please ensure the new passwords match!";  
        }

        if($email == $_SESSION["email"] && empty($new_password) && !$error){
            $error = true;
            echo "Can't update the same email!";
        }

        if($email != $_SESSION["email"] && !$error) {
            if(!empty($usr->doesEmailExist($email))){
                $error = true;
                echo "This email has already been used!";
            }
        }

        if($error) {
            http_response_code(400);
        }else {
            http_response_code(200);                     
            
            if(!empty($new_password)) {
                $usr->password = $new_password;
            }            
            $usr->updateUserInfo($usr, $_SESSION["email"]);
            $_SESSION["email"] = $usr->email;

            echo "Update successful!";
        }
    }
?>