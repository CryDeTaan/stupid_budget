<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Subcategory;
use Carbon\Carbon;
use App\Events\Categories\CategoryDeleted;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$budgetStartDayOfMonth = User::where('id', auth()->id())->pluck('budgetStartDayOfMonth');
//        $budgetStartDayOfMonth = '02';
        $budgetStartDayOfMonth = User::where('id', auth()->id())->pluck('budgetStartDay')->first();
//        return $budgetStartDayOfMonth;

        if (Carbon::now()->day >= $budgetStartDayOfMonth) {
            $budgetStart = date('Y-m-'.$budgetStartDayOfMonth);
        } else {
            $budgetStart = date('Y-m-'.$budgetStartDayOfMonth, strtotime(date('Y-m')." -1 month"));
        }
        $categories = Category::where('user_id', auth()->id())
//            ->has('subcategory')
            ->with(['subcategory.expense' => function($query) {
                $query->where('created_at', '>=', '2017-05-01');
            }])
            ->get()
            ->map(function ($category, $_) use ($budgetStart){
                $category->subcategory
                    ->reduce(function($_, $subcategories) use ($budgetStart){
                        return $subcategories->budgetUsed = $subcategories->expense
                            ->reduce(function($carry, $expenses) {
                                return $carry + $expenses->amount;
                            }, 0);
                    });
                return $category;
            })
            ->map(function ($category, $_) {
                $category->subcategory
                    ->reduce(function($_, $subcategories) {
                        $budgetUsedPercentage = $subcategories->budgetUsed / $subcategories->subcategoryBudget;
                        switch (true) {
                            case $budgetUsedPercentage <= .30:
                                $budgetProgress = 'is-success';
                                break;
                            case $budgetUsedPercentage <= .60:
                                $budgetProgress = 'is-warning';
                                break;
                            default:
                                $budgetProgress = 'is-danger';
                                break;
                        }
                        return $subcategories->budgetProgress = $budgetProgress;
                    });
                return $category;
            });

        $categories->map(function($category, $_) {
            return $category->categoryBudget = $category->subcategory
                ->reduce(function($carry, $subcategories) {
                    return $carry + $subcategories->subcategoryBudget;
                }, 0 );
            return $category;
        });

        $categories->map(function($category, $_) {
            return $category->categoryBudgetUsed = $category->subcategory
                ->reduce(function($carry, $subcategories) {
                    return $carry + $subcategories->budgetUsed;
                }, 0);
            return $category;
        });

        $categories->map(function($category, $_) {
            if ( !empty ( $category->categoryBudget ) ) {
                $budgetUsedPercentage = $category->categoryBudgetUsed / $category->categoryBudget;
                switch (true) {
                    case $budgetUsedPercentage <= .30:
                        $budgetProgress = 'is-success';
                        break;
                    case $budgetUsedPercentage <= .60:
                        $budgetProgress = 'is-warning';
                        break;
                    default:
                        $budgetProgress = 'is-danger';
                        break;
                }
                return $category->budgetProgress = $budgetProgress;
            }
        });


        return [$categories, $budgetStartDayOfMonth];

//        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::where('user_id', auth()->id())->get();

        return view('categories.create', compact('categories'));
    }

    public function store()
    {
        /*
        Receive Required Data
        user_id: auth()->id()
        categoryName: request()->categoryName
        */
            // Validate Data
            $this->validate(request(), [
                'categoryName' => 'required',
            ]);
            // Store Data only if the category and sub category pair is unique for the user data is not
        $category = Category::firstOrCreate([
                'user_id' => auth()->id(),
                'categoryName' => request('categoryName'),
            ]);
        // Redirect
//        return redirect('/categories');
        return $category;
    }

    public function update(Category $category)
    {
        $this->authorize('accessCategory', $category);

        if (is_null(request('categoryName'))) {
            $categoryName = $category->categoryName;
        } else {
            $categoryName = request('categoryName');
        }

        Category::where('id', $category->id)
            ->update([
                'categoryName' => $categoryName
            ]);

        $category = Category::where('id', $category->id)->get();

        return $category;

    }

    public function destroy(Category $category)
    {
        $this->authorize('accessCategory', $category);
        $category->delete();
        event(new CategoryDeleted($category));
//        return redirect('/categories');
    }

}
