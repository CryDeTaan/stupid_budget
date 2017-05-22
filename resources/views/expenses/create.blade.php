@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <div class="container panel panel-default">
            <div class="panel-heading">
                Add Expense
            </div>

            <div class="panel-body">
                <form method="post" action="/expenses/create">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="expenseDescription">Expense Description</label>
                        <input type="text" class="form-control" id="expenseDescription" name="expenseDescription"
                               placeholder="Expense Description">
                    </div>
                    <div class="form-group">
                        <label for="account_id">To Account</label>
                        <select class="form-control" id="account_id" name="account_id">
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->accountName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory_id">Expense Category</label>
                        <select class="form-control" id="subcategory_id" name="subcategory_id">
                            <option selected value="">Select an Expense Category</option>
                            @foreach($categories as $category)
                                <optgroup label="{{ $category->categoryName }}">
                                    @foreach($category->subcategory as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->subcategoryName }} </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input class="form-control" type="number" value="0" id="amount" name="amount">
                    </div>
                    <button type="submit" class="btn btn-info">Add Expense</button>
                </form>
            </div>
        </div>
    </div>
@endsection