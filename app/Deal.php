<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'deals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['poi_id', 'name', 'start_date', 'end_date', 'description'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];

}
