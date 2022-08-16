<nav class="navbar-custom-menu navbar navbar-expand-lg m-0">
    <div class="sidebar-toggle-icon" id="sidebarCollapse">
        sidebar toggle<span></span>
    </div>
    <!--/.sidebar toggle icon-->
    <div class="d-flex flex-grow-1">
        <ul class="navbar-nav flex-row align-items-center ml-auto">
            {{-- <li class="nav-item dropdown quick-actions">
                <a class="nav-link dropdown-toggle" href="index.html#" data-toggle="dropdown">
                    <i class="typcn typcn-th-large-outline"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="nav-grid-row row">
                        <a href="index.html#" class="icon-menu-item col-4">
                            <i class="typcn typcn-cog-outline d-block"></i>
                            <span>Settings</span>
                        </a>
                        <a href="index.html#" class="icon-menu-item col-4">
                            <i class="typcn typcn-group-outline d-block"></i>
                            <span>Users</span>
                        </a>
                        <a href="index.html#" class="icon-menu-item col-4">
                            <i class="typcn typcn-puzzle-outline d-block"></i>
                            <span>Components</span>
                        </a>
                        <a href="index.html#" class="icon-menu-item col-4">
                            <i class="typcn typcn-chart-bar-outline d-block"></i>
                            <span>Profits</span>
                        </a>
                        <a href="index.html#" class="icon-menu-item col-4">
                            <i class="typcn typcn-time d-block"></i>
                            <span>New Event</span>
                        </a>
                        <a href="index.html#" class="icon-menu-item col-4">
                            <i class="typcn typcn-edit d-block"></i>
                            <span>Tasks</span>
                        </a>
                    </div>
                </div>
            </li> --}}
            <!--/.dropdown-->
            {{-- <li class="nav-item">
                <a class="nav-link" href="chat.html"><i class="typcn typcn-messages"></i></a>
            </li>
            <li class="nav-item dropdown notification">
                <a class="nav-link dropdown-toggle badge-dot" href="index.html#" data-toggle="dropdown">
                    <i class="typcn typcn-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <h6 class="notification-title">Notifications</h6>
                    <p class="notification-text">You have 2 unread notification</p>
                    <div class="notification-list">
                        <div class="media new">
                            <div class="img-user"><img src="{{ asset('admin') }}/assets/dist/img/avatar.png"
                                    alt=""></div>
                            <div class="media-body">
                                <h6>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</h6>
                                <span>Mar 15 12:32pm</span>
                            </div>
                        </div>
                        <!--/.media -->
                        <div class="media new">
                            <div class="img-user online"><img src="{{ asset('admin') }}/assets/dist/img/avatar2.png"
                                    alt=""></div>
                            <div class="media-body">
                                <h6><strong>Joyce Chua</strong> just created a new blog post</h6>
                                <span>Mar 13 04:16am</span>
                            </div>
                        </div>
                        <!--/.media -->
                        <div class="media">
                            <div class="img-user"><img src="{{ asset('admin') }}/assets/dist/img/avatar3.png"
                                    alt=""></div>
                            <div class="media-body">
                                <h6><strong>Althea Cabardo</strong> just created a new blog post</h6>
                                <span>Mar 13 02:56am</span>
                            </div>
                        </div>
                        <!--/.media -->
                        <div class="media">
                            <div class="img-user"><img src="{{ asset('admin') }}/assets/dist/img/avatar4.png"
                                    alt=""></div>
                            <div class="media-body">
                                <h6><strong>Adrian Monino</strong> added new comment on your photo</h6>
                                <span>Mar 12 10:40pm</span>
                            </div>
                        </div>
                        <!--/.media -->
                    </div>
                    <!--/.notification -->
                    <div class="dropdown-footer"><a href="index.html">View All Notifications</a></div>
                </div>
                <!--/.dropdown-menu -->
            </li> --}}
            <!--/.dropdown-->
            <li class="nav-item dropdown user-menu">
                <a class="nav-link nav-link-new dropdown-toggle" data-toggle="dropdown" style="background: none !important;">
                    <img src="{{ asset('admin') }}/assets/dist/img/avatar-1.jpg" class="img-fluid rounded-circle" alt="">
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header d-sm-none">
                        <a class="header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <div class="user-header">
                        <div class="img-user">
                            <img src="{{ asset('admin') }}/assets/dist/img/avatar-1.jpg" alt="">
                        </div><!-- img-user -->
                        <h6>{{Auth::user()->name}}</h6>
                        <span><a href="cdn-cgi/l/email-protection" class="__cf_email__"
                                data-cfemail="2f4a574e425f434a6f48424e4643014c4042">{{Auth::user()->email}}</a></span>
                    </div><!-- user-header -->
                    {{-- <a href="index.html" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                    <a href="index.html" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
                    <a href="index.html" class="dropdown-item"><i class="typcn typcn-arrow-shuffle"></i> Activity
                        Logs</a> --}}
                    <a href="{{ route('editSingleUser', Auth::user()->id) }}" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account
                        Settings</a>
                    <a href="http://bhulua.thememinister.com/page-signin.html" class="dropdown-item"
                        href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"><i
                            class="typcn typcn-key-outline"></i> Sign Out</a>
                    {{-- <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                 </a> --}}

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <!--/.dropdown-menu -->
            </li>
        </ul>
        <!--/.navbar nav-->

    </div>
</nav>
<!--/.navbar-->
