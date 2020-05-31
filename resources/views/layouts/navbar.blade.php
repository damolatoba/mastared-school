<div class="navbar navbar-fixed-top">
    <style>
        .logo{
            height:35px;
        }
    </style>
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <i class="icon-reorder shaded"></i></a><a class="brand" href="/home">{{ Html::image('images/master.png', 'LOGO', array('class'=> 'logo')) }}</a>
            <div class="nav-collapse collapse navbar-inverse-collapse">
                <ul class="nav pull-right">
                    <li><a href="/profile">{{Auth::user()->username}} </a></li>
                    <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    {{ Html::image('images/user.png', 'AVATAR', array('class'=> 'nav-avatar')) }}
                        <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/profile">Your Profile</a></li>
                            <li class="divider"></li>
                            <li><a id="logoutbutton" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logoutform').submit();">
                                    Logout
                                </a>
                                <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.nav-collapse -->
        </div>
    </div>
    <!-- /navbar-inner -->
</div>