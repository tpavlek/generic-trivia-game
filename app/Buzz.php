<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Buzz
 * @package App
 * @property Player player
 */
class Buzz extends Model
{

    public $table = "buzzes";

    protected $guarded = [];

    public function resolution()
    {
        return $this->belongsTo(BuzzerResolution::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }


}
