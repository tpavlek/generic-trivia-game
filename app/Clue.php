<?php

namespace App;

use Faker\Provider\Text;
use Illuminate\Database\Eloquent\Model;

class Clue extends Model
{

    protected $guarded = [];

    public static function build(Category $category, int $value, string $text, string $answer, $is_daily_double = false, array $attributes = [])
    {
        $default = [
            'category_id' => $category->id,
            'value' => $value,
            'text' => $text,
            'answer' => $answer,
            'is_daily_double' => $is_daily_double
        ];

        return self::query()->create(array_merge($default, $attributes));
    }

}
