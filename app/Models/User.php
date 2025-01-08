<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    public $timestamps = false;
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
