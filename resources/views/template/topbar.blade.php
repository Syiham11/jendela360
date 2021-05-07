<body class="skin-josh">
    <header class="header">
        <a href="index.html" class="logo">
            Jendela360
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <div>
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <div class="responsive_nav"></div>
                </a>
            </div>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <div class="riot">
                                <div>
                                    user
                                    <span>
                                        <i class="caret"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                <img src="{{asset ('/assets/img/author/avatar3.jpg')}}" width="90" class="img-circle img-responsive" height="90" alt="User Image" />
                                <p class="topprofiletext">Admin</p>
                            </li>
                            <!-- Menu Body -->

                            <li role="presentation"></li>
                            <li>
                                <a href="{{url('logout')}}"> logout </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
