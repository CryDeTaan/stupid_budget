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

    public function index($category)
    {
        if ($category === 'Unplanned') {
            $category = Category::where('user_id', auth()->id())->first();
        } else {
            $category = Category::where('id', $category)->first();
        }
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

        $subcategory = Subcategory::firstOrCreate([
            'user_id' => auth()->id(),
            'category_id' => $category->id,
            'subcategoryName' => request('subcategoryName'),
            'subcategoryBudget' => request('subcategoryBudget')
        ]);
        $subcategory->budgetUsed = 0;
        return $subcategory;
    }

    public function update(Subcategory $subcategory)
    {
        $this->authorize('accessSubcategory', $subcategory);

        if (is_null(request('subcategoryName'))) {
            $subcategoryName = $subcategory->subcategoryName;
        } else {
            $subcategoryName = request('subcategoryName');
        }

        if (is_null(request('subcategoryBudget'))) {
            $subcategoryBudget = $subcategory->subcategoryBudget;
        } else {
            $subcategoryBudget = request('subcategoryBudget');
        }

        Subcategory::where('id', $subcategory->id)
            ->update([
                'subcategoryName' => $subcategoryName,
                'subcategoryBudget' => $subcategoryBudget
            ]);

        $subcategory = Subcategory::find($subcategory->id);

        return $subcategory;

    }

    public function destroy(Subcategory $subcategory)
    {
        $this->authorize('accessSubcategory', $subcategory);
        $subcategory->delete();
    }

}
