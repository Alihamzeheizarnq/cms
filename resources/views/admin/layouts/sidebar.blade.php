<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.') }}" class="brand-link">
        <img src="/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image mr-2">
                    <img src="{{ asset('img/admin.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info mr-1">
                    <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <a href="{{ route('admin.') }}" class="nav-link {{ isActive('admin.') }}">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            داشبورد
                            <i class="right fa "></i>
                        </p>
                    </a>
                    @can('show_users')
                    <li class="nav-item has-treeview {{ isActive(['admin.users.index' , 'admin.users.edit' , 'admin.users.create','admin.user.permissions'],'menu-open') }}">
                        <a href="#" class="nav-link {{ isActive(['admin.users.index' , 'admin.users.edit' , 'admin.users.create'],'active') }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                کاربران
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link {{ isActive('admin.users.index') }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست کاربران</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{--//end users--}}
                    @endcan


                    <li class="nav-item has-treeview {{ isActive(['admin.permissions.index' , 'admin.permissions.create' , 'admin.roles.edit','admin.roles.index' , 'admin.roles.create' , 'admin.permissions.edit'],'menu-open') }}">
                        <a href="#" class="nav-link {{ isActive(['admin.permissions.index' , 'admin.permissions.edit' , 'admin.permissions.create'],'active') }}">
                            <i class="nav-icon fa fa-lock"></i>
                            <p>
                                بخش اجازه دسترسی
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ isActive('admin.permissions.index') }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست دسترسی ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}" class="nav-link {{ isActive('admin.roles.index') }} ">
                                    <i class="fa fa-circle-o nav-icon "></i>
                                    <p>لیست مقام ها</p>
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li class="nav-item has-treeview {{ isActive(['admin.products.index' , 'admin.products.create','admin.products.edit' ],'menu-open') }}">
                        <a href="#" class="nav-link {{ isActive(['admin.products.index' , 'admin.products.edit','admin.products.create'],'active') }}">
                            <i class="nav-icon fa fa-product-hunt"></i>
                            <p>
                                محصولات
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.products.index') }}" class="nav-link {{ isActive('admin.products.index') }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست محصولات</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item has-treeview {{ isActive(['admin.comments.index' , 'admin.comments.create','admin.comments.edit' ],'menu-open') }}">
                        <a href="#" class="nav-link {{ isActive(['admin.comments.index' , 'admin.comments.edit','admin.comments.create'],'active') }}">
                            <i class="nav-icon fa fa-comment"></i>
                            <p>
                                مدیریت نظرات
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.comments.index') }}" class="nav-link {{ isActive('admin.comments.index') }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>
                                        لیست نظرات
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>




                    <li class="nav-item has-treeview {{ isActive(['admin.categories.index' , 'admin.categories.create','admin.categories.edit' ],'menu-open') }}">
                        <a href="#" class="nav-link {{ isActive(['admin.categories.index' , 'admin.categories.edit','admin.categories.create'],'active') }}">
                            <i class="nav-icon fa fa-tags"></i>
                            <p>
                                دسته بندی ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ isActive('admin.categories.index') }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>
                                        لیست دسته بندی ها
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
