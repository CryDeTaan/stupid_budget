@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <div class="container panel panel-default">
            <div class="panel-heading">
                Categories
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Deletes Categories</th>
                    <th>Categories</th>
                    <th>Sub Categories</th>
                    <th>Budget</th>
                    <th>Remaining Budget</th>
                    <th>Delete Sub Categories</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <!-- Category Name -->


                            <td>
                                <form action="{{ url('categories/'.$category->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-account-{{ $category->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>


                            <td class="table-text">
                                <div>{{ $category->categoryName }}</div>
                            </td>
                            <td class="table-text">
                                @foreach($category->subcategory as $subcategory)
                                    <div>{{ $subcategory->subcategoryName }}</div>
                                @endforeach
                            </td>
                            <td class="table-text">
                                @foreach($category->subcategory as $subcategory)
                                    <div>{{ number_format($subcategory->subcategoryBudget, 2, ',', ' ') }}</div>
                                @endforeach
                            </td>

                            <td class="table-text">
                                @foreach($category->subcategory as $subcategory)
                                    <div>{{ number_format($subcategory->budgetRemaining, 2, ',', ' ') }}</div>
                                @endforeach
                            </td>

                            <td class="table-text">
                                @foreach($category->subcategory as $subcategory)
                                    <div>
                                    <form action="{{ url('subcategories/'.$subcategory->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" id="delete-subcategory-{{ $subcategory->id }}"
                                                class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>Delete
                                        </button>
                                    </form>
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button type="button" class="btn btn-info" onclick="location.href = '/categories/create';">Add
                    Category
                </button>
            </div>
        </div>
    </div>
@endsection