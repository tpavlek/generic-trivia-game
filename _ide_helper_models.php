<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Category
 *
 * @property int $id
 * @property string $title
 * @property int $is_complete
 * @property int $double_jeopardy
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereDoubleJeopardy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereIsComplete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App{
/**
 * App\Game
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereUpdatedAt($value)
 */
	class Game extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\Clue
 *
 * @property int $id
 * @property int $value
 * @property string $text
 * @property string $answer
 * @property int $is_daily_double
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Clue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Clue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Clue query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Clue whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Clue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Clue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Clue whereIsDailyDouble($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Clue whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Clue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Clue whereValue($value)
 */
	class Clue extends \Eloquent {}
}

namespace App{
/**
 * App\FinalClue
 *
 * @property int $id
 * @property string $category
 * @property string $clue
 * @property string $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinalClue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinalClue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinalClue query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinalClue whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinalClue whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinalClue whereClue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinalClue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinalClue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinalClue whereUpdatedAt($value)
 */
	class FinalClue extends \Eloquent {}
}

