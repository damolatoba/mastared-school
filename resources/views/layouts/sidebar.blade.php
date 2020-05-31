<div class="sidebar">
    <p style="text-align:center;">{{date("l, d M Y")}}</p>
    <ul class="widget widget-menu unstyled">
        <li class="active"><a href="/home"><i class="menu-icon icon-dashboard"></i>Dashboard
        </a></li>
        <li><a href="#"><i class="menu-icon icon-bullhorn"></i>Assignment </a>
        </li>
    </ul>
    <!--/.widget-nav-->
    <ul class="widget widget-menu unstyled">
        <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
        </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
        </i>{{Auth::user()->firstname.' '.Auth::user()->lastname}} </a>
            <ul id="togglePages" class="collapse unstyled">
                <li><a href="/profile"><i class="icon-inbox"></i>Your Profile </a></li>
                <li>
                                <a id="logoutbutton" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logoutform').submit();">
                                    <i class="icon-off"></i>Logout
                                </a>
                                <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!--/.sidebar-->