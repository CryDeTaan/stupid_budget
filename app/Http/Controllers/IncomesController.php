<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use App\Income;
use Carbon\Carbon;

class IncomesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        if (empty($_POST['fromDate']))
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
        return view('incomes.index', compact('incomes'));

    }




    public function create()
    {

        $accounts = Account::where('user_id', auth()->id())->get();
        return $accounts;
        return view('incomes.create', compact('accounts'));

    }




    public function store()
    {
        /*
        Receive Required Data
        user_id: auth()->id()
        incomeDescription: request()->incomeDescription
        account_id: request()->account_id
        amount: request()->amount
        */
//        dd(auth()->id(),request()->incomeDescription, request()->account_id, request()->amount);

        // Authorise account access.
        $account = Account::find(request()->account_id);
        $this->authorize('accessAccount', $account);

        // Validate Data
        $this->validate(request(), [
            'incomeDescription' => 'required',
            'amount' => 'required|numeric',
            'account_id' => 'required|numeric'
        ]);

        // Store Data
        Income::create([
            'user_id' => auth()->id(),
            'incomeDescription' => request('incomeDescription'),
            'account_id'=> request('account_id'),
            'amount' => request('amount')
        ]);


        // Update account balance
        Account::find(request()->account_id)->increment('balance', request()->amount);

        // Redirect
        return redirect('/income');
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
