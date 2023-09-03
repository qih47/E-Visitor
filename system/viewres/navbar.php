    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-lg navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav col-6">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" id="bars" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item ">

                <?php
                if (isset($_SESSION['pesan'])) {
                    if ($_SESSION['pesan'] == "loginback") {
                        echo "<div id='alert' name='alert' class='alert alert-success'><strong>Login Berhasil!</strong> Selamat datang kembali $_SESSION[nama] !</div>";
                    }
                    $_SESSION['pesan'] = "";
                }
                ?>
            </li>
            <!-- <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li> -->
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav" style="margin-left: 44.9%;">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li> -->
        </ul>
    </nav>
    <!-- /.navbar -->