<?php

namespace App\Http\Controllers;

use App\Account;
use Gate;
use Illuminate\Http\Request;

class AccountsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $accounts = Account::where('user_id', auth()->id())->with('expense', 'expense.category', 'income')->get();
        return $accounts;
//        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {

        return view('accounts.create');

    }

    public function store()
    {
        /*
        Receive Required Data
        user_id: auth()->id()
        accountName: request()->accountName
        accountDescription: request()->accountDescription
        accountType: request()->accountType
        openingBalance: request()->accountType
        balance: openingBalance // The balance will obviously be the the same as the opening balance the moment the account gets created.
        */

        // Validate Data
        $this->validate(request(), [
            'accountName' => 'required',
            'accountDescription' => 'required',
            'accountType' => 'required',
            'openingBalance' => 'required | numeric',
        ]);

        // Store Data
        $account = Account::create([
            'user_id' => auth()->id(),
            'accountName'=> request('accountName'),
            'accountDescription' => request('accountDescription'),
            'accountType' => request('accountType'),
            'openingBalance' => request('openingBalance'),
            'balance' => request('openingBalance') // Read 'Receive Required Data' section.
        ]);

        // Redirect
        return $account;
    }

    public function update(Account $account)
    {
        $this->authorize('accessAccount', $account);

        if (is_null(request('accountName'))) {
            $accountName = $account->accountName;
        } else {
            $accountName = request('accountName');
        }
        if (is_null(request('accountDescription'))) {
            $accountDescription = $account->accountDescription;
        } else {
            $accountDescription = request('accountDescription');
        }
        if (is_null(request('accountType'))) {
            $accountType = $account->accountType;
        } else {
            $accountType = request('accountType');
        }
        if (is_null(request('balance'))) {
            $balance = $account->balance;
        } else {
            $balance = request('balance');
        }

        Account::where('id', $account->id)
            ->update([
                'accountName' => $accountName,
                'accountDescription' => $accountDescription,
                'accountType' => $accountType,
                'balance' => $balance
            ]);

        $account = Account::where('id', $account->id)->get();

        return $account;

    }

    public function destroy(Account $account)
    {
        $this->authorize('accessAccount', $account);

        $account->delete();

       // return redirect('/accounts');
    }

}
