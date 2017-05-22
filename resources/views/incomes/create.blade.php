@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')

            <div class="container panel panel-default">
                <div class="panel-heading">
                    Add Income
                </div>

                <div class="panel-body">
                    <form method="post" action="/income/create">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="incomeDescription">Income Description</label>
                            <input type="text" class="form-control" id="incomeDescription" name="incomeDescription" placeholder="Income Description">
                        </div>
                        <div class="form-group">
                            <label for="account_id">To Account</label>
                            <select class="form-control" id="account_id" name="account_id">
                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}" >{{ $account->accountName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input class="form-control" type="number" value="0" id="amount" name="amount">
                        </div>
                        <button type="submit" class="btn btn-info">Add Income</button>
                    </form>
                </div>
            </div>
    </div>
@endsection