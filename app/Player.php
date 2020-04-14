<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{

    protected $guarded = [];

    public static function build($name) : self
    {
        return self::query()->create([
            'name' => $name
        ]);
    }

}
