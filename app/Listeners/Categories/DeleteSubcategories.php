<?php

namespace App\Listeners\Categories;

use App\Events\Categories\CategoryDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Subcategory;

class DeleteSubcategories
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CategoryDeleted  $event
     * @return void
     */
    public function handle(CategoryDeleted $event)
    {
        Subcategory::where('user_id', auth()->id())
            ->where('category_id', $event->category->id)
            ->delete();
    }
}
