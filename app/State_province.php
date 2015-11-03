<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class State_province extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states_provinces';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'country_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];

}
