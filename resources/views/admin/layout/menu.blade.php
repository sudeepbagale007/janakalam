<?php
$url = Request::segment(2);
$urlx = Request::url();
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo ($urlx == route('dashboard'))?'active':''; ?>">
                <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            @if(Session::get('admin')['userid'] == '1')
            <li class="<?php echo ($urlx == route('user.list'))?'active':''; ?>">
                <a href="{{ route('user.list') }}"><i class="fa fa-th"></i> <span>User List</span></a>
            </li>
            @endif
            <?php
            $firstlevelmenu = App\Model\admin\AdminMenu::getMenu($id = 0);
            $menus = App\Model\admin\AdminMenu::getAllMenus();
            ?>
            @if(count($firstlevelmenu)>0)
            @foreach($menus as $menu)
            @if($menu->parent_id == 0)
            <?php $secondLevelMenus = App\Model\admin\AdminMenu::getMenu($menu->id); ?>
            @if(count($secondLevelMenus)>0)
            <li class="treeview <?php
                foreach($secondLevelMenus as $secondLevelMenu) {
                $urlxx = route($secondLevelMenu->menu_link);
                $lasturl = explode('/',$urlxx);
                echo ($url == end($lasturl))?'active':'';
                }
                ?>">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>{{ $menu->menu_name }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @foreach($secondLevelMenus as $secondLevelMenu)
                    <li class="<?php
                        $urlxx = route($secondLevelMenu->menu_link);
                        $lasturl = explode('/',$urlxx);
                        echo ($url == end($lasturl))?'active':'';
                        ?>">
                        <a href="{{ route("$secondLevelMenu->menu_link") }}"><i class="fa fa-circle-o"></i> {{ $secondLevelMenu->menu_name }}</a> </i></li>
                        @endforeach
                    </ul>
                </li>
                @else
                <li>
                    {{-- <a href="{{ route($menu->menu_link) }}"><span>{{ $menu->menu_name }}</span></a> --}}
                    {{-- <a href="{{ route("dashboard") }}"><span>{{ $menu->menu_name }}</span></a> --}}
                </li>
                @endif
                @endif
                @endforeach
                @endif
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>