<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    protected $fillable = ['name'];


    public function permission()
    {
        return $this->hasMany(permission::class);
    }
}
