<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model {

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
    protected $fillable = ['name', 'description', 'venue_type_id', 'gps_latitude', 'gps_longitude', 'zip_postal_code', 'lat_top_left', 'lng_top_left', 'lat_top_right', 'lng_top_right', 'lat_bottom_left', 'lng_bottom_left', 'lat_bottom_right', 'lng_bottom_right'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];

    public static function addRectangle($NElat, $NElng, $SWlat, $SWlng, $type, $id) {
        $model = Venue::firstByAttributes(array('rec_id' => $id));
        if (!$model) {
            $model = new Venue();
        }
        $model->lat_top_right = $NElat;
        $model->lng_top_right = $NElng;
        $model->lat_bottom_left = $SWlat;
        $model->lng_bottom_left = $SWlng;
        $model->rec_id = $id;
        if ($model->save()) {
            return TRUE;
        }
        return FALSE;
    }

}
