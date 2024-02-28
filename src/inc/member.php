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

            $sql = "INSERT INTO sd_Users(ID, Password, Email, Name, MobileNumber, PhoneNumber, ZipCode, Address, DetailAddress, SignupDate) VALUES
            (:id, :password, :email, :name, :mobile, :phone, :zipcode, :address, :detailaddress, NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $marr['id']);
            $stmt->bindParam(':password', $new_hash_passowrd);
            $stmt->bindParam(':email', $marr['email']);
            $stmt->bindParam(':name', $marr['name']);
            $stmt->bindParam(':mobile', $marr['mobile']);
            $stmt->bindParam(':phone', $marr['phone']);
            $stmt->bindParam(':zipcode', $marr['zipcode']);
            $stmt->bindParam(':address', $marr['address']);
            $stmt->bindParam(':detailaddress', $marr['detailaddress']);
            $stmt->execute();
            // print_r($stmt->errorInfo());
            if ($stmt->rowCount() === 0){
                return false;
            }

            return true;
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

        public function getInfo($id){
            $sql = "SELECT * FROM sd_Users WHERE ID=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetch();
        }
        public function list($page, $limit, $paramArr) {
            $start = ($page - 1) * $limit;
            $where = "";
        
            if ($paramArr['sn'] != '' && $paramArr['sf'] != '') {
                switch ($paramArr['sn']) {
                    case 1: $sn_str = 'Name'; break;
                    case 2: $sn_str = 'ID'; break;
                    case 3: $sn_str = 'Email'; break;
                }
        
                $where = " WHERE ".$sn_str." = :sf ";
            }
        
            $sql = "SELECT IDX, ID, Name, Email, DATE_FORMAT(SignupDate, '%Y-%m-%d %H:%i') AS SignupDate 
                    FROM sd_Users ". $where ." 
                    ORDER BY IDX DESC LIMIT ".$start.",".$limit;
            
            $stmt = $this->conn->prepare($sql);
        
            if ($where != '') {
                $stmt->bindParam(':sf', $paramArr['sf']);
            }
        
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        
        public function total($paramArr){

            $where = "";

            if($paramArr['sn'] != '' && $paramArr['sf'] != ''){
                switch($paramArr['sn']){
                    case 1 : $sn_str = 'Name'; break;
                    case 2 : $sn_str = 'ID'; break;
                    case 3 : $sn_str = 'Email'; break;
                }

                $where = "  WHERE ".$sn_str."=:sf ";
            }

            $sql = "SELECT COUNT(*) cnt FROM sd_Users ". $where;
            $stmt = $this->conn->prepare($sql);

            if($where != ''){
                $stmt->bindParam(':sf', $paramArr['sf']);
            }

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $row = $stmt->fetch();
            return $row['cnt'];
        }

        public function getAllData(){


            $sql = "SELECT * FROM sd_Users ORDER BY IDX ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function getInfoFormIdx($idx){
            $sql = "SELECT * FROM sd_Users WHERE IDX=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idx", $idx);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetch();
        }
    }
?>