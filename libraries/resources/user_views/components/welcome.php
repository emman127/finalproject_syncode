<?php 

    session_start();

    if(!isset($_SESSION['fullname']) && $_SESSION['access'] != true) {
        header('location: ../index.php');
        exit();
    }

?>

<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="h4 text-center">Welcome <span class="text-primary"><?php echo $_SESSION['fullname']. ' !' ?></span></div>
        </div>
    </div>
</div>