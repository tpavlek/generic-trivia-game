<?php

namespace App;

use App\Exceptions\BuzzerNotActiveException;
use App\Parser\WebParser;
use Faker\Generator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Class Session
 * @package App
 * @property Game $game
 * @property string id
 */
class Session extends Model
{

    public $incrementing = false;

    protected $guarded = [];

    protected $casts = [
        'options' => SessionOptions::class
    ];

    public static function factory(Game $game = null): self
    {
        if ($game === null) {
            $game = Game::factory();
        }

        return factory(self::class)->create([ 'game_id' => $game->id ]);
    }

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

    public function players()
    {
        return $this->belongsToMany(Player::class)->wherePivot('active', '=', true);
    }

    public function clue_selections()
    {
        return $this->hasMany(ClueSelection::class)
            ->orderByDesc('created_at');
    }

    public function buzzer_resolutions()
    {
        return $this->hasMany(BuzzerResolution::class)
            ->orderByDesc('created_at');
    }

    /**
     * @return ClueSelection|null
     */
    public function activeSelection()
    {
        return $this->clue_selections()->where('complete', '=', false)->first();
    }

    /**
     * @return BuzzerResolution|null
     * @throws BuzzerNotActiveException
     */
    public function activeResolution()
    {
        $instance = $this->buzzer_resolutions()->where('resolved', '=', false)->first();

        if ($instance === null) {
            throw new BuzzerNotActiveException();
        }

        return $instance;
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function showClue(Clue $clue)
    {
        ClueSelection::select($this, $clue, Auth::user());
    }

    public function isBuzzerActive()
    {
        try {
            return $this->activeResolution() !== null;
        } catch (BuzzerNotActiveException $exception) {
            return false;
        }
    }

    public function activateBuzzer()
    {
        $current_selection = $this->activeSelection();

        if (!$current_selection) {
            return;
        }

        $current_selection->activateBuzzer();
    }

    /**
     * @return BuzzerResolution
     * @throws BuzzerNotActiveException
     */
    public function resolveBuzzer()
    {
        $active_resolution = $this->activeResolution();

        if (!$active_resolution) {
            throw new BuzzerNotActiveException("Tried to resolve inactive buzzer");
        }

        return $active_resolution->resolve();
    }

    public function addPlayer(Player $player)
    {
        $this->players()->attach($player->id);
    }

}
