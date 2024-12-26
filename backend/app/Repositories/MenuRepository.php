<?php

namespace App\Repositories;

use App\Traits\Staticable;
use App\Models\Menu;

/**
 * Handle processing data.
 * 
 */
class MenuRepository
{
    use Staticable;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get parent menu with children.
     * 
     * @return \Illuminate\Database\Eloquent
     */
    public static function getMenus()
    {
        return Menu::withChildrens()->isParent()->orderBy('menus.sort')->get();
    }
}
