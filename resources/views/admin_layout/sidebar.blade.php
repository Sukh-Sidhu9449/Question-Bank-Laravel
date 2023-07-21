<div class="sidebar py-3 ps-3">
    <div class="logo ps-2 pt-4">
        <img class="top-logo-img" src="{{ asset('/images/Question-Bank-Logo.webp') }}" alt="logo">
    </div>
    <div class="sidebar_menu mt-4">
        <ul id="sidebarnav">
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('admin/dashboard') }}" aria-expanded="false">
                    <i class="fa-solid fa-bars-staggered"></i>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item pt-3">
                <a id="admin_profile" class="sidebar-link" href="{{ url('admin/profile') }}" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                    <span class="hide-menu">Profile</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('admin/technologies') }}" aria-expanded="false">
                    <i class="fa-solid fa-computer"></i>
                    <span class="hide-menu">Technologies</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('/admin/users') }}" aria-expanded="false">
                    <i class="fa-solid fa-users"></i>
                    <span class="hide-menu">Users</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('/admin/quiz') }}" aria-expanded="false">
                    <i class="bi bi-patch-question-fill"></i>
                    <span class="hide-menu">Schedule Interview</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('/admin/indexblock') }}" aria-expanded="false">
                    <i class="bi bi-archive-fill"></i>
                    <span class="hide-menu">View Interview Blocks</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('/admin/indexNotification') }}" aria-expanded="false">
                    <i class="bi bi-bell-fill"></i>
                    <span class="hide-menu">Statistics</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('/admin/group-interview-stats') }}" aria-expanded="false">
                    <i class="bi bi-bell-fill"></i>
                    <span class="hide-menu">Group Interview Statistics</span>
                </a>
            </li>
            <!-- <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('/admin/mcq_questions') }}" aria-expanded="false">
                    <i class="bi bi-bell-fill"></i>
                    <span class="hide-menu">MCQ Questions</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('/admin/McqQuizBlock') }}" aria-expanded="false">
                    <i class="bi bi-bell-fill"></i>
                    <span class="hide-menu">MCQ Quiz Block</span>
                </a>
            </li> -->

        </ul>
    </div>
</div>
<div class="main_section">
    <div class="navbar p-3">
        <div class=" d-flex">
            <div class="heading">
                <h4>Admin Panel</h4>
            </div>
            <div class="notification_bar" data-bs-toggle="modal" data-bs-target="#notificationModal">
                <div class="d-flex dropdown">
                    <div class="notification">
                        <i class="bi bi-bell-fill" id="bi"></i>
                    </div>
                    <div>
                        <span class="count">
                            <span class="red_circle">

                            </span>
                        </span>
                    </div>
                    <div class="modal fade" id="notificationModal" tabindex="-1"
                        aria-labelledby="notificationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="margin-top: 91px; margin-left: -123px; width: 75%; ">
                                <div class="modal-header">
                                    <h5 class="modal-title text-dark" id="notificationModalLabel">Notifications</h5>
                                </div>
                                <div class="modal-body" id="notifications_desc"
                                    class="dropdown-content notication_heading">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="dropdown">
            <div class="user_icon">
                <div class="profile m-0 p-0">
                    <img src="{{ Auth::user()->image }}" alt="user-img" width="40" height="35px"
                        class="img_circle">
                </div>
                <div class="text-black font-medium">{{ Auth::user()->name }}</div>

                <div class="dropdown-menu p-0">
                    <div>
                        <a href="{{ url('admin/profile') }}">
                            <button type="button" class="profile_details py-2">Profile</button>
                        </a>
                    </div>
                    <div>
                        <a id="logout" style="text-decoration: none; "><button type="button" class="logout py-2"
                                name="logout">Logout
                            </button>
                        </a>
                    </div>



                </div>
            </div>
        </div>
    </div>
