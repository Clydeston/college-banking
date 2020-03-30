<?php 
    
    include_once "autoload.php";

    if($_SERVER["REQUEST_METHOD"] === "POST") {     
        // new user object
        $user = new User();   
        $bank = new Banking();

        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
    
        $email_valid = User::validateEmail($email);
        $password_valid = User::validatePassword($password, $confirm_password);
        $error = false;

        if(empty($email) || empty($password) || empty($confirm_password)) {
            $error = true;
            echo "Please ensure all fields are populated!";
        }

        if($email_valid != null) {
            $error = true;
            echo $email_valid;
        }       

        if($password_valid != null) {
            $error = true;
            echo $password_valid;
        }           
        
        if(!empty($user->doesEmailExist($email))){
            $error = true;
            echo "This email has already been used!";
        }
    
        if($error) {
            http_response_code(400);
        }else {
            http_response_code(200);
                        
            $user->email = $email;
            $user->pass = $password;
            $user->pin = User::generatePin();
            $user->password_hash = User::hashPassword($password);
            $user->join_date = User::generateJoinDate();
            
            // adding valid user to db
            $user->Create($user);
            $bank->createAccount($user->id, 1);
            echo "User added successfully!";
        }
    }
    
?>