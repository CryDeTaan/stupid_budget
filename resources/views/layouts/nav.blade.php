        <nav class="tabs is-boxed">
            <div class="nav-center">
                <ul>
                    @if (Route::has('login'))
                        @if (Auth::check())
                            <router-link to="/" exact tag="li"><a>Dashboard</a></router-link>
                            <router-link to="/accounts" tag="li"><a>Accounts</a></router-link>
                            <router-link to="/income" tag="li"><a>Income</a></router-link>
                            <router-link to="/expenses" tag="li"><a>Expenses</a></router-link>
                            <router-link to="/categories" tag="li"><a>Budget</a></router-link>
                        @else


                        @endif
                    @endif
                </ul>
            </div>
        </nav>



{{--
<li><a href="{{ url('/accounts') }}">Accounts</a></li>
<li><a href="{{ url('/income') }}">Income</a></li>
<li><a href="{{ url('/expenses') }}">Expenses</a></li>
<li><a href="{{ url('/categories') }}">Categories</a></li>

<li><a href="{{ url('/login') }}">Login</a></li>
<li><a href="{{ url('/register') }}">Register</a></li>
--}}

