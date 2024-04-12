<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo base_url('src/assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('src/assets/css/nav.css'); ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<style>
  body {
    animation: transitionIn 0.5s;
  }

  @keyframes transitionIn {
    from {
      transform: translatex(265px);
    }

    to {
      transform: translatex(0);
    }
  }
</style>

<body>
  <div class="wrapper">
    <aside id="sidebar" class="border-right shadow collapsed">
      <div class="h-100">
        <div class="sidebar-logo text-center bg-primary">
          <a href="#" style="cursor:default;">Menu</a>
        </div>
        <ul class="sidebar-nav">
          <li class="sidebar-logo text-center m-4">
            <i class="fa-solid fa-user fa-xl mb-3"></i><br>
            <h6 class="text-uppercase">
              <?= $this->logindata['user']['pst_name']?>
            </h6>
            <h6 class="text-uppercase text-secondary font-weight-normal">
              <?= $this->logindata['user']['jobtl_name'] ?>
            </h6>
          </li>
          <li class="sidebar-item border-top">
            <a href="<?= base_url("dashboard") ?>" class="sidebar-link">
              <i class="fa-solid fa-list fa-fw mr-2"></i>
              Dashboard
            </a>
          </li>
          <li class="sidebar-item border-top">
            <a class="sidebar-link" data-toggle="collapse" href="#multiCollapseExample1" role="button"
              aria-expanded="false" aria-controls="multiCollapseExample1">
              <i class="fa-regular fa-square-caret-down fa-fw mr-2"></i>
              Menu Gatepass
            </a>
            <!-- submenu -->
            <div class="collapse multi-collapse" id="multiCollapseExample1">
              <a href="<?= base_url("submit") ?>" class="subsidebar-link">
                <i class="fa-solid fa-plus fa-fw mr-2"></i>
                Submit Gatepass
              </a>
              <a href="<?= base_url("history") ?>" class="subsidebar-link">
                <i class="fa-solid fa-clock-rotate-left fa-fw mr-2"></i>
                History Gatepass
              </a>
              <?php
              if ($this->logindata['level'] == 'verifikator') { ?>
                <a href="<?= base_url("approve") ?>" class="subsidebar-link">
                  <i class="fa-solid fa-check fa-fw mr-2"></i>
                  Approve Gatepass
                </a>
              <?php } ?>
            </div>
          </li>
          <?php
          if ($this->logindata['level'] == 'hrd') { ?>
            <li class="sidebar-item border-top">
              <a href="<?= base_url("all_history") ?>" class="sidebar-link">
                <i class="fa-solid fa-clock-rotate-left fa-fw mr-2"></i>
                All Gatepass History
              </a>
            </li>
          <?php } ?>
          <li class="sidebar-item border-top">
            <a href="<?php echo base_url('AuthAdmin/logout') ?>" class="sidebar-link text-danger">
              <i class="fa-solid fa-power-off fa-fw mr-2"></i>
              Log Out
            </a>
          </li>
        </ul>
      </div>
    </aside>
    <div class="main">
      <nav class="navbar navbar-light bg-primary navbar-expand px-3 border-bottom py-2 shadow justify-content-between">
        <button class="border btn" id="sidebar-toggle" type="button">
          <i class="fa-solid fa-bars fa-fw text-white"></i>
        </button>
        <div style="cursor:pointer;">
          <i class="fa-solid fa-bell fa-fw text-white" style="font-size:20px;"></i><span
            class="badge badge-danger badge-pill">5</span>
        </div>
      </nav>


      <script src="<?php echo base_url('src/assets/js/jquery.min.js'); ?>"></script>
      <script src="<?php echo base_url('src/assets/js/popper.min.js'); ?>"></script>
      <script src="<?php echo base_url('src/assets/js/bootstrap.min.js'); ?>"></script>


      <!-- dibawah ini script untuk panggil datatable, alasan jquery nya gak dipake disini karena nanti ketimpa sama punya bs4 yang offline -->
      <!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> -->
      <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

      <script>
        // sidebar tekan muncul tekan hilang
        const sidebarToggle = document.querySelector("#sidebar-toggle");
        sidebarToggle.addEventListener("click", function () {
          document.querySelector("#sidebar").classList.toggle("collapsed");
        });


        // untuk popover
        $(function () {
          $('[data-toggle="popover"]').popover()
        })
        $('.popover-dismiss').popover({
          trigger: 'focus'
        })


      </script>

</body>

</html>