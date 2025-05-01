<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $guarded = [];

   
    protected function mathematicalInterests(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => json_decode($value , true),
                );
    }

}
