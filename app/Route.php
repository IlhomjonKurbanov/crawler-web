<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'routes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['origin_node_id', 'destination_node_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];

}
