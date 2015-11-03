<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nodes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['path_id', 'latitude', 'longitude', 'radius', 'circle_id', 'weight'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];
    
    public function saveNode()
    {
        
    }

}
