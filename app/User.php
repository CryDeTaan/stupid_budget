<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'budgetStartDay',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function account()
    {
        return $this->hasMany(account::class);
    }

    public function income()
    {
        return $this->hasMany(Income::class);
    }

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }

    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }

}
