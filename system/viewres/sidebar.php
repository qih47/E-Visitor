   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
       <!-- Brand Logo -->
       <center>
           <div class="nav-item mt-3" id="navitem">
               <a href="pages/controllers/index/hal.php?i=pages3" id="brand" class="nav-link px-4 thin-border" style="text-align: center;">
                   <img src="assets/img/evisitor.png" alt="E-Visitor Logo" class="brand-image-xl" width="180px" style="opacity: 0.8;right: 20px;text-align:left;" />
                   <span id="brandtittle" class="brand-text font-weight-light mt-3"><b></b></span>
               </a>
           </div>
       </center>
       <!-- Sidebar -->
       <div class="sidebar">
           <!-- Sidebar user panel (optional) -->
           <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="image">
                   <img src="assets/profile/<?= $_SESSION['profile'] ?>" class="img elevation-2" alt="User Image" width="90px" height="60px" />
               </div>
               <div class="info">
                   <a href="#" class="d-block"><b><?= strtoupper($_SESSION['nama']) ?></b></a>
               </div>
           </div>

           <!-- Sidebar Menu -->
           <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                   <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->

                   <li class="nav-item">
                       <a href="pages/controllers/index/hal.php?i=pages3" class="nav-link" id="dashboard" data-login-back="<?php echo isset($_SESSION['pesan']) && $_SESSION['pesan'] === "loginback" ? 'true' : 'false'; ?>">
                           <i class="fas fa-tachometer-alt"></i>
                           <p style="margin-left: 9px;">Dashboard</p>
                       </a>
                   </li>
                   <li class="nav-item">
                       <a href="pages/controllers/index/hal.php?i=pages4" class="nav-link">
                           <i class="fas fa-book-open"></i>
                           <p style="margin-left: 9px;">
                               Buku Tamu
                           </p>
                       </a>
                   </li>
                   <li class="nav-item">
                       <a href="config/pages.php?menu=5&pesan=active" class="nav-link">
                           <i class="fas fa-database"></i>
                           <p style="margin-left: 9px;">
                               Data Visitor
                           </p>
                       </a>
                   </li>
                   <li class="nav-item">
                       <a href="#" class="nav-link">
                           <i class="fas fa-cogs"></i>
                           <p style="margin-left: 5px;">
                               Pengaturan
                               <i class="fas fa-arrow-circle-left right mt-2"></i>
                           </p>
                       </a>
                       <ul class="nav nav-treeview">
                           <li class="nav-item">
                               <a href="pages/controllers/index/hal.php?i=pages6" class="nav-link">
                                   <i class="far fa-circle nav-icon"></i>
                                   <p>Pengaturan Divisi</p>
                               </a>
                           </li>
                           <li class="nav-item">
                               <a href="data_rfid.php" class="nav-link">
                                   <i class="far fa-circle nav-icon"></i>
                                   <p>Pengaturan Kartu</p>
                               </a>
                           </li>
                           <li class="nav-item">
                               <a href="data_dir.php" class="nav-link">
                                   <i class="far fa-circle nav-icon"></i>
                                   <p>Pengaturan Direktur</p>
                               </a>
                           </li>
                           <li class="nav-item">
                               <a href="user.php" class="nav-link">
                                   <i class="far fa-circle nav-icon"></i>
                                   <p>Pengaturan User</p>
                               </a>
                           </li>
                       </ul>
                   </li>
                   <li class="nav-item">
                       <a name="logout" id="logout" class="nav-link">
                           <i class="fas fa-sign-out-alt"></i>
                           <p style="margin-left: 9px;">
                               Keluar
                           </p>
                       </a>
                   </li>
                   <div class="row gx-0">
                       <div class="col-lg-12 wow zoomIn brand-text" data-wow-delay="0.1s" style="margin:10px 0px 0px 0px;">
                           <div class="shadow d-flex align-items-center justify-content-center p-4" style="height: 100px;background-color:#3f6790">
                               <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2 " style="width: 60px; height: 60px; margin: 10px 0px 0px -13px;">
                                   <i class="fa fa-clock text-primary" style="font-size: 40px;"></i>
                               </div>
                               <div class="ps-3 px-3" style="margin: 0px -30px 0px -7px;">
                                   <a style="font-size: 14px;" id="tanggal" class="text-white mb-0"></a>
                                   <h5 id="MyClockDisplay" class="text-white mb-0 " data-toggle="counter-up" onload="showTime()"></h5>
                                   <!-- <h5 id="count" name="count" class="text-white mb-0 " data-toggle="counter-up"></h5> -->
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-12 wow zoomIn mt-3 brand-text" data-wow-delay="0.1s" style="margin:10px 0px 0px 0px;">
                           <div class="shadow d-flex align-items-center justify-content-center p-4" style="height: 100px;background-color:#3f6790">
                               <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px; margin: 10px 0px 0px -25px;">
                                   <i class="fa fa-users text-primary" style="font-size: 40px;"></i>
                               </div>
                               <div class="ps-3 px-4" style="margin: 0px -30px 0px 0px;">
                                   <h7 id="count" class="brand-text">TAMU BULAN INI</h7>
                                   <?php
                                    $count = $database->countTamuBulan();
                                    if($count['jumlah'] == ""){
                                        $jumlah = 0;
                                    }else{
                                        $jumlah = $count['jumlah']; 
                                    }
                                    ?>
                                   <h1 id="count" class="brand-text"><?php echo $jumlah; ?></h1>
                               </div>
                           </div>
                       </div>
                   </div>


           </nav>
           <!-- /.sidebar-menu -->
       </div>
       <!-- /.sidebar -->
   </aside>