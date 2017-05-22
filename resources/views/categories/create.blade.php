@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <div class="container panel panel-default">
            <div class="panel-heading">
                Add Category
            </div>
            <div class="panel-body">
                <form method="post" action="/categories/create">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="categoryName">Select Or Add Category</label>
                        <input type="text" list="categoryName" class="form-control" name="categoryName" placeholder="New Category"/>
                        <datalist id="categoryName">
                            @foreach($categories as $category)
                                <option selected
                                        value="{{ $category->id }}">{{ $category->categoryName }}</option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="form-group">
                        <label for="subcategoryName">Sub Category</label>
                        <input type="text" class="form-control" id="subcategoryName" name="subcategoryName"
                               placeholder="Sub Category">
                    </div>

                    <div class="form-group">
                        <label for="subcategoryBudget">Sub Category Budget</label>
                        <input type="number" class="form-control" id="subcategoryBudget" name="subcategoryBudget"
                               placeholder="Budget Amount">
                    </div>


                    <button type="submit" class="btn btn-info">Add Category</button>
                </form>
            </div>
        </div>
    </div>
@endsection