<?php 

    spl_autoload_register('admin_route');

    if(isset($_POST['insert_method']) === true) {
        $data = [
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ];

        $admin = new AdminController();
        $admin->create_user($data);
    }

    if(isset($_GET['getId_method']) === true) {
        $admin = new AdminController();
        $admin->get_single_user($_GET['id']);
    }

    if(isset($_POST['update_method']) === true) {
        $data = [
            'id' => $_POST['id'],
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ];

        $admin = new AdminController();
        $admin->update_user($data);
    }

    if(isset($_POST['deleteId_method']) === true) {
        $id = $_POST['id'];
        $admin = new AdminController();
        $admin->delete_user($id);
    }

    if(isset($_POST['activate_method']) === true) {
        $admin = new AdminController();
        $admin->toActivate_user($_POST['id']);
    }

    if(isset($_POST['deactivate_method']) === true) {
        $admin = new AdminController();
        $admin->toDeactivate_user($_POST['id']);
    }

    function admin_route() {
        include_once "../controllers/AdminController.php";
        require_once "../../database/config.php";
    }

?>