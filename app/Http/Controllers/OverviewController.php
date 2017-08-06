<?php

namespace App\Http\Controllers;

use App\Account;
use App\Expense;
use App\Income;
use App\Subcategory;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /*
        * Helpers
        */

        //Budget Start day of month
        $budgetStartDayOfMonth = User::where('id', auth()->id())->pluck('budgetStartDay')->first();
        if (Carbon::now()->day >= $budgetStartDayOfMonth) {
            $budgetStart = date('Y-m-'.$budgetStartDayOfMonth);
        } else {
            $budgetStart = date('Y-m-'.$budgetStartDayOfMonth, strtotime(date('Y-m')." -1 month"));
        }
//        return $budgetStart;

        /*
         * View Values
         */

        // Income

        $income = Income::where('user_id', auth()->id())
            ->where('created_at', '>=', $budgetStart)
            ->sum('amount');
//        return $income;

        // Expenses
        $expenses = Expense::where('user_id', auth()->id())
            ->where('created_at', '>=', $budgetStart)
            ->sum('amount');
//        return $expenses;

        // Balance
        $balance = Account::where('user_id', auth()->id())
            ->sum('balance');
//        return $balance;

        // Budget Total
        $budgetTotal = Subcategory::where('user_id', auth()->id())
            ->sum('subcategoryBudget');
//        return $budgetTotal;

        // Balance Forecast
        $balanceForecast =  strval($balance - $budgetTotal);
//        return $balanceForecast;

        // Unplanned Expenses
        $unplannedExpenses = Expense::where('user_id', auth()->id())
            ->where('created_at', '>=', $budgetStart)
            ->where('category_id', '1')
            ->sum('amount');
//        return $unplannedExpenses;

        // Budget User (to determine the budget progress)
        $budgetUsed = strval($expenses - $unplannedExpenses);
//        return $budgetProgress;

        // Progress Bar class
        $budgetProgress = null;
        if ($budgetTotal != 0) {
            $budgetUsedPercentage = $budgetUsed / $budgetTotal;
            switch (true) {
                case $budgetUsedPercentage <= .40:
                    $budgetProgress = 'is-success';
                    break;
                case $budgetUsedPercentage <= .70:
                    $budgetProgress = 'is-warning';
                    break;
                default:
                    $budgetProgress = 'is-danger';
                    break;
            }
        }

        return response()->json([
            'Income' => $income,
            'Expense' => $expenses,
            'Balance' => $balance,
            'Balance_Forecast' => $balanceForecast,
            'Unplanned_Expenses' => $unplannedExpenses,
            'Budget_Used' => $budgetUsed,
            'Budget_Total' => $budgetTotal,
            'Budget_Progress' => $budgetProgress
        ]);

    }
}
