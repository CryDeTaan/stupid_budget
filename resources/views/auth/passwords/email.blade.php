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

        <form role="form" method="POST" action="{{ route('password.email') }}">
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
        </div>
    </div>
</div>
@endsection
