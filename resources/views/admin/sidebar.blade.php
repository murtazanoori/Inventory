
           <!--APP-SIDEBAR-->
           <div class="sticky">
            <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
            <div class="app-sidebar">
                <div class="side-header">
                    <a class="header-brand1" href="{{route('dashboard')}}">
                        <img src="{{asset('assets/images/brand/inventory.png')}}" class="header-brand-img desktop-logo" alt="logo">
                        <img src="{{asset('assets/images/brand/2nd.png')}}" class="header-brand-img toggle-logo"
                            alt="logo">
                        <img src="{{asset('assets/images/brand/2nd.png')}}" class="header-brand-img light-logo" alt="logo">
                        <img src="{{asset('assets/images/brand/inventory.png')}}" class="header-brand-img light-logo1"
                            alt="logo">
                    </a>
                    <!-- LOGO -->
                </div>
                <div class="main-sidemenu">
                    <ul class="side-menu">
                        <li class="sub-category">
                            <h3>Main</h3>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('dashboard')}}"><i
                                    class="side-menu__icon fa fa-home"></i><span
                                    class="side-menu__label">Dashboard</span></a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="{{route('supplier.all')}}"><i
                                    class="side-menu__icon fa fa-truck"></i><span
                                    class="side-menu__label">Manage Suppliers</span><i
                                    class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu mega-slide-menu">
                                <div class="mega-menu">
                                    <div class="">
                                        <ul>
                                            <li><a href="{{ route('supplier.all') }}" class="slide-item"> Supplier All</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </ul>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="{{route('customer.all')}}"><i
                                    class="side-menu__icon fa fa-user"></i><span
                                    class="side-menu__label">Manage Customers</span><i
                                    class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu mega-slide-menu">
                                <div class="mega-menu">
                                    <div class="">
                                        <ul>
                                            <li><a href="{{ route('customer.all') }}" class="slide-item"> Customer All</a></li>
                                            <li><a href="{{ route('customer.dailyreport') }}" class="slide-item"> Customer Report</a></li>
                                            <li><a href="{{ route('customer.paidreport') }}" class="slide-item"> Paid Customer report</a></li>
                                            <li><a href="{{ route('customer.wisereport') }}" class="slide-item"> Customer wise report</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </ul>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="{{route('unit.all')}}"><i
                                    class="side-menu__icon fa fa-cubes"></i><span
                                    class="side-menu__label">Manage Units</span><i
                                    class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu mega-slide-menu">
                                <div class="mega-menu">
                                    <div class="">
                                        <ul>
                                            <li><a href="{{ route('unit.all') }}" class="slide-item"> Units All</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </ul>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="{{route('unit.all')}}"><i
                                    class="side-menu__icon fa fa-sitemap"></i><span
                                    class="side-menu__label">Manage Categories</span><i
                                    class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu mega-slide-menu">
                                <div class="mega-menu">
                                    <div class="">
                                        <ul>
                                            <li><a href="{{ route('category.all') }}" class="slide-item"> Categories All</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </ul>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="{{route('product.all')}}"><i
                                    class="side-menu__icon fa fa-archive"></i><span
                                    class="side-menu__label">Manage Products</span><i
                                    class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu mega-slide-menu">
                                <div class="mega-menu">
                                    <div class="">
                                        <ul>
                                            <li><a href="{{ route('product.all') }}" class="slide-item"> Product All</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </ul>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="{{route('purchase.all')}}"><i
                                    class="side-menu__icon fa fa-shopping-basket"></i><span
                                    class="side-menu__label">Manage Purchases</span><i
                                    class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu mega-slide-menu">
                                <div class="mega-menu">
                                    <div class="">
                                        <ul>
                                            <li><a href="{{ route('purchase.all') }}" class="slide-item"> Purchase All</a></li>
                                            <li><a href="{{ route('purchase.pending') }}" class="slide-item">Approve Purchases</a></li>
                                            <li><a href="{{ route('purchase.dailyreport') }}" class="slide-item">Purchase Report</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </ul>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="{{route('invoice.all')}}"><i
                                    class="side-menu__icon fa fa-file-text"></i><span
                                    class="side-menu__label">Manage Invoice</span><i
                                    class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu mega-slide-menu">
                                <div class="mega-menu">
                                    <div class="">
                                        <ul>
                                            <li><a href="{{ route('invoice.all') }}" class="slide-item"> All Invoices</a></li>
                                            <li><a href="{{ route('invoice.pending') }}" class="slide-item">Approve Invoices</a></li>
                                            <li><a href="{{ route('invoice.dailyreport') }}" class="slide-item">Daily Invoice Report</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </ul>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="{{route('stock.report')}}"><i
                                    class="side-menu__icon fa fa-scribd"></i><span
                                    class="side-menu__label">Manage Stock</span><i
                                    class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu mega-slide-menu">
                                <div class="mega-menu">
                                    <div class="">
                                        <ul>
                                            <li><a href="{{ route('stock.report') }}" class="slide-item"> All Stocks</a></li>
                                            <li><a href="{{ route('stock.supplierreport') }}" class="slide-item"> Stock Supplier Report</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </ul>
                        </li>

                    </ul>
                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                        </svg></div>
                </div>
            </div>
            <!--/APP-SIDEBAR-->
        </div>
