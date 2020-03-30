<?php    

include_once "Database.class.php";   

class User extends Database {

    public $email;
    public $password;
    public $pin;
    public $join_date;
    public $balance;
    public $id;
    public $password_hash;

    public static function validateEmail($email) {
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Please provide a valid email!";
        }

        if(strlen($email) > 125 || strlen($email) < 5) {
            return "Please ensure email is less than 125 characters, and a minimum of 5!";
        }

        return null;
    }

    public static function validatePassword($password, $confirm_password) {

        if(strlen($password) > 100 || strlen($password) < 10) {
            return "Please ensure password is less than 100 characters, and a minimum of 10!";
        }

        // numbers
        if(!preg_match('/\\d/', $password)) {
            return "Please ensure your password contains at least one number!";
        }

        // capitals
        if(!preg_match('/[A-Z]/', $password)) {
            return "Please ensure your password contains at least one capital letter!";
        }

        // special chars
        if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
            return "Please ensure your password contains at least one special character!";
        }

        if(!empty($confirm_password)) {
            if($password != $confirm_password) {
                echo "Please ensure your passwords match!";
            }
        }        

        return null;
    }

    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);
    }

    public static function generatePin() {
        return rand(9, 9);
    }

    public static function generateJoinDate() {
        return date("Y-m-d H:i:s");
    }

    public function doesEmailExist($email) {        
        $sql = "SELECT email from users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $exists = $stmt->fetch();
        return $exists;
    }

    public function doesUserExist($id) {        
        $sql = "SELECT id from users WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $exists = $stmt->fetch();
        return $exists;
    }

    public function getUserID($email) {        
        $sql = "SELECT id from users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $exists = $stmt->fetch();
        return $exists;
    }

    public function Create(User $usr) {
        // prepared statement to prevent injection possibilities
        $sql = "INSERT INTO users(email, password, pin, join_date) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$usr->email, $usr->password_hash, $usr->pin, $usr->join_date]);

        $this->setUserInfo($usr);
    }

    public function checkPassword(User $usr) {
        $valid = false;
        $sql = "SELECT password from users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$usr->email]);
        $hashed_password = $stmt->fetchColumn();

        if(!empty($hashed_password)) {
            $valid = password_verify($usr->password, $hashed_password);
            if($valid) {
                $usr->password_hash = $hashed_password;
            }
        }
        return $valid;
    }

    public function setUserInfo(User $usr) {
        $sql = "SELECT * from users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$usr->email]);
        $user_info = $stmt->fetch();

        $usr->id = $user_info["id"];
        $usr->email = $user_info["email"];
        $usr->password_hash = $user_info["password"];
        $usr->pin = $user_info["pin"];
        $usr->join_date = $user_info["join_date"];
        $usr->balance = $user_info["balance"];        
    }

    public function updateUserInfo(User $usr, $session_email) {
        if(!$this->checkPassword($usr)) {
            $usr->password_hash = User::hashPassword($usr->password);
        }

        if($session_email == $usr->email) {
            $sql = "UPDATE users SET password = ? WHERE id = ?";         
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$usr->password_hash, $usr->id]);    
            return "updated user password";
        }else {
            if(empty($usr->password_hash)) {
                $sql = "UPDATE users SET email = ? WHERE id = ?";         
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$usr->email, $usr->id]);  
                return "updated user email"; 
            }else {
                $sql = "UPDATE users SET password = ?, email = ? WHERE id = ?";         
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$usr->password_hash, $usr->email, $usr->id]);   
                return "updated user email and password"; 
            }
        }
    }
}

?>