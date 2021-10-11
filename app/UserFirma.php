<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFirma extends Model
{
    protected $table = 'UserFirma';
    protected $fillable = [
        'UserId', 'FirmaId', 'Aktif'
    ];

}
