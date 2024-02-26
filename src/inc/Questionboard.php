<?php
    class Board {
        private $conn;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function input($arr) {
            $sql = "INSERT INTO sd_Question_board(name, password, email, phone_number, title, content, attachments) VALUES(:name, :password, :email, :phone_number, :title, :content, :attachments)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $arr['name']);
            $stmt->bindParam(':password', $arr['password']);
            $stmt->bindParam(':email', $arr['email']);
            $stmt->bindParam(':phone_number', $arr['phone_number']);
            $stmt->bindParam(':title', $arr['title']);
            $stmt->bindParam(':content', $arr['content']);
            $stmt->bindParam(':attachments', $arr['attachment']);
            $stmt->execute();
            if ($stmt->rowCount() === 0) {
                return false;
            }

            return true;
        }
    }
?>