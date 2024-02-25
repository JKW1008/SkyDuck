<?php
    class Qna {
        private $conn;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function input($arr) {
            $sql = "INSERT INTO sd_Estimate_inquiry(name, contact_number, email, company_name, position, website, service_required, budget, timeline, additional_notes) VALUES
            (:name, :contact_number, :email, :company_name, :position, :website, :service_r, :budget, :timeline, :a_note)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $arr['name']);
            $stmt->bindParam(':contact_number', $arr['c_number']);
            $stmt->bindParam(':email', $arr['email']);
            $stmt->bindParam(':company_name', $arr['company']);
            $stmt->bindParam(':position', $arr['position']);
            $stmt->bindParam(':website', $arr['website']);
            $stmt->bindParam(':service_r', $arr['service_r']);
            $stmt->bindParam(':budget', $arr['budget'], PDO::PARAM_INT);
            $stmt->bindParam(':timeline', $arr['schedule']);
            $stmt->bindParam(':a_note', $arr['a_note']);
            $stmt->execute();
            if ($stmt->rowCount() === 0) {
                return false;
            }

            return true;
        }
    }
?>