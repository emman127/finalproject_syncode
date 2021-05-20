<?php 

    spl_autoload_register('user_route');

    if(isset($_POST['register_method']) === true) {
        $data = [
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ];

        $user = new UserController();
        $user->register_user($data);
    }

    if(isset($_POST['login_method']) === true) {
        $data = [
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ];

        $user = new UserController();
        $user->login_user($data);
    }

    function user_route() {
        include_once "../controllers/UserController.php";
        require_once "../../database/config.php";
    }

?>