<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Expense;
use App\Category;
use App\Account;
use Carbon\Carbon;
use App\Subcategory;

class ExpensesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (empty(request()->fromDate))
        {
            $fromDate = Carbon::today()->subDays(30);
            $toDate = Carbon::tomorrow();
        } else {
            $fromDate = request()->fromDate.' 00:00:00';
            $toDate = request()->toDate.' 23:59:59';
        }

        $expenses = Expense::where('user_id', auth()->id())
                                ->whereBetween('created_at', array($fromDate, $toDate))
                                ->with('category', 'subcategory', 'account')
                                ->orderBy('created_at', 'desc')
                                ->get();
        return $expenses;
//        return view('expenses.index', compact('expenses'));

    }

    public function create()
    {

        $categories = Category::with('subcategory')->where('user_id', auth()->id())->get();
        $accounts = Account::where('user_id', auth()->id())->get();
//        return $accounts;
//        return view('expenses.create', compact('categories', $categories, 'accounts', $accounts));

    }

    public function store()
    {
        // Validate that subcategory is either a numeric or matches the string Unplanned.
        $this->validate(request(),
            [
                'subcategory_id' =>
                    array(
                        'required',
                        'regex:/^(\d*|Unplanned)$/u',
                        'match_category'
                    ),
                'expenseDescription' => 'required',
                'amount' => 'required|numeric',
                'account_id' => 'required|numeric',
                'expenseDate' => 'nullable|dateformat:Y-m-d'
            ],
            [
                'subcategory_id.match_category' => 'The Subcategory does not belong to the requested Category.'
            ]
        );

        // Set Variables
        // Set $subcategory variable based on subcategory being an ID or the string 'Unplanned'
        if (request()->subcategory_id === 'Unplanned') {
            $subcategory = Subcategory::where('user_id', auth()->id())->first();
        } else {
            $subcategory = Subcategory::find(request()->subcategory_id);
        }

        if (is_null(request('expenseDate'))) {
            $expenseDate = Carbon::now();
        } else {
            $expenseDate = request('expenseDate').' 00:00:00';
        }

        // Set $account variable.
        $account = Account::find(request()->account_id);

        // Authorise access to variables.
        $this->authorize('accessAccount', $account);
        $this->authorize('accessSubcategory', $subcategory);

        // Store Data
        Expense::create([
            'user_id' => auth()->id(),
            'expenseDescription' => request('expenseDescription'),
            'account_id'=> $account->id,
            'category_id'=> $subcategory->category_id,
            'subcategory_id'=> $subcategory->id,
            'amount' => request('amount'),
            'created_at' => $expenseDate
        ]);

        // Update account balance
        Account::find(request()->account_id)->decrement('balance', request()->amount);

        // Redirect
        return redirect('/expenses');
    }

    public function update(Expense $expense)
    {

        // Validate that subcategory is either a numeric or matches the string Unplanned.
        $this->validate(request(),
            [
                'subcategory_id' =>
                    array(
                        'nullable',
                        'regex:/^(\d*|Unplanned)$/u',
                        'match_category'
                    ),
                'amount' => 'nullable|numeric',
                'account_id' => 'nullable|numeric',
                'expenseDate' => 'nullable|dateformat:Y-m-d'
            ],
            [
                'subcategory_id.match_category' => 'The Subcategory does not belong to the requested Category.'
            ]
        );

        // Authorise access to the expense that will be updated.
        $this->authorize('accessExpense', $expense);

        // Set some variables that are required during the update
        // The variables will be updated if the request includes the data to be updated.
        $expenseDescription = $expense->expenseDescription;
        $category_id = $expense->category_id;
        $subcategory_id = $expense->subcategory_id;
        $account_id = $expense->account_id;
        $amount = $expense->amount;
        $expenseDate = $expense->created_at;

        // If request fields contains data, update variable based on the $request data.
        if (!empty(request('expenseDescription'))) {
            $expenseDescription = request('expenseDescription');
        }

        if (!empty(request('category_id'))) {
            $category_id = request('category_id');
        }

        if (!empty(request('subcategory_id'))) {
            $subcategory_id = request('subcategory_id');
        }

        if (!empty(request('account_id'))) {
            $account_id = request('account_id');
            // Update old account balance
            Account::find($expense->account_id)->increment('balance', $expense->amount);
            // Update new account balance
            Account::find($account_id)->decrement('balance', $expense->amount);
        }

        if (!empty(request('amount'))) {
            $amount = request('amount');
            $diffAmount =  $expense->amount - $amount;
            Account::find($account_id)->increment('balance', $diffAmount);
        }

        if (!empty(request('expenseDate'))) {
            $expenseDate = request('expenseDate');
        }


        Expense::where('id', $expense->id)
            ->update([
                'expenseDescription' => $expenseDescription,
                'category_id' => $category_id,
                'subcategory_id' => $subcategory_id,
                'account_id' => $account_id,
                'amount' => $amount,
                'created_at' => $expenseDate
            ]);

        $expense = Expense::where('id', $expense->id)
            ->with('category', 'subcategory', 'account')
            ->get();

        return $expense;
    }

    public function destroy(Expense $expense)
    {
        $this->authorize('accessExpense', $expense);

        try {
            $account = Account::find($expense->account_id);
            $account->increment('balance', $expense->amount);
        } catch (ErrorException $e) {
            // Do stuff if it doesn't exist.
        }
        finally {
            $expense->delete();
        }

//        return redirect('/expenses');
    }

}
