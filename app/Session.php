<?php

namespace App;

use App\Parser\WebParser;
use Faker\Generator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Session extends Model
{

    public $incrementing = false;

    protected $guarded = [];

    protected $casts = [
        'options' => SessionOptions::class
    ];

    public static function build(SessionOptions $options)
    {
        $session_id = Str::of(app(Generator::class)->firstName)->upper();

        if ($options->wantsSpecificGame()) {
            $game = (new WebParser($options->game_id))->parse();
        } else {
            $query = Game::query();

            if ($options->hasMinimumYear()) {
                $query->whereYear('date', '>=', $options->min_year);
            }

            $game = $query->take(1)->first();

            if ($game === null) {
                $game = Game::query()->inRandomOrder()->take(1)->first();
            }
        }

        return self::query()->create([
            'id' => $session_id,
            'game_id' => $game->id,
            'options' => $options,
        ]);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

}
