<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Menu extends Model
{
    protected $table = 'menus';
    protected $guarded = [];

    const ROUTE_TYPE = 1;
    const URL_TYPE = 2;
    const MENU_TYPES = [
        'route' => self::ROUTE_TYPE,
        'url' => self::URL_TYPE
    ];

    public function parent()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(UserRole::class, 'role_permissions', 'menu_id', 'role_id')->withPivot(['read', 'store', 'update', 'delete', 'import', 'export']);
    }

    public function scopeWithChildrens($query)
    {
        return $query->with([
            'childrens' => function ($children) {
                $children->orderBy('menus.sort');
            }
        ]);
    }

    public function scopeWithRoles($query)
    {
        return $query->with('roles');
    }

    public function scopeIsParent($query)
    {
        return $query->where('menus.parent_id', 0);
    }

    public function scopeIsChildren($query)
    {
        return $query->where('menus.parent_id', '<>', 0);
    }

    public function scopeGetMenus($query)
    {
        return $query->withChildrens()->isParent()->orderBy('menus.sort')->get();
    }

    public function scopeWhereHasRoleId($query, int $roleId)
    {
        return $query->whereHas('roles', function (Builder $query) use ($roleId) {
            $query->where('roles.id', $roleId);
        });
    }

    public function scopeWhereRoute($query, string $routeName)
    {
        return $query->where('menus.route', $routeName);
    }

    public function scopeIsRoute($query)
    {
        return $query->where('menus.type', 1);
    }

    public function scopeHasReadPermission($query)
    {
        return $query->whereHas('roles', function (Builder $query) {
            $query->where('role_permissions.read', 1);
        });
    }
}
