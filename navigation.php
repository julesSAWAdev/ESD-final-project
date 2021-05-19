<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle" src="img/profile_small.jpg"/>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold"><?php echo $_SESSION["name"];?></span>
                                <span class="text-muted text-xs block"><?php echo $_SESSION["role"];?> <b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                             
                        </div>
                    </li>
                     
                    <li class="active">
                        <a href="dashboard"><i class="fa fa-diamond"></i> <span class="nav-label">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="schedules"><i class="fa fa-calendar"></i> <span class="nav-label">Schedules</span></a>
                    </li>
                    <li>
                        <a href="courses"><i class="fa fa-book"></i> <span class="nav-label">Courses</span></a>
                    </li>
                    <li>
                        <a href="affiliaton"><i class="fa fa-plus"></i> <span class="nav-label">Affiliation</span></a>
                    </li>
                    
                </ul>

            </div>
        </nav>