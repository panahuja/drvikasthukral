        <!-- BEGIN Navbar -->
        <div id="navbar" class="navbar navbar-orange">
            <button type="button" class="navbar-toggle navbar-btn collapsed" data-toggle="collapse" data-target="#sidebar">
                <span class="fa fa-bars"></span>
            </button>
            <a class="navbar-brand" href="<?php echo APPC_URL; ?>welcome.php">
                <small>
                    <i class="fa fa-desktop"></i>&nbsp;Blog Admin
                </small>
            </a>

            <!-- BEGIN Navbar Buttons -->
            <ul class="nav flaty-nav pull-right">
            
                <li class="user-profile">
                    <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                        <span class="hhh" id="user_info">
                            Administrator
                        </span>
                        <i class="fa fa-caret-down"></i>
                    </a>

                    <!-- BEGIN User Dropdown -->
                    <ul class="dropdown-menu dropdown-navbar" id="user_menu">
                        <li>
                            <a href="<?php echo APPC_URL; ?>change-password.php">
                                <i class="fa fa-cog"></i>
                                Change Password 
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo APPC_URL; ?>logout.php">
                                <i class="fa fa-off"></i>
                                Logout
                            </a>
                        </li>

                     

                      
                    </ul>
                    <!-- BEGIN User Dropdown -->
                </li>
                <!-- END Button User -->
            </ul>
            <!-- END Navbar Buttons -->
        </div>
        <!-- END Navbar -->