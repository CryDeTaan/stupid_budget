<section class="hero is-info">
    <!-- Hero header: will stick at the top -->
    <div class="hero-head is-info">
        <header class="nav">
            <div class="container">
                <div class="nav-left">
                    <a class="nav-item">
                        <img src="images/living_stratus_grey.png" alt="Logo">
                    </a>
                </div>
                <span class="nav-toggle">
          <span></span>
          <span></span>
          <span></span>
        </span>

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
                            <a class="nav-item" href="{{ url('/login') }}">Login</a>
                            <a class="nav-item" href="{{ url('/register') }}">Register</a>
                        @endif

                    @endif
                </div>
            </div>
        </header>
    </div>

    <!-- Hero content: will be in the middle -->
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title">
                OBA 2.0
            </h1>
            <h2 class="subtitle">
                Let's Budget
            </h2>
        </div>
    </div>

    <!-- Hero footer: will stick at the bottom -->
    <div class="hero-foot">

        @include('layouts.nav')

    </div>
</section>