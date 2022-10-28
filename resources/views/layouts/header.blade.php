<div class="container-fluid nav-bar bg-transparent">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center text-center">
            
            <div class="">
                <img class="img-fluid" src="{{ asset('logo.png') }}" alt="Icon" style="width: 203px; height: 70px;">
            </div>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        @guest
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Browse By</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="{{ route('all-resources', ['all', 'resources']) }}" class="dropdown-item">Subjects</a>
                        <a href="{{ route('all-resources', ['all', 'resources']) }}" class="dropdown-item">Classes</a>
                        <a href="{{ route('all-resources', ['all', 'resources']) }}" class="dropdown-item">Tags</a>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="nav-item nav-link">About</a>
                <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
            </div>
            <a href="{{ route('auth') }}" class="btn btn-primary px-3 d-none d-lg-flex">Login/Register</a>
        </div>
        @else
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="{{ route('admin') }}" class="nav-item nav-link">Dashboard</a>
                <a href="{{ url('/') }}" class="nav-item nav-link">View Site</a>
                <a href="{{ route('resource-index') }}" class="nav-item nav-link">Resources</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="{{ route('subject-index') }}" class="dropdown-item">Subject</a>
                        <a href="{{ route('class-index') }}" class="dropdown-item">Classes</a>
                        <a href="{{ route('tag-index') }}" class="dropdown-item">Tags</a>
                    </div>
                </div>
                <a href="#" class="nav-item nav-link active">Users</a>
            </div>
            <a href="{{ route('log-out') }}" class="btn btn-primary px-3 d-none d-lg-flex">Logout</a>
        </div>
        @endguest

    </nav>
</div>
