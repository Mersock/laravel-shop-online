        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                            {{ config('app.name', 'Laravel') }}
                    </a>
                </li>
                <li>
                        <a href="{{route('category.index')}}">หมวดหมู่สินค้า</a>
                </li>
                <li>
                    <a href="{{route('product.index')}}">สินค้า</a>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="false" aria-controls="collapseOrder">รายการสั่งซื้อ&nbsp;<i class="fas fa-arrow-circle-down"></i></a>
                </li>
                    <ul class="sidebar-nav-submenu collapse"  id="collapseOrder">
                        <li><a href="{{url('admin/orders/')}}">ทั้งหมด</a></li>
                        <li><a href="{{url('admin/orders/pending')}}">กำลังดำเนินการ</a></li>
                        <li><a href="{{url('admin/orders/delivered')}}">จัดส่งแล้ว</a></li>
                    </ul>
                <li>
                    <a href="{{ route('home') }}">หน้าแสดงสินค้า</a>
                </li>
                @guest
                <li><a href="{{ route('login') }}">เข้าสู่ระบบ</a></li>
                <li><a href="{{ route('register') }}">สมัครสมาชิก</a></li>
                @else
                <li class="dropdown">
                    <a href="#" >
                            <i class="fas fa-user-tie"></i>&nbsp;{{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="sidebar-nav-submenu">
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                ออกจากระบบ
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @endguest
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        