<div class="container">
    <nav class="nav">

        <div class="nav-left">
            <a class="nav-item" href="{{ url('/') }}">
                {{ config('app.name') }}
            </a>
        </div>

        <!-- This "nav-toggle" hamburger menu is only visible on mobile -->
        <!-- You need JavaScript to toggle the "is-active" class on "nav-menu" -->
        <span class="nav-toggle">
    <span></span>
    <span></span>
    <span></span>
  </span>

        <!-- This "nav-menu" is hidden on mobile -->
        <!-- Add the modifier "is-active" to display it on mobile -->
        <div class="nav-right nav-menu">
            @if (Route::has('login'))
            @if (Auth::check())
            <a class="nav-item">
                Logged in as &nbsp; <strong>{{ Auth::user()->name }}</strong>
            </a>
            <a class="nav-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}
            </form>
            @else

            <div class="nav-item">
                <a class="button is-primary is-outlined" href="{{ url('/login') }}">Login</a>
            </div>
            <div class="nav-item">
                <a class="button is-primary" href="{{ url('/register') }}">Sign Up</a>
            </div>
        </div>
        @endif

        @endif
</div>
</nav>
</div>