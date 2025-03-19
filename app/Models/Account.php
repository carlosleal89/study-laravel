<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'account_name',
        'app_key',
        'app_token',
        'info',
        'product_catalog_id'
    ];
}
