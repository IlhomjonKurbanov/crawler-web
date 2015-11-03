<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Venues extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'venues';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'venue_type_id', 'gps_latitude', 'gps_longitude', 'zip_postal_code'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];

}
