<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">
        <span class="text-center pl-4 h5">Control Panel</span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block h5 pl-3">{{Sentinel::check()->first_name}} {{Sentinel::check()->last_name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-flat nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-meteor"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('user.index')}}" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('slider.index')}}" class="nav-link {{ Request::is('admin/slider*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-images"></i>
                        <p>Image Slider</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('about.index')}}" class="nav-link {{ Request::is('admin/about*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>About Us</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('service.index')}}" class="nav-link {{ Request::is('admin/service*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-hammer"></i>
                        <p>Services</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('contact.index')}}" class="nav-link {{ Request::is('admin/contact*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-phone"></i>
                        <p>Contact Info</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('project.index')}}" class="nav-link {{ Request::is('admin/project*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Manage Project</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('team.index')}}" class="nav-link {{ Request::is('admin/team*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Team</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('testimonial.index')}}" class="nav-link {{ Request::is('admin/testimonial*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-quote-left"></i>
                        <p>Testimonials</p>
                    </a>
                </li>
                <br>
                <li class="nav-item">
                    <a href="{{route('query.index')}}" class="nav-link {{ Request::is('admin/query*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-question"></i>
                        <p>
                            Queries
                            {{--<span class="right badge badge-danger">4</span>--}}
                        </p>
                    </a>
                </li>

                <hr>
                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Sign Out
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>