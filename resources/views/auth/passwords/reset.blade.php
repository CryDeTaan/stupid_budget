@extends('layouts.master')
@section('content')
    <div class="container">

        <p class="title is-1 is-spaced has-text-centered">Reset Password</p>

        <div class="box">
            @if (session('status'))
                <div class="notification is-success">
                    {{ session('status') }}
                </div>
            @endif

            <form role="form" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

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
                                <input id="password" type="password" name="password"
                                       class="input {{ $errors->has('password') ? ' is-danger' : '' }}"
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
                        <label class="label">Confirm</label>
                    </div>
                    <div class="field-body">
                        <div class="field is-grouped">
                            <p class="control has-icons-left is-expanded">
                                <input id="password-confirm" name="password_confirmation"
                                       class="input {{ $errors->has('password') ? ' is-danger' : '' }}"
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
                        <label class="label"></label>
                    </div>
                    <div class="field-body">
                        <div class="field is-grouped">
                            <p class="control">
                                <button type="submit" class="button is-primary">Reset Password</button>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
