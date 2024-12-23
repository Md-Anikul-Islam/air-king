<!DOCTYPE html>
<html lang="en">
@php
    $siteSetting = DB::table('site_settings')->first();
@endphp
<head>
    <meta charset="utf-8"/>
    <title>Dashboard | Air King</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description"/>
    <meta content="SDMGA" name="author"/>
    <link rel="shortcut icon" href="{{asset('backend/images/favicon.ico')}}">
    <!-- Select2 css -->
    <link href="{{asset('backend/vendor/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Datatables css -->
    <link href="{{asset('backend/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('backend/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('backend/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset('backend/vendor/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet"
          href="{{asset('backend/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}">
    <script src="{{asset('backend/js/config.js')}}"></script>
    <link href="{{asset('backend/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
    <link href="{{asset('backend/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    {{-- Custom Css File here --}}
    <link rel="stylesheet" href="{{ asset('backend/css/sdmg.min.css') }}">
    <script src="{{asset('backend/js/chart.js')}}"></script>
    <script src="{{asset('backend/js/echarts.min.js')}}"></script>

</head>

<body>
<div class="wrapper">
    <div class="navbar-custom">
        <div class="topbar container-fluid">
            <div class="d-flex align-items-center gap-1">
                <!-- Sidebar Menu Toggle Button -->
                <button class="button-toggle-menu">
                    <i class="ri-menu-line"></i>
                </button>
            </div>
            <ul class="topbar-menu d-flex align-items-center gap-3">
                <li class="dropdown d-lg-none">
                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <i class="ri-search-line fs-22"></i>
                    </a>
                </li>
                <li class="d-none d-sm-inline-block">
                    <div class="nav-link" id="light-dark-mode">
                        <i class="ri-moon-line fs-22"></i>
                    </div>
                </li>
                <li class="dropdown">
                    @php
                        $admin = auth()->user();
                    @endphp
                    <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#"
                       role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <span class="d-lg-block d-none">
                              <h5 class="my-0 fw-normal">{{$admin->name}}
                                  <i class="ri-arrow-down-s-line d-none d-sm-inline-block align-middle"></i>
                              </h5>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>
                        <a href="#" class="dropdown-item">
                            <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                            <span>My Account</span>
                        </a>
                        <a href="{{ route('logout') }}" class="dropdown-item"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="leftside-menu">
        <a href="{{route('dashboard')}}" class="logo logo-light">
            @if (!empty($siteSetting->logo))
                <span class="logo-lg">
                    <img src="{{ $siteSetting->logo }}" alt="logo" style="height: 50px;">
                </span>
                <span class="logo-sm">
                    <img src="{{ $siteSetting->logo }}" alt="small logo">
                </span>
            @endif
        </a>

        <div class="h-100" id="leftside-menu-container" data-simplebar>
            <ul class="side-nav">
                <li class="side-nav-title">Main</li>
                <li class="side-nav-item">
                    <a href="{{route('dashboard')}}" class="side-nav-link">
                        <i class="ri-dashboard-3-line"></i>
                        <span> Dashboard </span>
                    </a>
                </li>


                @can('hr-section-list')
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages101" aria-expanded="false"
                           aria-controls="sidebarPages101" class="side-nav-link">
                            <i class="ri-user-2-line"></i>
                            <span>HR Payroll</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages101">
                            <ul class="side-nav-second-level">
                                @can('employee-section-list')
                                    <li>
                                        <a href="{{route('employee.section')}}">Employee Section</a>
                                    </li>
                                @endcan

                                @can('employee-list')
                                    <li>
                                        <a href="{{route('employee')}}">Employee</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan


                @can('product-design-manage')
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages102" aria-expanded="false"
                           aria-controls="sidebarPages102" class="side-nav-link">
                            <i class="ri-pencil-ruler-2-line"></i>
                            <span>Product Design</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages102">
                            <ul class="side-nav-second-level">
                                @can('color-section-list')
                                    <li>
                                        <a href="{{route('color')}}">Color</a>
                                    </li>
                                @endcan

                                @can('product-category-section-list')
                                    <li>
                                        <a href="{{route('productCategory')}}">Product Category</a>
                                    </li>
                                @endcan

                                @can('supplier-section-list')
                                    <li>
                                        <a href="{{route('supplier')}}">Supplier</a>
                                    </li>
                                @endcan

                                @can('raw-material-section-list')
                                    <li>
                                        <a href="{{route('rawMaterialSection')}}">Raw Material Section</a>
                                    </li>
                                @endcan

                                @can('raw-material-list')
                                    <li>
                                        <a href="{{route('rawMaterial')}}">Raw Material</a>
                                    </li>
                                @endcan

                                @can('product-design-list')
                                    <li>
                                        <a href="{{route('product.design')}}">Product Design</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcan

                @can('production-manage')
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages201" aria-expanded="false"
                           aria-controls="sidebarPages201" class="side-nav-link">
                            <i class="ri-tools-line"></i>
                            <span>Production</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages201">
                            <ul class="side-nav-second-level">
                                @can('block-section-list')
                                    <li>
                                        <a href="{{route('block')}}">Block</a>
                                    </li>
                                @endcan

                                @can('unit-section-list')
                                    <li>
                                        <a href="{{route('unit')}}">Unit</a>
                                    </li>
                                @endcan

                                @can('wareHouse-section-list')
                                    <li>
                                        <a href="{{route('wareHouse')}}">Warehouse</a>
                                    </li>
                                @endcan
                                @can('brand-section-list')
                                    <li>
                                        <a href="{{route('brand')}}">Brand</a>
                                    </li>
                                @endcan
                                @can('batch-section-list')
                                    <li>
                                        <a href="{{route('batch')}}">Batch</a>
                                    </li>
                                @endcan
                                @can('production-section-list')
                                    <li>
                                        <a href="{{route('production')}}">Production</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan


                @can('expense-manage')
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages301" aria-expanded="false"
                           aria-controls="sidebarPages301" class="side-nav-link">
                            <i class="ri-money-dollar-circle-line"></i>
                            <span>Expense</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages301">
                            <ul class="side-nav-second-level">
                                @can('expenseType-section-list')
                                    <li>
                                        <a href="{{route('expenseType')}}">Expense Type</a>
                                    </li>
                                @endcan
                                @can('expense-section-list')
                                    <li>
                                        <a href="{{route('expense')}}">Expense</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('sale-history-list')
                    <li class="side-nav-item">
                        <a href="{{route('sale.history')}}" class="side-nav-link">
                            <i class="ri-shopping-cart-2-line"></i>
                            <span> Sell History </span>
                        </a>
                    </li>
                @endcan


                @can('customer-section-list')
                    <li class="side-nav-item">
                        <a href="{{route('customer')}}" class="side-nav-link">
                            <i class="ri-user-line"></i>
                            <span> Customer </span>
                        </a>
                    </li>
                @endcan


                @can('site-setting')
                    <li class="side-nav-item">
                        <a href="{{route('site.setting')}}" class="side-nav-link">
                            <i class="ri-drag-move-fill"></i>
                            <span> Site Setting </span>
                        </a>
                    </li>
                @endcan


                @can('role-and-permission-list')
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages1" aria-expanded="false"
                           aria-controls="sidebarPages" class="side-nav-link">
                            <i class="ri-rotate-lock-line"></i>
                            <span>Permission Manage </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages1">
                            <ul class="side-nav-second-level">
                                @can('user-list')
                                    <li>
                                        <a href="{{url('users')}}">Create User</a>
                                    </li>
                                @endcan

                                @can('role-list')
                                    <li>
                                        <a href="{{url('roles')}}">Role & Permission</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                @yield('admin_content')
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <script>document.write(new Date().getFullYear())</script>
                        © Air King</b>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>


<script src="{{asset('backend/js/vendor.min.js')}}"></script>
<!-- Dropzone File Upload js -->
<script src="{{asset('backend/vendor/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{asset('backend/js/pages/fileupload.init.js')}}"></script>

<!--  Select2 Plugin Js -->
<script src="{{asset('backend/vendor/select2/js/select2.min.js')}}"></script>
<script src="{{asset('backend/vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('backend/vendor/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('backend/vendor/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('backend/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script
    src="{{asset('backend/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- Ckeditor Here -->
<script src="{{asset('backend/js/sdmg.ckeditor.js')}}"></script>
<!-- Datatables js -->
<script src="{{asset('backend/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-select/js/dataTables.select.min.js')}}"></script>

<!-- Datatable Demo Aapp js -->
<script src="{{asset('backend/js/pages/datatable.init.js')}}"></script>
<script src="{{asset('backend/js/pages/dashboard.js')}}"></script>
<script src="{{asset('backend/js/app.min.js')}}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        ClassicEditor.create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor.create(document.querySelector('#contentAdd'))
            .catch(error => {
                console.error(error);
            });
    });
</script>


</body>
</html>
