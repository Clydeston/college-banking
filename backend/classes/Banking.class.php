<?php 
    include_once "Database.class.php";   
    include_once "User.class.php";   

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    class Banking extends Database {

        public function withdrawAmount($amount, $account_id, $account_balance, $raw_amount) {
            $sql = "UPDATE users SET balance = ? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$amount, $_SESSION["user_id"]]);

            $sql = "UPDATE accounts SET balance = ? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$account_balance, $account_id]);

            $this->auditTransaction($raw_amount, "withdraw", null, $account_id);
        }

        public function depositAmount($amount, $account_id, $account_balance, $raw_amount) {                  
            $sql = "UPDATE users SET balance = ? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$amount, $_SESSION["user_id"]]);

            $sql = "UPDATE accounts SET balance = ? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$account_balance, $account_id]);

            $this->auditTransaction($raw_amount, "deposit", null, $account_id);
        }

        private function auditTransaction($amount, $type, $recipient_id = null, $account_id = null) {
            $sql = "INSERT INTO transactions(user_id, timestamp, amount, type, recipient_id, account_id) VALUES(?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$_SESSION["user_id"], User::generateJoinDate(), $amount, $type, $recipient_id, $account_id]);
        }

        public function checkBalance($user_id) {
            $sql = "SELECT balance from users WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id]);
            $balance = $stmt->fetch();            
            return $balance;
        }

        // transfer money to other users current account
        public function transferMoney($user_id, $recipient_id, $amount, $account_id, $account_balance) {

            // getting recipient balance
            $sql = "SELECT balance from users WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$recipient_id]);
            $recipient_balance = $stmt->fetch();        
            
            // getting recipient current account balance
            $sql = "SELECT balance from accounts WHERE type = 1 AND user_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$recipient_id]);
            $recipient_account_balance = $stmt->fetch();    
            
            // updating recipient balance / current account balance
            $new_recipient_balance = $recipient_balance["balance"] + $amount;
            $new_recipient_account_balance = $recipient_account_balance["balance"] + $amount;

            $sql = "UPDATE users SET balance = ? WHERE id = ?";         
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$new_recipient_balance, $recipient_id]);                                                

            $sql = "UPDATE accounts SET balance = ? WHERE user_id = ? AND type = 1";         
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$new_recipient_account_balance, $recipient_id]);   

            // updating user balance
            $new_user_balance = $_SESSION["balance"] - $amount;
            
            $sql = "UPDATE users SET balance = ? WHERE id = ?";         
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$new_user_balance, $user_id]);   

            // fix not updating account balance
            // updating user account balance
            $sql = "UPDATE accounts SET balance = ? WHERE id = ?";         
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$account_balance, $account_id]); 

            // recording transaction
            $this->auditTransaction($amount, "transfer", $recipient_id, $account_id);
            //return $recipient_balance;
        }
        
        public function createAccount($user_id, $type) {
            $sql = "INSERT INTO accounts(user_id, type, creation_date) VALUES (?, ?, ?)";         
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id, $type, User::generateJoinDate()]);   
        }        

        public function deleteAccount($user_id, $account_id) {
            // getting account balance
            $sql = "SELECT balance from accounts WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$account_id]);
            $account_to_delete_balance = $stmt->fetch();           
            
            // getting current account balance
            $sql = "SELECT balance from accounts WHERE user_id = ? AND type = 1";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id]);
            $current_account_balance = $stmt->fetch();   

            $new_current_account_balance = $current_account_balance["balance"] + $account_to_delete_balance["balance"];

            $sql = "UPDATE accounts SET balance = ? WHERE type = 1";         
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$new_current_account_balance]);  

            // deleting account
            $sql = "DELETE from accounts WHERE id = ? AND user_id = ?";         
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$account_id, $user_id]);   
        }

        public function transferAccountBalance($account_id, $new_account_id, $amount) {

            // getting old account balance
            $sql = "SELECT balance from accounts WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$account_id]);
            $old_account_balance = $stmt->fetch();

             // getting new account balance
             $sql = "SELECT balance from accounts WHERE id = ?";
             $stmt = $this->connect()->prepare($sql);
             $stmt->execute([$new_account_id]);
             $new_account_balance = $stmt->fetch();

            // setting old account balance 
            $old_account_new_balance = $old_account_balance["balance"] - $amount;
            $sql = "UPDATE accounts SET balance = ? WHERE id = ?";         
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$old_account_new_balance, $account_id]);    

            // setting new account balance
            $new_account_new_balance = $new_account_balance["balance"] + $amount;
            $sql = "UPDATE accounts SET balance = ? WHERE id = ?";         
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$new_account_new_balance, $new_account_id]);    
        }

        public function getAccounts($user_id) {
            $sql = "SELECT * from accounts WHERE user_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id]);
            $accounts = $stmt->fetchAll();
            return $accounts;
        }            

        public function getAccountBalances($user_id) {
            $sql = "SELECT id, balance from accounts WHERE user_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id]);
            $balances = $stmt->fetchAll();
            return $balances;
        }

        public function accountExists($account_id) {
            $sql = "SELECT id from accounts WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$account_id]);
            $account = $stmt->fetch();
            return $account;
        }

        public function getAccountBalance($account_id) {
            $sql = "SELECT balance from accounts WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$account_id]);
            $balances = $stmt->fetch();
            return $balances["balance"];
        }

        public static function moneyValid($amount) {
            if (preg_match('/^[0-9]+(?:\.[0-9]{0,2})?$/', $amount))
            {
                return true;
            }
            return false;
        }

        public function getAccountType($account_id) {
            $sql = "SELECT type from accounts WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$account_id]);
            $type = $stmt->fetch();
            return $type["type"];
        }

        public function validateUserBalance(User $usr) {        
            $overall_account_balance = 0;                          
            //getting user accounts
            $sql = "SELECT balance from accounts WHERE user_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$usr->id]);
            $account_balances = $stmt->fetchAll();  

            foreach($account_balances as $balance) {
                $overall_account_balance = + $overall_account_balance + $balance["balance"];
            }

            if($usr->balance != $overall_account_balance) {
                $sql = "UPDATE users SET balance = ? WHERE id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$overall_account_balance, $usr->id]);
                return $overall_account_balance;
            }
            return null;
        }

    }
?>