<div class="top_nav">
    <div class="nav_menu">
        <nav>
            {{-- <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div> --}}

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        {{ ucfirst(Auth()->user()->name) }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        {{-- <li>
                            <a href="{{ url('profile') }}"><i class="fa fa-user pull-right"></i> Profile</a>
                        </li> --}}
                        <li>
                            <a href="{{ route('logout') }}"" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>