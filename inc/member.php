<?php
    class Member {
        private $conn;
        
        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function  id_exist($id)
        {
            $sql = "SELECT * FROM sd_Users WHERE ID=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id',  $id);
            $stmt->execute();

            return $stmt->rowCount() ? true : false;
        }

        public function email_format_check($email){
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        public function email_exists($email){
            $sql = "SELECT * FROM sd_Users WHERE Email=:email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email',  $email);
            $stmt->execute();

            return $stmt->rowCount() ? true : false;
        }

        public function input($marr){
            $new_hash_passowrd = password_hash($marr['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO sd_Users(ID, Password, Email, Name, MobileNumber1, MobileNumber2, MobileNumber3, PhoneNumber1, PhoneNumber2, PhoneNumber3, Zipcode, Adress, DetailAdress, SignupDate) VALUES
            (:id, :password, :email, :name, :mobile1, :mobile2, :mobile3, :phone1, :phone2, :phone3, :zipcode, :adress, :detailadress, NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $marr['id']);
            $stmt->bindParam(':password', $new_hash_passowrd);
            $stmt->bindParam(':email', $marr['email']);
            $stmt->bindParam(':name', $marr['name']);
            $stmt->bindParam(':mobile1', $marr['mobile1']);
            $stmt->bindParam(':mobile2', $marr['mobile2']);
            $stmt->bindParam(':mobile3', $marr['mobile3']);
            $stmt->bindParam(':phone1', $marr['phone1']);
            $stmt->bindParam(':phone2', $marr['phone2']);
            $stmt->bindParam(':phone3', $marr['phone3']);
            $stmt->bindParam(':zipcode', $marr['zipcode']);
            $stmt->bindParam(':adress', $marr['adress']);
            $stmt->bindParam(':detailadress', $marr['detailadress']);
            $stmt->execute();
        }

        public function login($id, $pw){
            $sql = "SELECT Password FROM sd_Users WHERE ID=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
        
            $stmt->execute();
        
            if ($stmt->rowCount()) {
                $row = $stmt->fetch();
            
                // 여기서도 'Password'를 사용하도록 통일합니다.
                if (password_verify($pw, $row['Password'])) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }     
    }
?>