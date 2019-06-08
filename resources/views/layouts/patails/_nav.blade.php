    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
            <a class="navbar-brand" href="{{route('home')}}">{{ config('app.name', 'Laravel') }}</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                  {{-- <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                      <span class="sr-only">(current)</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                  </li> --}}
                  @guest
                  <li><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i>&nbsp;เข้าสู่ระบบ</a></li>
                  <li><a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i>&nbsp;สมัครสมาชิก</a></li>
                  @else
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{route('order.history')}}"><i class="fas fa-folder-open"></i>&nbsp;ประวัติการสั่งซื้อ</a>
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                  <i class="fas fa-sign-out-alt"></i>&nbsp;ออกจากระบบ
                              </a>
                              @if(Auth::user()->admin==1)
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="{{route('admin.index')}}"><i class="fab fa-elementor"></i>&nbsp;สำหรับผู้ดูแลระบบ</a>
                              @endif
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                      </div> 
                  </li>
                  @endguest  
                  <li class="nav-item">
                      <a class="nav-link" href="{{route('cart.index')}}"><i class="fas fa-shopping-cart"></i>&nbsp;ตะกร้าสินค้า&nbsp;<span class="badge badge-primary" id="count_cart">{{Cart::count()}}</span></a>
                  </li>               
                </ul>
              </div>
            </div>
          </nav>