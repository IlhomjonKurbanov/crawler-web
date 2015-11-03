<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point_of_interest extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'points_of_interest';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'poi_type_id', 'poi_category_id', 'cover_photo', 'node_id', 'venue_id', 'latitude', 'longitude', 'radius', 'circle_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];

    public static function add($lat, $lng, $radius, $id) {
        $model = Point_of_interest::firstByAttributes(array('circle_id' => $id));
        if (!$model) {
            $model = new Point_of_interest();
        }
        $model->name = '';
        $model->poi_type_id = 1;
        $model->poi_category_id = 1;
        $model->cover_photo = 'test';
        $model->node_id = 5;
        $model->venue_id = 3;
        $model->latitude = $lat;
        $model->longitude = $lng;
        $model->radius = $radius;
        $model->circle_id = $id;
        if ($model->save()) {
            return TRUE;
        }
        return FALSE;
    }

}
