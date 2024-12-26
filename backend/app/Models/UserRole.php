<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserRole extends Model
{
    protected $table = 'roles';

    protected $guarded = [];

    /**
     * Get specified role by role name.
     * 
     *  @param \Illuminate\Database\Eloquent\Builder $query
     *  @param string $role
     * 
     *  @return \Illuminate\Database\Eloquent
     */
    public function scopeGetByName(Builder $query, string $role)
    {
        return $query->where('roles.name', $role)->first();
    }
}
