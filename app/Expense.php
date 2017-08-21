<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['user_id','expenseDescription', 'account_id', 'subcategory_id', 'category_id', 'amount', 'created_at'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class)->withTrashed();
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class)->withTrashed();
    }
}
