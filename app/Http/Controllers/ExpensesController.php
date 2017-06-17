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
//        return $fromDate;
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

        // Authorise account access.
        $account = Account::find(request()->account_id);
        $subcategory = Subcategory::find(request()->subcategory_id);
//        dd($account, $subcategory);
        $this->authorize('accessAccount', $account);
        $this->authorize('accessSubcategory', $subcategory);

        /*
       Receive Required Data
       user_id: auth()->id()
       expenseDescription: request()->expenseDescription
       category_id: request()->category_id
       account_id: request()->account_id
       amount: request()->amount
       */
//        dd(auth()->id(),request()->expenseDescription, request()->category_id, request()->account_id, request()->amount);

        $category_id = Subcategory::find(request()->subcategory_id)->category_id;


        // Validate Data
        $this->validate(request(), [
            'expenseDescription' => 'required',
            'amount' => 'required|numeric',
            'subcategory_id' => 'required|numeric',
            'account_id' => 'required|numeric'
        ]);

        // Store Data
        Expense::create([
            'user_id' => auth()->id(),
            'expenseDescription' => request('expenseDescription'),
            'account_id'=> request('account_id'),
            'category_id'=> $category_id,
            'subcategory_id'=> request('subcategory_id'),
            'amount' => request('amount')
        ]);

        // Update account balance
        Account::find(request()->account_id)->decrement('balance', request()->amount);

        // Redirect
        return redirect('/expenses');
    }

    public function update(Expense $expense)
    {
        $this->authorize('accessExpense', $expense);

        if (is_null(request('expenseDescription'))) {
            $expenseDescription = $expense->expenseDescription;
        } else {
            $expenseDescription = request('expenseDescription');
        }
        if (is_null(request('category_id'))) {
            $category_id = $expense->category_id;
        } else {
            $category_id = request('category_id');
        }
        if (is_null(request('subcategory_id'))) {
            $subcategory_id = $expense->subcategory_id;
        } else {
            $subcategory_id = request('subcategory_id');
        }
        if (is_null(request('account_id'))) {
            $account_id = $expense->account_id;
        } else {
            $account_id = request('account_id');
        }
        if (is_null(request('amount'))) {
            $amount = $expense->amount;
        } else {
            $amount = request('amount');
        }

        Expense::where('id', $expense->id)
            ->update([
                'expenseDescription' => $expenseDescription,
                'category_id' => $category_id,
                'subcategory_id' => $subcategory_id,
                'account_id' => $account_id,
                'amount' => $amount,
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
