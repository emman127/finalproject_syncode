<?php 

    class AdminController extends Database {        

        public function create_user($data) {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $query_insert = "CALL sproc_user (:firstname, :lastname, :username, :password, :isType, :isActive)";

                $username_exists = "SELECT username FROM user_info WHERE username = :username";

                $isAdmin = "SELECT isType FROM user_info WHERE isType = '1'";

                $conn = $this->connection();
                $stmt = $conn->prepare($username_exists);
                $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
                if($stmt->execute()) {
                    if($stmt->rowCount() > 0) {
                        echo json_encode(array('status' => 201));
                    }
                    else {
                        $conn = $this->connection();
                        $stmt = $conn->prepare($isAdmin);
                        $stmt->execute();
                        if($stmt->rowCount() > 0) {
                            $password = password_hash($data['password'], PASSWORD_DEFAULT);
                            $isType = '0';
                            $isActive = '0';

                            $stmt = $conn->prepare($query_insert);
                            $stmt->bindParam(':firstname', $data['firstname'], PDO::PARAM_STR);
                            $stmt->bindParam(':lastname', $data['lastname'], PDO::PARAM_STR);
                            $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
                            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                            $stmt->bindParam(':isType', $isType, PDO::PARAM_STR);
                            $stmt->bindParam(':isActive', $isActive, PDO::PARAM_STR);

                            if($stmt->execute()) {
                                echo json_encode(array('status' => 200));
                            }
                        }
                        else {
                            $password = password_hash($data['password'], PASSWORD_DEFAULT);
                            $isType = '1';
                            $isActive = '1';
                            
                            $stmt = $conn->prepare($query_insert);
                            $stmt->bindParam(':firstname', $data['firstname'], PDO::PARAM_STR);
                            $stmt->bindParam(':lastname', $data['lastname'], PDO::PARAM_STR);
                            $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
                            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                            $stmt->bindParam(':isType', $isType, PDO::PARAM_STR);
                            $stmt->bindParam(':isActive', $isActive, PDO::PARAM_STR);
        
                            if($stmt->execute()) {
                                echo json_encode(array('status' => 200));
                            }
                        }
                    }
                }
                else {
                    echo json_encode(array('status' => 500));
                }
            }
        }

        public function get_all_user() {
            $get_all_query = "SELECT * FROM user_info ORDER BY id DESC";

            $conn = $this->connection();
            $stmt = $conn->prepare($get_all_query);
            if($stmt->execute()) {
                $users = $stmt->fetchall();
                if($stmt->rowCount() > 0) {
                    return $users;
                }
            }
        }

        public function get_single_user($id) {
            if($_SERVER['REQUEST_METHOD'] === 'GET') {
                $get_id_query = "SELECT * FROM user_info WHERE id = :id";
    
                $conn = $this->connection();
                $stmt = $conn->prepare($get_id_query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $user = $stmt->fetch();
                if($stmt->rowCount() > 0) {
                    echo json_encode($user);
                }
            }
        }

        public function update_user($data) {
            $password = password_hash($data['password'], PASSWORD_DEFAULT);

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $update_query = "UPDATE user_info SET firstname = :firstname, lastname = :lastname, username = :username, password = :password WHERE id = :id";

                $conn = $this->connection();
                $stmt = $conn->prepare($update_query);
                $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
                $stmt->bindParam(':firstname', $data['firstname'], PDO::PARAM_STR);
                $stmt->bindParam(':lastname', $data['lastname'], PDO::PARAM_STR);
                $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);

                if($stmt->execute()) {
                    echo json_encode(array('status' => 200));
                }
            }
        }

        public function delete_user($id) {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $delete_query = "DELETE FROM user_info WHERE id = :id";

                $conn = $this->connection();
                $stmt = $conn->prepare($delete_query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                if($stmt->execute()) {
                    echo json_encode(array('status' => 200));
                }
            }
        }

        public function toActivate_user($id) {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $isActive = '1';

                $activate_query = "UPDATE user_info SET isActive = :isActive WHERE id = :id";
                
                $conn = $this->connection();
                $stmt = $conn->prepare($activate_query);
                $stmt->bindParam(':isActive', $isActive, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                if($stmt->execute()) {
                    echo json_encode(array('status' => 200));
                }
            }
        }

        public function toDeactivate_user($id) {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $inactive = '0';
                $deactivate_query = "UPDATE user_info SET isActive = :inactive WHERE id = :id";

                $conn = $this->connection();
                $stmt = $conn->prepare($deactivate_query);
                $stmt->bindParam(':inactive', $inactive, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                if($stmt->execute()) {
                    echo json_encode(array('status' => 200));
                }
            }
        }
    }

    $admin = new AdminController();

?>
