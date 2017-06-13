@extends('layouts.master')

@section('content')
    <div class="container">

        <div class="columns">
            <div class="column">
                <p class="title is-1 is-spaced has-text-centered">Login</p>

                <div class="box">
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
                                               class="input" type="email" placeholder="Email">
                                        <span class="icon is-small is-left">
                            <i class="fa fa-envelope"></i>
                        </span>
                                    </p>
                                    {{--<p class="help is-success">This email is correct</p>--}}
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
                                        <input id="password" type="password" class="input" name="password"
                                               placeholder="Password">
                                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
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
                                        <button class="button is-link">Cancel</button>
                                    </p>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                        </div>
                    </form>
                </div>
            </div>
            <div class="column">
                <p class="title is-1 is-spaced has-text-centered">Sign up</p>

                <div class="box">

                    <form role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Name</label>
                            </div>
                            <div class="field-body">
                                <div class="field is-grouped">
                                    <p class="control is-expanded has-icons-left">
                                        <input id="name" type="text" class="input" name="name" value="{{ old('name') }}"
                                               placeholder="Name">
                                        <span class="icon is-small is-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">E-Mail Address</label>
                            </div>
                            <div class="field-body">
                                <div class="field ">
                                    <p class="control is-expanded has-icons-left has-icons-right">

                                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                                               class="input" type="email" placeholder="Email">
                                        <span class="icon is-small is-left">
                                  <i class="fa fa-envelope"></i>
                                </span>
                                        {{--<span class="icon is-small is-right">--}}
                                        {{--<i class="fa fa-check"></i>--}}
                                        {{--</span>--}}
                                    </p>
                                    {{--<p class="help is-success">This email is correct</p>--}}
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
                                        <input id="password" type="password" name="password" class="input"
                                               placeholder="Password">
                                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Confirm</label>
                            </div>
                            <div class="field-body">
                                <div class="field is-grouped">
                                    <p class="control has-icons-left is-expanded">
                                        <input id="password-confirm" name="password_confirmation" class="input"
                                               type="password" placeholder="Confirm Password">
                                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Budget Start</label>
                            </div>
                            <div class="field-body">
                                <div class="field is-grouped">
                                    <p class="control has-icons-left is-expanded">
                                        <input id="budgetStartDay" name="budgetStartDay" class="input"
                                               type="text" placeholder="Day of Month, i.e. 25th">
                                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                                    </p>
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
                                        <button type="submit" class="button is-primary">Sign up</button>
                                    </p>
                                    <p class="control">
                                        <button class="button is-link">Cancel</button>
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
