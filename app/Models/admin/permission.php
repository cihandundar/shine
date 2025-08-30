<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    protected $fillable = ['name', 'role_id'];

    public function role()
    {
        return $this->belongsTo(roles::class);
    }
}
