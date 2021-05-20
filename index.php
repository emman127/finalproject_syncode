<?php 

    session_start();

    if(isset($_SESSION['access']) == true) {
        header('location: ../admincontent/dashboard.php');
    }

?>


<?php include('views/index.views.php'); ?>

<?php include('libraries/includes/scripts.php'); ?>
