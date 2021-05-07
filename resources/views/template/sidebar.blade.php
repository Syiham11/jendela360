 <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <section class="sidebar ">
                <div class="page-sidebar  sidebar-nav">
                    <br><br>
                    <div class="nav_icons">
                        <ul class="sidebar_threeicons">
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul class="page-sidebar-menu" id="menu">
                        <li>
                            <a href="{{url('welcome')}}">
                                <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="livicon" data-name="medal" data-size="18" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
                                <span class="title">Parameter</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{url('car')}}">
                                        <i class="fa fa-angle-double-right"></i> Mobil
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('sale')}}">
                                        <i class="fa fa-angle-double-right"></i> Penjualan
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('welcome')}}">
                                        <i class="fa fa-angle-double-right"></i> Repot
                                    </a>
                                </li>

                            </ul>
                        </li>
                      </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
            </section>
            <!-- /.sidebar -->
        </aside>
