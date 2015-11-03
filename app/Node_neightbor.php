<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Node_neightbor extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'node_neightbors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['path_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];
}
