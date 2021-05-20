<?php 

    class DashboardController extends Database {

        public function total_account() {

            $conn = $this->connection();
            $total_query = "SELECT * from user_info";
            $stmt = $conn->prepare($total_query);
            $stmt->execute();
            $users = $stmt->rowCount();

            return $users;

            unset($stmt);
            unset($pdo);
        }

        public function count_active() {

            $isActive = '1';
            $conn = $this->connection();
            $active_query = "SELECT * FROM user_info WHERE isActive = :isActive";
            $stmt = $conn->prepare($active_query);
            $stmt->bindParam(':isActive', $isActive, PDO::PARAM_STR);
            $stmt->execute();
            $active = $stmt->rowCount();

            return $active;

            unset($stmt);
            unset($pdo);
        }

        public function count_inactive() {

            $isActive = '0';

            $conn = $this->connection();
            $inactive_query = "SELECT * FROM user_info WHERE isActive = :isActive";
            $stmt = $conn->prepare($inactive_query);
            $stmt->bindParam(':isActive', $isActive, PDO::PARAM_STR);
            $stmt->execute();
            $inactive = $stmt->rowCount();

            return $inactive;

            unset($stmt);
            unset($pdo);
        }

        public function pending_table() {
            $isActive = '0';

            $conn = $this->connection();
            $pending_query = "SELECT * FROM user_info WHERE isActive = :isActive";
            $stmt = $conn->prepare($pending_query);
            $stmt->bindParam(':isActive', $isActive, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                $row = $stmt->fetchall();

                return $row;
            }
        }

    }

    $dashboard = new DashboardController();

?>