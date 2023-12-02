<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            @guest
                            <li class="active"><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('all-resources', ['curriculum', 'old']) }}">Old Curriculum</a></li>
                            <li><a href="{{ route('all-resources', ['curriculum', 'new']) }}">New Curriculum</a></li>
                            <li><a href="#">Browse By</a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('all-resources', ['all', 'resources']) }}">Subjects</a></li>
                                    <li><a href="{{ route('all-resources', ['all', 'resources']) }}">Classes</a></li>
                                    <li><a href="{{ route('all-resources', ['all', 'resources']) }}">Tags</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('about') }}">About us</a></li>
                            <li><a href="{{ route('auth') }}">Login</a></li>
                            @else
                            <li><a href="{{ route('admin') }}">Dashboard</a></li>
                            <li><a href="{{ url('/') }}">View Site</a></li>
                            <li><a href="{{ route('resource-index') }}">Resources</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('subject-index') }}">Subject</a></li>
                                    <li><a href="{{ route('class-index') }}">Classes</a></li>
                                    <li><a href="{{ route('tag-index') }}">Tags</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('log-out') }}">Logout</a></li>
                            @endguest
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
