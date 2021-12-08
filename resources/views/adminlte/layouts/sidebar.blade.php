<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{--<a href="{{ route('cabinet') }}" class="brand-link">--}}
    <a href="{{ route('cabinet') }}" class="brand-link">
        {{-- <img src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
        <span class="brand-text font-weight-light ml-4" >Администратор</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item" id="sellers">
                    <a href="{{ route('admin.seller.index') }}" class="nav-link {{\Illuminate\Support\Facades\Route::currentRouteName() === 'admin.seller.index' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Продавцы
                        </p>
                    </a>
                </li>

                <li class="nav-item" id="admins">
                    <a href="{{ route('admin.user.index') }}" class="nav-link {{\Illuminate\Support\Facades\Route::currentRouteName() === 'admin.user.index' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Администраторы
                        </p>
                    </a>
                </li>

                <li class="nav-item" id="points">
                    <a href="{{ route('admin.point.index') }}" class="nav-link {{\Illuminate\Support\Facades\Route::currentRouteName() === 'admin.point.index' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Торговые точки
                        </p>
                    </a>
                </li>

                <li class="nav-item" id="hows">
                    <a href="{{ route('admin.promocode.index') }}" class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'admin.promocode.index' ? 'active' : '' }}">
                        <i class="nav-icon far fa-star"></i>
                        <p>
                            Промокоды
                        </p>
                    </a>
                </li>

                {{--<li class="nav-item" id="materials">
                    <a href="{{ route('cabinet.material') }}" class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'cabinet.material' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-air-freshener"></i>
                        <p>
                            Рекламные материалы
                        </p>
                    </a>
                </li>

                <li class="nav-item" id="orders">
                    <a href="{{ route('cabinet.orders') }}" class="nav-link {{\Illuminate\Support\Facades\Route::currentRouteName() == 'cabinet.orders' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-gift"></i>
                        <p>
                            Заказы
                        </p>
                    </a>
                </li>

                <li class="nav-item" id="payments">
                    <a href="{{ route('cabinet.profit') }}" class="nav-link {{\Illuminate\Support\Facades\Route::currentRouteName() == 'cabinet.profit' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-funnel-dollar"></i>
                        <p>
                            Мой доход
                        </p>
                    </a>
                </li> --}}


                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt nav-icon "></i>
                        <p>Выход</p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
