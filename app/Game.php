<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    public $incrementing = false;
    protected $guarded = [];

    protected $casts = [
        'date' => 'date'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function final_clue()
    {
        return $this->hasOne(FinalClue::class);
    }

    public static function build(int $id, Carbon $date) : self
    {
        return self::query()->create([ 'id' => $id, 'date' => $date ]);
    }


}
