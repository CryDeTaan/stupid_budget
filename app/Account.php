<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id','accountName','accountDescription', 'accountType', 'openingBalance', 'balance'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }

    public function income()
    {
        return $this->hasMany(Income::class);
    }





}
