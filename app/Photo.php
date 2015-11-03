<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'photos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['s3_url', 'poi_id', 'venue_id', 'deal_id', 'user_id', 'post_id', 'photo_source', 'igestion_state'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];

}
