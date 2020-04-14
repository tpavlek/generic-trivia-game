<?php

namespace App;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\Request;

class SessionOptions implements Arrayable, Jsonable, CastsAttributes
{

    public $min_year;
    public $game_id;

    public static function fromRequest(Request $request)
    {
        $options = new self;
        $options->min_year = $request->get('min_year');
        $options->game_id = $request->get('game_id');

        return $options;
    }

    public static function fromJson($json)
    {
        $json = json_decode($json, true);

        $instance = new self;
        $instance->min_year = $json->min_year ?? null;
        $instance->game_id = $json->game_id ?? null;

        return $instance;
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    public function wantsSpecificGame()
    {
        return $this->game_id !== null;
    }

    public function hasMinimumYear()
    {
        return $this->min_year !== null;
    }

    public function toArray()
    {
        return [
            'game_id' => $this->game_id,
            'min_year' => $this->min_year,
        ];
    }

    public function get($model, string $key, $value, array $attributes)
    {
        return self::fromJson($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value->toJson();
    }
}
