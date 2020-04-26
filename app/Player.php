<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Session session
 */
class Player extends Model implements Authenticatable
{

    protected $guarded = [];

    public static function factory(): self
    {
        return factory(self::class)->create();
    }

    public static function build($name): self
    {
        return self::query()->create([
            'name' => $name
        ]);
    }

    public function sessions()
    {
        return $this->belongsToMany(Session::class);
    }

    public function getSessionAttribute()
    {
        return $this->sessions()->wherePivot('active', '=', true)->first();
    }

    public function buzzIn($time)
    {
        $this->session->activeResolution()->addBuzz($this, $time);
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
    }

    public function getRememberToken()
    {
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
    }
}
