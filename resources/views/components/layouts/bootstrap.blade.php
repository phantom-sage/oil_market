<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css");
    </style>
</head>
<body style="font-family: 'Cairo', sans-serif;">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">{{ __('launcher.menu') }}</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="{{ route('launcher') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">{{ __('launcher.home') }}</span>
                            </a>
                        </li>
                        <!-- customers menu -->
                        <li class="my-3">
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-5 border rounded align-middle shadow-sm">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">{{ __('launcher.customers') }}</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('customers.create') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">{{ __('launcher.add_customer') }}</span></a>
                                </li>
                            </ul>
                        </li>
                        <!-- units menu -->
                        <li class="mb-3">
                            <a href="#unitsSubmenu" data-bs-toggle="collapse" class="nav-link px-5 border rounded shadow-sm align-middle">
                                <i class="fs-4 bi-gear"></i> <span class="ms-1 d-none d-sm-inline">{{ __('launcher.units') }}</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="unitsSubmenu" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('units.create') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">{{ __('launcher.add_unit') }}</span></a>
                                </li>
                            </ul>
                        </li>
                        <!-- vendors menu -->
                        <li class="mb-3">
                            <a href="#vendorsSubmenu" data-bs-toggle="collapse" class="nav-link px-5 border rounded shadow-sm align-middle">
                                <i class="fs-4 bi-gear-wide-connected"></i> <span class="ms-1 d-none d-sm-inline">{{ __('launcher.vendors') }}</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="vendorsSubmenu" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('vendors.create') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">{{ __('launcher.add_vendor') }}</span></a>
                                </li>
                            </ul>
                        </li>
                        <!-- groups menu -->
                        <li class="mb-3">
                            <a href="#groupsSubmenu" data-bs-toggle="collapse" class="nav-link px-5 border rounded shadow-sm align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">{{ __('launcher.groups') }}</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="groupsSubmenu" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('groups.create') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">{{ __('launcher.add_group') }}</span></a>
                                </li>
                            </ul>
                        </li>
                        <!-- items menu -->
                        <li>
                            <a href="#itemsSubmenu" data-bs-toggle="collapse" class="nav-link px-5 border rounded shadow-sm align-middle">
                                <i class="fs-4 bi-gear"></i> <span class="ms-1 d-none d-sm-inline">{{ __('launcher.items') }}</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="itemsSubmenu" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('items.create') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">{{ __('launcher.add_item') }}</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span></a>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Bootstrap</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 1</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 2</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 3</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 4</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- injected content -->
            <div class="col py-3">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
