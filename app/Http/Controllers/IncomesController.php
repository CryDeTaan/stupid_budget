<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use App\Income;
use Carbon\Carbon;
use Illuminate\Validation\Rules\In;

class IncomesController extends Controller
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

         $incomes = Income::where('user_id', auth()->id())
                            ->whereBetween('created_at', array($fromDate, $toDate))
                            ->with('account')
                            ->orderBy('created_at', 'desc')
                            ->get();
        return $incomes;
//        return view('incomes.index', compact('incomes'));

    }

    public function create()
    {

        $accounts = Account::where('user_id', auth()->id())->get();
        return $accounts;
        return view('incomes.create', compact('accounts'));

    }

    public function store(Request $request)
    {

        /*
        Receive Required Data
        user_id: auth()->id()
        incomeDescription: request()->incomeDescription
        account_id: request()->account_id
        amount: request()->amount
        */

        // Validate Data
        $this->validate(request(), [
            'incomeDescription' => 'required',
            'amount' => 'required|numeric',
            'account_id' => 'required|numeric',
            'incomeDate' => 'nullable|dateformat:Y-m-d'
        ],
            [
                'account_id.required' => 'An Account must be selected.'
            ]
        );

        // Authorise account access.
        $account = Account::find(request()->account_id);
        $this->authorize('accessAccount', $account);

        if (is_null(request('incomeDate'))) {
            $incomeDate = Carbon::now();
        } else {
            $incomeDate = request('incomeDate').' 00:00:00';
        }

        // Store Data
        Income::create([
            'user_id' => auth()->id(),
            'incomeDescription' => request('incomeDescription'),
            'account_id'=> request('account_id'),
            'amount' => request('amount'),
            'created_at' => $incomeDate
        ]);

        // Update account balance
        Account::find(request()->account_id)->increment('balance', request()->amount);

        // Redirect
        return redirect('/income');
    }

    public function update(Income $income)
    {

        // Validate request
        $this->validate(request(), [
            'amount' => 'nullable|numeric',
            'account_id' => 'nullable|numeric',
            'incomeDate' => 'nullable|dateformat:Y-m-d'
        ]);


        $this->authorize('accessIncome', $income);

        if (is_null(request('incomeDescription'))) {
            $incomeDescription = $income->incomeDescription;
        } else {
            $incomeDescription = request('incomeDescription');
        }
        if (is_null(request('account_id'))) {
            $account_id = $income->account_id;
        } else {
            $account_id = request('account_id');

            // Update old account balance
            Account::find($income->account_id)->decrement('balance', $income->amount);

            // Update new account balance
            Account::find($account_id)->increment('balance', $income->amount);
        }
        if (is_null(request('amount'))) {
            $amount = $income->amount;
        } else {
            $amount = request('amount');

            $diffAmount =  $income->amount - $amount;

            Account::find($account_id)->decrement('balance', $diffAmount);

        }
        if (is_null(request('incomeDate'))) {
            $incomeDate = $income->created_at;
        } else {
            $incomeDate = request('incomeDate').' 00:00:00';
        }

        Income::where('id', $income->id)
            ->update([
                'incomeDescription' => $incomeDescription,
                'account_id' => $account_id,
                'amount' => $amount,
                'created_at' => $incomeDate
            ]);

        $income = Income::where('id', $income->id)
            ->with('account')
            ->get();

        return $income;
    }


    public function destroy(Income $income)
    {
        $this->authorize('accessIncome', $income);
        try {
            $account = Account::find($income->account_id);
            $account->decrement('balance', $income->amount);
        } catch (ErrorException $e) {
            // Do stuff if it doesn't exist.
        }
        finally {
            $income->delete();
        }
//        return redirect('/income');
    }

}
