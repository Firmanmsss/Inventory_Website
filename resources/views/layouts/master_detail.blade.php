<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="WMS (Warehouse Management System) &amp; Is a System Management for Warehouse.">
    <meta name="keywords" content="WMS, Warehouse, Management, System, Warehouse Management System, web app, inventory dashboard, warehosue dashboard">
    <meta name="author" content="CREATSIGN">
    
    <title>Warehouse Management System
    </title>
    <style>
      .error{
        color:red
      }
    </style>
    @include('templates.link')
    @stack('addon-link')
  </head>
  <body class="vertical-layout vertical-menu-modern 1-column menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- fixed-top-->
    @include('layouts.topbar_detail')
    <!-- BEGIN Content-->
    <div class="content app-content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Line Awesome section start -->
                <!-- bagian judul halaman blog -->
                <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">@yield('title')</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                        @yield('breadcumb')
                        </ol>
                    </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    {{-- <div class="float-md-right">
                    @yield('btn_right')
                    </div> --}}
                </div>
                </div>
                <!-- bagian konten blog -->
                @yield('contents')
                <!-- Line Awesome section end -->
            </div>
        </div>
    </div>
    <!-- END Content-->
    <!-- START FOOTER DARK-->
    @include('layouts.footer')
    @include('templates.script')
    @stack('addon-script')
    <!-- START FOOTER DARK-->
  </body>
</html>


