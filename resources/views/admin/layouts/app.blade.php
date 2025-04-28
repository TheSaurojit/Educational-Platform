<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>

    <meta charset="utf-8" />

    <title>@yield('title', 'Maths-matchmaker')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/admin/assets/images/favicon.ico">



    <!-- Bootstrap Css -->
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/admin/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- App js -->
    <script src="/admin/assets/js/plugin.js"></script>


    <!-- DataTables -->
    <link href="/admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="/admin/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="/admin/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />


    @yield('head-section')

    <style>
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .custom-toast {
            padding: 12px;
            margin-bottom: 10px;
            min-width: 250px;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            opacity: 0;
            transform: translateX(100%);
            animation: fadeIn 0.3s ease forwards;
        }

        .custom-toast.success {
            background-color: #4CAF50;
        }

        .custom-toast.error {
            background-color: #f44336;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }
    </style>


</head>

<body data-sidebar="dark">

    <div class="toast-container" id="toastContainer"></div>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        {{-- <a href="/" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="/admin/assets/images/logo.svg" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="/admin/assets/images/logo.svg" alt="" height="17">
                            </span>
                        </a>

                        <a href="/" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="/admin/assets/images/logo.svg" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="/admin/assets/images/logo.svg" alt="" height="19">
                            </span>
                        </a> --}}
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->


                </div>

                <div class="d-flex">



                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="https://www.shutterstock.com/image-vector/user-account-avatar-icon-pictogram-600nw-1860375778.jpg"
                                alt="Header Avatar">

                            <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ Auth::user()->email }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->

                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="POST" class="dropdown-item text-danger">
                                @csrf
                                <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                                <button class="btn-danger" type="submit" key="t-logout">Logout</button>
                            </form>
                        </div>
                    </div>



                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">

                        <li>
                            <a href="#">
                                <i class="bx bx-user-circle"></i>
                                <span key="t-dashboards">Users </span>
                            </a>
                        </li>

                        {{-- @auth

                            @if (Auth::user()->is_admin)
                                <li>
                                    <a href="{{ route('admin.dashboard') }}">
                                        <i class="bx bx-user-circle"></i>
                                        <span key="t-dashboards">Admin Dashboard</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('admin.all-users') }}">
                                        <i class="bx bx-user-circle"></i>
                                        <span key="t-dashboards">Users</span>
                                    </a>
                                </li>


                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-user-circle"></i>
                                        <span key="t-authentication">Users KYC</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{ route('admin.all-kyc-view', ['status' => 'pending']) }}"
                                                key="t-register">Pending KYC</a></li>
                                        <li><a href="{{ route('admin.all-kyc-view', ['status' => 'active']) }}"
                                                key="t-register">Active KYC</a></li>
                                    </ul>
                                </li>


                                <li>

                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-user-circle"></i>
                                        <span key="t-authentication">Investments</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{ route('admin.all-investments') }}">
                                                Manage Capital
                                            </a></li>
                                        <li><a href="{{ route('admin.all-transactions') }}">
                                                Manage Transactions</a></li>
                                    </ul>

                                </li>


                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-user-circle"></i>
                                        <span key="t-authentication">Page Settings</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">

                                        <li>
                                            <a href="{{ route('admin.home-settings') }}" key="t-register">Home Page</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.about-settings') }}" key="t-register">About Page</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('admin.contact-settings') }}" key="t-register">Contact
                                                Page</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('admin.social-settings') }}" key="t-register">Social Media
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('admin.download-settings') }}" key="t-register">Downloads
                                                Section </a>
                                        </li>


                                    </ul>
                                </li>


                                <li>
                                    <a href="{{ route('admin.all-branches') }}">
                                        <i class="bx bx-user-circle"></i>
                                        <span key="t-dashboards">Branch Settings</span>
                                    </a>
                                </li>


                                <li>
                                    <a href="{{ route('admin.all-gallery') }}">
                                        <i class="bx bx-user-circle"></i>
                                        <span key="t-dashboards">Gallery Settings</span>
                                    </a>
                                </li>


                                <li>
                                    <a href="{{ route('admin.all-terms') }}">
                                        <i class="bx bx-user-circle"></i>
                                        <span key="t-dashboards">Terms & Conditions </span>
                                    </a>
                                </li>

                            @else
                                <li>
                                    <a href="{{ route('user.dashboard') }}">
                                        <i class="bx bx-user-circle"></i>
                                        <span key="t-dashboards">User Dashboard</span>
                                    </a>
                                </li>

                                @if (!Auth::user()->bankDetails?->is_kyc_verified)
                                    <li>
                                        <a href="{{ route('user.kyc') }}">
                                            <i class="bx bx-user-circle"></i>

                                            <span key="t-dashboards">KYC</span>
                                        </a>
                                    </li>
                                @endif

                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-user-circle"></i>
                                        <span key="t-authentication">Investments</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li>
                                            <a href="{{ route('user.investments') }}">
                                                Investment Portfolio
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('user.refInvestments') }}">
                                                Referral Portfolio
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="{{ route('user.shareReferral') }}">
                                        <i class="bx bx-user-circle"></i>
                                        <span key="t-dashboards">Share Referral </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('user.profile') }}">
                                        <i class="bx bx-user-circle"></i>
                                        <span key="t-dashboards">Profile </span>
                                    </a>
                                </li>

                            @endif

                        @endauth --}}



                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    @yield('body-section')

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


        </div>
        <!-- end main content-->


    </div>
    <!-- END layout-wrapper -->


    <!-- JAVASCRIPT -->

    <script src="/admin/assets/libs/jquery/jquery.min.js"></script>
    <script src="/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/admin/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/admin/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/admin/assets/libs/node-waves/waves.min.js"></script>

    <!-- Required datatable js -->
    <script src="/admin/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Buttons examples -->
    <script src="/admin/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/admin/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="/admin/assets/libs/jszip/jszip.min.js"></script>
    <script src="/admin/assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="/admin/assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="/admin/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/admin/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/admin/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>


    <!-- Responsive examples -->
    <script src="/admin/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/admin/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>


    <!-- Datatable init js -->
    <script src="/admin/assets/js/pages/datatables.init.js"></script>

    <!-- App js -->
    <script src="/admin/assets/js/app.js"></script>

    @yield('script-section')

    <script>
        window.onload = function() {
            @if (session('success'))

                showToast('success', "{{ session('success') }}");
            @endif


            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    showToast('error', "{{ $error }}");
                @endforeach
            @endif

        };

        function showToast(type, message) {

            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.classList.add('custom-toast', type);
            toast.innerText = message;
            toast.style.marginBottom = "10px";
            toast.style.fontSize = "12px";

            toastContainer.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = "fadeOut 0.3s ease forwards";
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>

</body>



</html>
