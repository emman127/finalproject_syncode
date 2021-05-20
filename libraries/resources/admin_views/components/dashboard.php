<?php

    include_once("../database/config.php");
    include("../app/controllers/DashboardController.php");

?>

<div class="container">
  <div class="row align-items-start">
    <div class="col-md-4">
      <div class="card">
          <div class="card-body d-flex align-items-center" id="card_1">
            <?php include('dashboardcard/card_1.php'); ?>
          </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
          <div class="card-body d-flex align-items-center" id="card_2">
            <?php include('dashboardcard/card_2.php'); ?>
          </div>
      </div>
    </div>
    <div class="col-md-4">
        <div class="card">
        <div class="card-body d-flex align-items-center" id="card_3">
            <?php include('dashboardcard/card_3.php'); ?>
          </div>
        </div>
    </div>
  </div>
</div>

<div class="container py-5">
    <div class="card">
        <div class="card-body">
            <?php include('dashboardcard/tablepending.php'); ?>
        </div>
    </div>
</div>