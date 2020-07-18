@section('header')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" id= "navbar-logo" >{{ Html::image('images/master.png', 'LOGO', array('class'=> 'logo')) }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @if (Auth::check() && Auth::user()->role()->first()->name == "Author")
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Lectures</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('assignment') }}">Assignments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('classlist') }}">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                    </li>
                @endif
                @if (Auth::check() && Auth::user()->role()->first()->name == "Admin")
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Lectures</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('terms') }}">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('class') }}">Classes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('subjects') }}">Subjects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">Staffs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student') }}">Enrol Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href=" {{ route('login') }}">Login</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href=" {{ route('register') }}">Register</a>
                    </li> -->
                @else
                    <li class="nav-item">
                                <a class="nav-link" id="logoutbutton" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logoutform').submit();">
                                    Logout
                                </a>
                                <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>