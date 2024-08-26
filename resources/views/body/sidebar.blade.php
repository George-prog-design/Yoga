<div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!-- User details -->


                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="{{route('dashboard')}}" class="waves-effect">
                                    <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="calendar.html" class=" waves-effect">
                                    <i class="ri-calendar-2-line"></i>
                                    <span>Calendar</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ri-mail-send-line"></i>
                                    <span>Home slide setup</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">

                                    <li><a href="{{route('home.slide')}}">Home slide</a></li>
                                </ul>
                                <ul class="sub-menu" aria-expanded="false">

                                    <li><a href="{{route('about.multi.image')}}">About Multi Images</a></li>
                                </ul>
                                <ul class="sub-menu" aria-expanded="false">

                                    <li><a href="{{route('all.multi.image')}}">About Multi Images</a></li>
                                </ul>
                            </li>



                            <li class="menu-title">Pages</li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ri-mail-send-line"></i>
                                    <span>Manage Suppliers</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('supplier.all') }}">All Suppliers</a></li>

                                </ul>
                            </li>










                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
