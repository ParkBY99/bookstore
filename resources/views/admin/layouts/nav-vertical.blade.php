<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo -->
    <a href="{{url('admin/index.html')}}" class="brand-link">
        {{--<img src="" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
        <span class="brand-text font-weight-light" style="color: rgb(188,88,38);">
            <b style="font-size: 38px;">&nbsp; LW</b><span style="font-size: 28px">-Book</span>store
        </span>
    </a>

    <!-- Sidebar 侧边栏 -->
    <div class="sidebar">

        <!-- Sidebar Menu 侧边栏菜单-->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            图书管理
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/books/category')}}" class="nav-link">&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="nav-icon fas fa-book"></i>
                                <p>图书分类管理</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/books/book')}}" class="nav-link">&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="nav-icon fas fa-bookmark"></i>
                                <p>图书详情管理</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/books/comment')}}" class="nav-link">&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="nav-icon fas fa-book-reader"></i>
                                <p>图书评论管理</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-indent"></i>
                        <p>
                            订单管理
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link">&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="nav-icon fas fa-book"></i>
                                <p>订单列表</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index2.html" class="nav-link">&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="nav-icon fas fa-book"></i>
                                <p>订单报表</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            动态管理
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link">&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="nav-icon fas fa-book"></i>
                                <p>动态详情管理</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            用户管理
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link">&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="nav-icon fas fa-book"></i>
                                <p>用户详情列表</p>

                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>