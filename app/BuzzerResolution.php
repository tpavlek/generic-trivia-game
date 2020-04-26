<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BuzzerResolution
 * @package App
 *
 * @property Collection|Buzz[] buzzes
 * @property Player|null winner
 */
class BuzzerResolution extends Model
{

    protected $guarded = [];

    public static function activateNew(Session $session, Clue $clue)
    {
        return self::query()->create([
            'session_id' => $session->id,
            'clue_id' => $clue->id,
        ]);
    }

    public function buzzes()
    {
        return $this->hasMany(Buzz::class);
    }

    public function winner()
    {
        return $this->belongsTo(Player::class, 'winner_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function setResolved(Player $winner = null)
    {
        $this->resolved = true;

        if ($winner) {
            $this->winner_id = $winner->id;
        }

        $this->save();

        return $this;
    }

    public function isResolved()
    {
        return $this->resolved;
    }

    public function addBuzz(Player $player, $time)
    {
        if ($this->resolved) {
            return;
        }

        Buzz::query()->create([
            'buzzer_resolution_id' => $this->id,
            'player_id' => $player->id,
            'time' => $time,
        ]);
    }

    public function resolve()
    {
        if ($this->refresh()->isResolved()) {
            return $this;
        }

        if ($this->buzzes->count() === 0) {
            // No one buzzed in, the resolution is no winner.
            $this->setResolved();
            return $this;
        }

        /** @var Buzz $lowest */
        $lowest = $this->buzzes
            ->sort(fn (Buzz $buzz) => $buzz->time)
            ->first();

        return $this->setResolved($lowest->player);
    }

}
