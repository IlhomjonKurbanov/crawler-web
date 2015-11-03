<?php

namespace App;

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

    public static function add($lat, $lng, $radius, $id) {
        $model = Node::firstByAttributes(array('circle_id' => $id));
        if (!$model) {
            $model = new Node();
        }
        $model->latitude = $lat;
        $model->longitude = $lng;
        $model->radius = $radius;
        $model->circle_id = $id;
        $model->weight = 1;
        $model->path_id = 1;
        if ($model->save()) {
            return TRUE;
        }
        return FALSE;
    }

}
