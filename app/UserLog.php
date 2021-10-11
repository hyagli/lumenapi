<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table = 'UserLog';
    protected $fillable = [
        'UserId', 'IP'
    ];
}
