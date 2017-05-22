<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id','category_id','subcategoryName','subcategoryBudget'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }
}
