<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Sofa\Eloquence\Eloquence;

class User extends Authenticatable
{

    use Notifiable, Eloquence;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_card',
        'birth_date',
        'description',
        'politics',
        'img_name',
        'interests',
    ];

    protected $searchableColumns = [
        'name',
        'email',
    ];

    protected $dates = [
        'birth_date',
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
     * Return true if user is Moderator or Administrator
     *
     * @return bool
     */
    public function isModerator()
    {
        if ($this->role_id > 1) {
            return true;
        }
        return false;
    }

    /**
     * Returns true if user is Administrator
     *
     * @return bool
     */
    public function isAdministrator()
    {
        if ($this->role_id == 3) {
            return true;
        }
        return false;
    }


    /**
     * Returns true if user is regular User
     *
     * @return bool
     */
    public function isUser(){
        if ($this->role_id == 1){
            return true;
        }
        return false;
    }

    public function votingLocation()
    {
        return $this->belongsTo(VotingLocation::class);
    }

    /**
     * Relationship with votes table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vote()
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Relationship with roles table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    /**
     * Relationship with referendum_comments table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comment()
    {
        return $this->hasMany(ReferendumComment::class);
    }


}
