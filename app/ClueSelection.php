<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClueSelection extends Model
{

    public $table = "clue_selections";
    public $timestamps = true;
    protected $guarded = [];

    public static function select(Session $session, Clue $clue, Player $byPlayer)
    {
        return self::query()->create([
            'clue_id' => $clue->id,
            'player_id' => $byPlayer->id,
            'session_id' => $session->id,
        ]);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function clue()
    {
        return $this->belongsTo(Clue::class);
    }

    public function activateBuzzer()
    {
        return BuzzerResolution::activateNew($this->session, $this->clue);
    }

}
