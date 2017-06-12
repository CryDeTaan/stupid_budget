<div id="app">
    @if (Route::has('login'))
        @if (Auth::check())
            @include('layouts.nav')
            <section class="section">
                <div class="container">
                    <router-view></router-view>
                </div>
            </section>
        @else
            <section class="section">
                <div class="container">
                    @include('layouts.landing')
                </div>
            </section>
        @endif
    @endif
</div>