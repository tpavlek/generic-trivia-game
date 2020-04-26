<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Game
 * @package App
 *
 * @property Collection|Category[] categories
 */
class Game extends Model
{

    const STATE_PLAYERS_JOINING = 'players-joining';
    const STATE_SHOWING_BOARD = 'showing-board';

    public $incrementing = false;
    protected $guarded = [];

    protected $casts = [
        'date' => 'date'
    ];

    public static function factory() : self
    {
        /** @var self $instance */
        $instance = factory(self::class)->create();

        Category::factory($instance, 6);
        Category::factory($instance, 6, [ 'double_jeopardy' ]);

        return $instance;
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function clues()
    {
        return $this->hasManyThrough(Clue::class, Category::class)->where('double_jeopardy', '=', $this->is_double_jeopardy);
    }

    public function final_clue()
    {
        return $this->hasOne(FinalClue::class);
    }

    public static function build(int $id, Carbon $date) : self
    {
        return self::query()->create([ 'id' => $id, 'date' => $date ]);
    }

    public function isBuzzerOpen()
    {

    }


}
