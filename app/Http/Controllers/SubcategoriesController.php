<?php

namespace App\Http\Controllers;

use App\Subcategory;
use App\Category;
use Illuminate\Http\Request;

class SubcategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Category $category)
    {
        $this->authorize('accessCategory', $category);
        $subcategories = Subcategory::where('category_id', $category->id)->get();
        return $subcategories;
    }

    public function store()
    {
        $category = Category::find(request()->id);

        $this->authorize('accessCategory', $category);

        $this->validate(request(), [
            'subcategoryName' => 'required',
            'subcategoryBudget' => 'required|numeric',
        ]);

        Subcategory::firstOrCreate([
            'user_id' => auth()->id(),
            'category_id' => $category->id,
            'subcategoryName' => request('subcategoryName'),
            'subcategoryBudget' => request('subcategoryBudget')
        ]);
    }




    public function destroy(Subcategory $subcategory)
    {
        $this->authorize('accessSubcategory', $subcategory);
        $subcategory->delete();
        return redirect('/categories');
    }

}
