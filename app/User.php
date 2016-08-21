<?php

namespace App;

use Flyer;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The database table used by the model
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * [owns description]
     * @param  [type] $relation [description]
     * @return [type]           [description]
     */
    public function owns($relation)
    {
        return $relation->user_id == $this->id;
    }

    /**
     * A User has many flyers.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flyers()
    {
        return $this->hasMany(Flyer::class);
    }

    /**
     * Save flyer to user.
     * 
     * @param  Photo  $photo
     * @return 
     */
    public function publish(Flyer $flyer)
    {
        return $this->flyers()->save($flyer);
    }
}
