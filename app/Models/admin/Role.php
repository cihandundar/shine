<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function permission()
    {
        return $this->hasMany(Permission::class);
    }
}
