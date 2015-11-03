<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Footprint extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'footprints';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'node_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];

}
