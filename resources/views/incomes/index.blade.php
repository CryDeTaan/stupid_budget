@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <div class="container panel panel-default">
            <div class="panel-heading">
                Income

                <form method="post" action="/income/">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="fromDate">From Date</label>
                        <input type="date" class="form-control" id="fromDate" name="fromDate" value="{{ date('Y-m-d', strtotime("-30 day")) }}">
                    </div>
                    <div class="form-group">
                        <label for="toDate">To Date</label>
                        <input type="date" class="form-control" id="toDate" name="toDate" value="{{ date('Y-m-d') }}">
                    </div>
                    <button type="submit" class="btn btn-info">Search</button>
                    <button style="float: right" type="button" class="btn btn-info" onclick="location.href = '/income/create';">Add Income</button>
                </form>


                <div class="panel-body">
                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                        <th>Date</th>
                        <th>Income</th>
                        <th>Account</th>
                        <th>Amount</th>
                        <th> </th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($incomes as $income)
                            <tr>
                                <!-- Account Name -->
                                <td class="table-text">
                                    <div>{{ $income->created_at }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $income->incomeDescription }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $income->account->accountName }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ number_format($income->amount, 2, ',', ' ') }}</div>
                                </td>
                                <td>
                                    <form action="{{ url('income/'.$income->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" id="delete-account-{{ $income->id }}" class="btn btn-danger">
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
                            <div></div>
                        </td>
                        <td class="table-text">
                            <div></div>
                        </td>
                        <td class="table-text">
                            <div><strong>{{ number_format($incomes->sum('amount'), 2, ',', ' ') }}</strong></div>
                        </td>
                        <td class="table-text">
                            <div></div>
                        </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection