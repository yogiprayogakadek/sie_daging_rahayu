<header class="page-header sticky-top px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
    <div class="container-fluid">
        <nav class="navbar">
            <div class="d-flex">
                <button type="button" class="btn btn-link d-none d-xl-block sidebar-mini-btn p-0 text-primary">
                    <span class="hamburger-icon">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-link d-block d-xl-none menu-toggle p-0 text-primary">
                    <span class="hamburger-icon">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </span>
                </button>
                <a href="{{route('dashboard.index')}}" class="brand-icon d-flex align-items-center mx-2 mx-sm-3 text-primary">
                    <img src="{{asset('assets/logo/logo.png')}}" height="70">
                </a>
            </div>

            <ul class="header-right justify-content-end d-flex align-items-center mb-0">

                <li>
                    <div class="dropdown morphing scale-left user-profile mx-lg-3 mx-2">
                        <a class="nav-link dropdown-toggle rounded-circle after-none p-0" href="#" role="button"
                            data-bs-toggle="dropdown">
                            <img class="avatar img-thumbnail rounded-circle shadow" src="{{asset(account_image())}}"
                                alt="" />
                        </a>
                        <div class="dropdown-menu border-0 rounded-4 shadow p-0">
                            <div class="card border-0 w240">
                                <div class="card-body border-bottom d-flex">
                                    <img class="avatar rounded-circle" src="{{asset(account_image())}}" alt="" />
                                    <div class="flex-fill ms-3">
                                        <h6 class="card-title mb-0">{{username()}}</h6>
                                        <span class="text-muted">{{auth()->user()->role}}</span>
                                    </div>
                                </div>
                                {{-- <div class="list-group m-2 mb-3">
                                    <a class="list-group-item list-group-item-action border-0"
                                        href="page-profile.html"><i class="w30 fa fa-user"></i>My Profile</a>
                                    <a class="list-group-item list-group-item-action border-0"
                                        href="account-settings.html"><i class="w30 fa fa-gear"></i>Settings</a>
                                    <a class="list-group-item list-group-item-action border-0"
                                        href="account-billing.html"><i class="w30 fa fa-credit-card"></i>Billing</a>
                                    <a class="list-group-item list-group-item-action border-0"
                                        href="page-teamsboard.html"><i class="w30 fa fa-users"></i>Manage Team</a>
                                    <a class="list-group-item list-group-item-action border-0"
                                        href="dashboard-enevt.html"><i class="w30 fa fa-calendar"></i>My Events</a>
                                    <a class="list-group-item list-group-item-action border-0"
                                        href="page-support-ticket.html"><i class="w30 fa fa-tag"></i>Support Ticket</a>
                                </div> --}}
                                <a href="href="{{route('logout')}}"
                                    class="btn bg-secondary text-light text-uppercase rounded-0" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </nav>
    </div>
</header>