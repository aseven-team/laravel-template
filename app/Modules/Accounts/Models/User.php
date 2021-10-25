<?php

namespace App\Modules\Accounts\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin Builder
 */
class User extends Model
{
    use HasFactory, HasApiTokens, Authorizable, SoftDeletes;

    protected $hidden = [
        'password',
    ];

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];
}
