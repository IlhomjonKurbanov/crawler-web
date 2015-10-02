<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('redis/report');
    }

    public function connectRedis() {
        $redis = Redis::connection();
        return $redis;
    }

    public function getCountry() {
        $redis = $this->connectRedis();
        $total = $redis->get('totalMall');
        $returnArr = array();
        for ($i = 1; $i <= $total; $i++) {
            $item = $redis->hget('mall:' . $i, 'country');
            $returnArr[] = $item;
        }
        return response()->json(array_unique($returnArr));
    }

    public function getCityByCountry(Request $request) {
        $redis = $this->connectRedis();
        $country = $request->input('country');
        $total = $redis->get('totalMall');
        $returnArr = array();
        for ($i = 1; $i <= $total; $i++) {
            $item = $redis->hget('mall:' . $i, 'country');
            if (!empty($item) && $item == $country) {
                $items = $redis->hget('mall:' . $i, 'city');
                $returnArr[] = $items;
            }
        }
        return response()->json(array_unique($returnArr));
    }

    public function getMallByCity(Request $request) {
        $redis = $this->connectRedis();
        $city = $request->input('city');
        $total = $redis->get('totalMall');
        $returnArr = array();
        for ($i = 1; $i <= $total; $i++) {
            $item = $redis->hget('mall:' . $i, 'city');
            if (!empty($item) && $item == $city) {
                $items = $redis->hmget('mall:' . $i, 'mall_id', 'name', 'lat', 'lng');
                $itemArr = array();
                $itemArr['mall_id'] = $items[0];
                $itemArr['name'] = $items[1];
                $itemArr['lat'] = $items[2];
                $itemArr['lng'] = $items[3];
                $returnArr[] = $itemArr;
            }
        }
        return response()->json($returnArr);
    }
    
    public function getMallByCountry(Request $request) {
        $redis = $this->connectRedis();
        $country = $request->input('country');
        $total = $redis->get('totalMall');
        $returnArr = array();
        for ($i = 1; $i <= $total; $i++) {
            $item = $redis->hget('mall:' . $i, 'city');
            if (!empty($item) && $item == $country) {
                $items = $redis->hmget('mall:' . $i, 'mall_id', 'name', 'lat', 'lng');
                $itemArr = array();
                $itemArr['mall_id'] = $items[0];
                $itemArr['name'] = $items[1];
                $itemArr['lat'] = $items[2];
                $itemArr['lng'] = $items[3];
                $returnArr[] = $itemArr;
            }
        }
        return response()->json($returnArr);
    }

    public function getImagesByMall(Request $request) {
        $redis = $this->connectRedis();
        $mallId = $request->input('mall_id');
        $total = $redis->get('totalDownload');
        // echo $total;
        $returnArr = array();

        for ($i = 1; $i <= $total; $i++) {
            $item = $redis->hget('image:' . $i, 'mall_id');
            if (!empty($item) && $item == $mallId) {
                $items = $redis->hmget('image:' . $i, 'url', 'image_id', 'latitude', 'longitude');
                $itemArr = array();
                $itemArr['url'] = $items[0];
                $itemArr['image_id'] = $items[1];
                $itemArr['latitude'] = $items[2];
                $itemArr['longitude'] = $items[3];
                $returnArr[] = $itemArr;
            }
        }
        return response()->json($returnArr);
    }

    public function getImagesById(Request $request) {
        $redis = $this->connectRedis();
        $id = $request->input('image_id');
        $item = $redis->hGetAll('image:' . $id);
        return view('redis/view', array('data' => $item));
    }

}
