<?php
    class BusinessMemeber {
        private $conn;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function id_exist($id)
        {
            $sql = "SELECT * FROM sd_BusinessUsers WHERE ID = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->rowCount() ? true : false;
        }

        public function email_format_check($email){
            return filter_has_var($email, FILTER_VALIDATE_EMAIL);
        }

        public function email_exists($email){
            $sql = "SELECT * FROM sd_BusinessUsers WHERE Email=:email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email',  $email);
            $stmt->execute();

            return $stmt->rowCount() ? true : false;
        }

        public function business_nuber_exists($business_number){
            $sql = "SELECT * FROM sd_BusinessUsers WHERE BusinessRegistrationNumber = :businessNumber";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':businessNumber', $business_number);
            $stmt->execute();
            return $stmt->rowCount() ? true : false;
        }

        public function input($marr){
            $new_hash_password = password_hash($marr['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO sd_BusinessUsers(ID, Password, CompanyName, CEOName, PhoneNumber, MobileNumber, FaxNumber, Email, Zipcode, Address, DetailAddress, BusinessRegistrationNumber, BusinessRegistrationImage, BusinessType, BusinessCategory, SignupDate) VALUES
            (:id, :password, :companyname, :ceoname, :email, :phonenumber, :mobilenumber, :faxnumber, :zipcode, :address, :detailaddress, :businessregistrationnumber, :businessregistrationimage, :businesstype, :businesscategory, NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $marr['id']);
            $stmt->bindParam(':password', $new_hash_password);
            $stmt->bindParam(':companyname', $marr['companyname']);
            $stmt->bindParam(':ceoname', $marr['ceoname']);
            $stmt->bindParam(':email', $marr['email']);
            $stmt->bindParam(':phonenumber', $marr['mobilenumber']);
            $stmt->bindParam(':faxnumber', $marr['faxnumber']);
            $stmt->bindParam(':zipcode', $marr['zipcode']);
            $stmt->bindParam(':address', $marr['address']);
            $stmt->bindParam(':detailaddress', $marr['detailaddress']);
            $stmt->bindParam(':businessregistrationnumber', $marr['businessregistrationnumber']);
            $stmt->bindParam(':businessregistrationimage', $marr['businessregistrationimage']);
            $stmt->bindParam(':businesstype', $marr['businesstype']);
            $stmt->bindParam(':businesscategory', $marr['businesscategory']);
            $stmt->execute();

            if ($stmt->rowCount() === 0){
                return false;
            }

            return true;
        }

        public function business_login($id, $pw, $number){

        }
    }