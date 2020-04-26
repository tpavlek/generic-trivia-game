<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Category
 * @package App
 * @property bool double_jeopardy
 */
class Category extends Model
{

    protected $guarded = [];
    public $clue_values = [ 200, 400, 600, 800, 1000 ];

    public function clues()
    {
        return $this->hasMany(Clue::class);
    }

    public static function factory(Game $game = null, $times = 1, $states = []) : self
    {
        if ($game === null) {
            $game = Game::factory();
        }

        $factory = factory(self::class, $times);

        if (!empty($states)) {
            $factory->states(...$states);
        }

        $result = $factory->create([ 'game_id' => $game->id ]);

        if (!$result instanceof Collection) {
            $result = collect([ $result ]);
        }

        foreach ($result as $instance) {
            /** @var self $instance */

            $multiplication_factor = ($instance->double_jeopardy) ? 2 : 1;

            foreach ($instance->clue_values as $clue_value) {
                factory(Clue::class)->create([
                    'value' => $clue_value * $multiplication_factor,
                    'category_id' => $instance->id,
                ]);
            }
        }

        return $result->first();
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
