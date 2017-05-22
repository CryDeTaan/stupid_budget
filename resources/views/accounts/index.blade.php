@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')

            <div class="container panel panel-default">
                <div class="panel-heading">
                    Accounts
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                        <th>Account</th>
                        <th>Account Type</th>
                        <th>Account Balance</th>
                        <th></th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($accounts as $account)
                            <tr>
                                <!-- Account Name -->
                                <td class="table-text">
                                    <div>{{ $account->accountName }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $account->accountType }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ number_format($account->balance, 2, ',', ' ') }}</div>
                                </td>
                                <td>
                                    <form action="{{ url('accounts/'.$account->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" id="delete-account-{{ $account->id }}" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        <td class="table-text">
                            <div><strong>Total</strong></div>
                        </td>
                        <td class="table-text">
                            <div> </div>
                        </td>
                        <td class="table-text">
                            <div><strong>{{ number_format($accounts->sum('balance'), 2, ',', ' ') }}</strong></div>
                        </td>
                        <td class="table-text">
                            <div> </div>
                        </td>

                        </tbody>
                    </table>
                    <button type="button" class="btn btn-info" onclick="location.href = '/accounts/create';">Add Account</button>
                </div>
            </div>
    </div>
@endsection