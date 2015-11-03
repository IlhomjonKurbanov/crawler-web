<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'relationships';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'friend_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];

}
