<?php

namespace App\DTO;

use App\Libraries\DataTransferObject;

class MenuDTO extends DataTransferObject
{
    public $id;
    public $name;
    public $route;
    public $icon;
    public $parentId;
    public $type;
    public $sort;
    public $menuList;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  Initialize object data.
     * 
     *  @return void
     */
    public function boot(): void
    {
        $this->merge([
            'id' => $this->id ? $this->id : null,
            'name' => $this->request->name,
            'route' => $this->request->route ? $this->request->route : null,
            'icon' => $this->request->icon ? $this->request->icon : null,
            'parentId' => $this->request->parent_id ? intval($this->request->parent_id) : 0,
            'type' => $this->request->type ? Menus::MENU_TYPES[$this->request->type] : null,
            'sort' => $this->request->sort ? $this->request->sort : 1,
            'menuList' => $this->request->menu_list ? $this->request->menu_list : null
        ]);
    }
}
