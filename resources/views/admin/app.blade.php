<!DOCTYPE html>
<html>
    <head>
        @include('admin.layout.meta')
    </head>
    <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
    <!-- the fixed layout is not compatible with sidebar-mini -->
    <?php
    $uicomponent = App\Model\admin\AdminSetting::getUserDesignLayout();
    $admin_ui_skin = isset($uicomponent->ui_skin)?$uicomponent->ui_skin:'skin-blue';
    ?>
    <body class="hold-transition {{ $admin_ui_skin }} fixed sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            @include('admin.layout.header')
            <!-- Left side column. contains the sidebar -->
            @include('admin.layout.menu')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>@yield('content-header')</h1>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            @if (Session::has('message'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('message') }}
                            </div>
                            @endif
                            @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('success_message') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    @section('content')
                    @show
                </section>
                <div class="clearfix"></div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            @include('admin.layout.footer')
        </div>
        <!-- ./wrapper -->
        @include('admin.layout.script')
    </body>
</html>