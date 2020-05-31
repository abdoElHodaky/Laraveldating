<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function info()
    {
        return $this->hasOne('App\UserInfo');
    }

    public function settings()
    {
        return $this->hasOne('App\UserSettings');
    }

    public function matches()
    {
        return $this->belongsToMany('App\User', 'matches', 'user_one', 'user_two')
            ->where('user_one', '=', $this->id);
    }

    public function dislikes()
    {
        return $this->belongsToMany('App\User', 'dislikes', 'user_two', 'user_one')
            ->where('user_one', '=', $this->id);
    }

    public function thisDisliked()
    {
        return $this->belongsToMany('App\User', 'dislikes',
            'user_one', 'user_two')
            ->wherePivot('disliked', '=', 1)
            ->where('user_one', '=', $this->id);
    }

    public function dislikedThis()
    {
        return $this->belongsToMany('App\User', 'dislikes',
            'user_two', 'user_one')
            ->wherePivot('disliked', '=', 1)
            ->where('user_two', '=', $this->id);
    }

    public function dislike(User $foreignUser)
    {
        $thisMatched = $this->belongsToMany('App\User', 'dislikes',
            'user_one', 'user_two')
            ->wherePivot('disliked', '=', 1)
            ->where('user_one', '=', $this->id)
            ->where('user_two', '=', $foreignUser->id)->getResults();

        $matchedThis = $this->belongsToMany('App\User', 'dislikes',
            'user_two', 'user_one')
            ->wherePivot('disliked', '=', 1)
            ->where('user_two', '=', $this->id)
            ->where('user_one', '=', $foreignUser->id)->getResults();

        if (isset($thisMatched[0]->attributes['id']) || isset($matchedThis[0]->attributes['id'])) {
            return $foreignUser;
        } else {
            return null;
        }
    }

    public function thisLiked()
    {
        return $this->belongsToMany('App\User', 'matches',
            'user_one', 'user_two')
            ->wherePivot('matched', '=', 1)
            ->where('user_one', '=', $this->id);
    }

    public function likedThis()
    {
        return $this->belongsToMany('App\User', 'matches',
            'user_two', 'user_one')
            ->wherePivot('matched', '=', 1)
            ->where('user_two', '=', $this->id);
    }

    public function match(User $foreignUser)
    {
        $thisMatched = $this->belongsToMany('App\User', 'matches',
            'user_one', 'user_two')
            ->wherePivot('matched', '=', 1)
            ->where('user_one', '=', $this->id)
            ->where('user_two', '=', $foreignUser->id)->getResults();

        $matchedThis = $this->belongsToMany('App\User', 'matches',
            'user_two', 'user_one')
            ->wherePivot('matched', '=', 1)
            ->where('user_two', '=', $this->id)
            ->where('user_one', '=', $foreignUser->id)->getResults();

        if (isset($thisMatched[0]->attributes['id']) && isset($matchedThis[0]->attributes['id'])) {
            return $foreignUser;
        } else {
            return null;
        }
    }

    /*public function getMatchesAttribute()
    {
        if (!array_key_exists('matches', $this->relations)) {
            $this->loadMatches();
        }

        return $this->getRelation('matches');
    }

    protected function loadMatches()
    {
        if (!array_key_exists('matches', $this->relations)) {
            $matches = $this->mergeMatches();

            $this->setRelation('matches', $matches);
        }
    }

    protected function mergeMatches()
    {
        return $this->matches->merge($this->matchedThis);
    }*/
}
