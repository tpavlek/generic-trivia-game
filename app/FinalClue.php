<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinalClue extends Model
{

    protected $guarded = [];

    public static function build(Game $game, string $category, string $clue, string $answer, array $attributes = []) : self
    {
        $default = [
            'game_id' => $game->id,
            'category' => $category,
            'clue' => $clue,
            'answer' => $answer
        ];

        return self::query()->create(array_merge($attributes, $default));
    }

}
