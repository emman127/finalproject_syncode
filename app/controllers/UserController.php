<?php 

    class UserController extends Database {

        public function register_user($data) {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $isType = '1';

                $register_query = "CALL sproc_user (:firstname, :lastname, :username, :password, :isType, :isActive)";
                $user_exists = "SELECT username FROM user_info WHERE username = :username";
                $user_type = "SELECT * FROM user_info WHERE isType = :isType";

                // user exists
                $conn = $this->connection();
                $stmt = $conn->prepare($user_exists);
                $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
                if($stmt->execute()) {
                    if($stmt->rowCount() > 0) {
                        echo json_encode(array('status' => 403));
                    }
                    // register as user
                    else {
                        $stmt = $conn->prepare($user_type);
                        $stmt->bindParam(':isType', $isType, PDO::PARAM_STR);
                        $stmt->execute();
                        if($stmt->rowCount() > 0) {
                            $type_user = '0';
                            $inactive = '0';

                            $stmt = $conn->prepare($register_query);
                            $stmt->bindParam(':firstname', $data['firstname'], PDO::PARAM_STR);
                            $stmt->bindParam('lastname', $data['lastname'], PDO::PARAM_STR);
                            $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
                            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                            $stmt->bindParam(':isType', $type_user, PDO::PARAM_STR);
                            $stmt->bindParam(':isActive', $inactive, PDO::PARAM_STR);

                            if($stmt->execute()) {
                                echo json_encode(array('status' => 201));
                            }
                        }
                        // register as admin
                        else {
                            $type_admin = '1';
                            $active = '1';

                            $stmt = $conn->prepare($register_query);
                            $stmt->bindParam(':firstname', $data['firstname'], PDO::PARAM_STR);
                            $stmt->bindParam(':lastname', $data['lastname'], PDO::PARAM_STR);
                            $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
                            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                            $stmt->bindParam(':isType', $type_admin, PDO::PARAM_STR);
                            $stmt->bindParam('isActive', $active, PDO::PARAM_STR);
            
                            if($stmt->execute()) {
                                echo json_encode(array('status' => 200));
                            }
                        }
                    }
                }
            }
        }

        public function login_user($data) {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $login_query = "SELECT * FROM user_info WHERE username = :username";

                $conn = $this->connection();
                $stmt = $conn->prepare($login_query);
                $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
                if($stmt->execute()) {
                    if($stmt->rowCount() > 0) {
                        $get = $stmt->fetch();
                        $firstname = $get['firstname'];
                        $lastname = $get['lastname'];

                        $isType = $get['isType'];
                        $isActive = $get['isActive'];
                        $password_hashed = $get['password'];

                        $password = $data['password'];
                        if(password_verify($password, $password_hashed)) {
                            // user
                            if($isType === '0') {
                                // Inactive Account
                                if($isActive === '0') {
                                    echo json_encode(array('status' => 201));
                                }
                                // Active Account
                                else {
                                    echo json_encode(array('status' => 'user'));

                                    session_start();
                                    $_SESSION['access'] = true;
                                    $_SESSION['fullname'] = $firstname .' '.$lastname;
                                    $_SESSION['roles'] = 'USER';
                                }
                            }
                            // admin
                            else {
                                echo json_encode(array('status' => 200));

                                session_start();
                                $_SESSION['access'] = true;
                                $_SESSION['fullname'] = $firstname .' '.$lastname;
                                $_SESSION['roles'] = 'ADMIN';
                            }
                        }
                        else {
                            echo json_encode(array('status' => 404));
                        }
                    }
                    else {
                        echo json_encode(array('status' => 404));
                    }
                }
            }
        }

    }

?>