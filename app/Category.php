<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id','categoryName'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }
}
