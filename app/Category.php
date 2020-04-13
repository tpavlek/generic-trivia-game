<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $guarded = [];

    public function clues()
    {
        return $this->hasMany(Clue::class);
    }

    public static function build(Game $game, string $title, array $attributes = []) : self
    {
        $default = [
            'title' => $title,
            'game_id' => $game->id,
        ];

        return self::query()->create(array_merge($default, $attributes));
    }

    public function markIncomplete()
    {
        $this->is_complete = false;
        $this->save();

        return $this;
    }
}
