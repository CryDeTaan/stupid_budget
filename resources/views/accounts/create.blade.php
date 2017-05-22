@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')

            <div class="container panel panel-default">
                <div class="panel-heading">
                    Add Account
                </div>

                <div class="panel-body">
                    <form method="post" action="/accounts/create">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="accountName">Account Name</label>
                            <input type="text" class="form-control" id="accountName" name="accountName" placeholder="Account Name">
                        </div>
                        <div class="form-group">
                            <label for="accountDescription">Account Description</label>
                            <textarea class="form-control" id="accountDescription" name="accountDescription" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="accountType">Account Type</label>
                            <input type="text" class="form-control" id="accountType" name="accountType" placeholder="Account Type">
                        </div>
                        <div class="form-group">
                            <label for="openingBalance">Opening Balance</label>
                            <input class="form-control" type="number" value="0" id="openingBalance" name="openingBalance">
                        </div>
                        <button type="submit" class="btn btn-info">Add Account</button>
                    </form>
                </div>
            </div>
    </div>
@endsection