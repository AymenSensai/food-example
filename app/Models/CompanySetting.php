<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [
        'email',
        'phone',
        'address',
        'opening_hours',
        'tiktok_url',
        'instagram_url',
        'facebook_url',
    ];
}
