<!DOCTYPE html>
<html lang="en">
<title>E-VISITOR | RESEPSIONIS PINDAD</title>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/lib/lib-header.php';
session_start();
$session_value = (isset($_SESSION['token'])) ? $_SESSION['token'] : '';
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/db/dbconn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/policy/secure-pages.php';
?>

<body class="hold-transition sidebar-mini layout-fixed dark-mode" data-panel-auto-height-mode="height">
  <div class="wrapper">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/viewres/navbar.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/viewres/sidebar.php';

    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper iframe-mode bg-dark" data-widget="iframe" data-auto-dark-mode="true" data-loading-screen="750">
      <div class="nav navbar navbar-expand-lg navbar-dark border-bottom border-dark p-0">
        <a class="nav-link bg-danger" href="#" data-widget="iframe-close">Close</a>
        <a class="nav-link bg-dark" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a>
        <ul class="navbar-nav" role="tablist">
          <li class="nav-item active" role="presentation"><a href="#" class="btn-iframe-close" data-widget="iframe-close" data-type="only-this"><i class="fas fa-times"></i></a><a class="nav-link active" data-toggle="row" id="tab-pages-controllers-index-hal-i-pages3" href="#panel-pages-controllers-index-hal-i-pages3" role="tab" aria-controls="panel-pages-controllers-index-hal-i-pages3" aria-selected="true">Dashboard</a></li>
        </ul>
        <a class="nav-link bg-dark" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a>
        <a class="nav-link bg-dark" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a>
      </div>
      <div class="tab-content">
        <div class="tab-empty">
          <h2 class="display-4">Hello,<? $_SESSION['nama'] ?>!</h2>
        </div>
        <div class="tab-loading">
          <div>
            <h2 class="display-4">
              Tunggu Sebentar <i class="fa fa-sync fa-spin"></i>
            </h2>
          </div>
        </div>
        <div class="tab-pane fade active show" id="panel-pages-controllers-index-hal-i-pages3" role="tabpanel" aria-labelledby="tab-pages-controllers-index-hal-i-pages3"><iframe src="pages/controllers/index/hal?i=pages3" style="height: 906.989px;"></iframe></div>
      </div>
    </div>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/lib/lib-footer.php';
    ?>
</body>

</html>