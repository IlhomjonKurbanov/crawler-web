<?php namespace App;

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
    protected $fillable = ['name', 'poi_type_id', 'poi_category_id', 'cover_photo', 'node_id', 'venue_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];
    
    public static function add($lat, $lng, $radius, $id, $type)
    {
        $model = new Point_of_interest;
        
    }

}
