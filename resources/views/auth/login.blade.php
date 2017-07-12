@extends('layouts.master')

@section('content')
    <div class="container">

        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                <p class="title is-1 is-spaced has-text-centered">Login</p>

                <div class="box">

                    @if (session('message'))
                        <div class="notification is-warning">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">E-mail Address</label>
                            </div>
                            <div class="field-body">
                                <div class="field is-grouped">
                                    <p class="control has-icons-left is-expanded">
                                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                                               class="input {{ $errors->has('email') ? ' is-danger' : '' }}"
                                               type="email" placeholder="Email">
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                    </p>
                                    @if ($errors->has('email'))
                                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Password</label>
                            </div>
                            <div class="field-body">
                                <div class="field is-grouped">
                                    <p class="control has-icons-left is-expanded">
                                        <input id="password" type="password"
                                               class="input {{ $errors->has('password') ? ' is-danger' : '' }}"
                                               name="password"
                                               placeholder="Password">
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </p>
                                    @if ($errors->has('password'))
                                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label"></label>
                            </div>
                            <div class="field-body">
                                <div class="field is-grouped">
                                    <p class="control">
                                        <label class="checkbox">
                                            <input type="checkbox"
                                                   name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            Remember Me
                                        </label>
                                    </p>
                                    {{--<p class="help is-success">This email is correct</p>--}}
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label"></label>
                            </div>
                            <div class="field-body">
                                <div class="field is-grouped">
                                    <p class="control">
                                        <button type="submit" class="button is-primary">Login</button>
                                    </p>
                                    <p class="control">
                                        <button class="button is-link"><a href="/password/reset">Forgot Password</a>
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
