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
        //
    }

    public function connectRedis() {
        $redis = Redis::connection();
        return $redis;
    }

    public function getMallByCity(Request $request) {
        $redis = $this->connectRedis();
        $city = $request->input('city');
        $total = $redis->get('totalMall');
        $returnArr = array();
        for ($i = 1; $i <= $total; $i++) {
            $item = $redis->hGetAll('mall:' . $i);
            if (isset($item['city']) && $item['city'] == $city) {
                $returnArr[] = $item;
            }
        }
        return response()->json($returnArr);
    }

    public function getImagesByMall(Request $request) {
        $redis = $this->connectRedis();
        $mallId = $request->input('mall_id');
        $total = $redis->get('totalDownload');
        $returnArr = array();
        for ($i = 1; $i <= $total; $i++) {
            $item = $redis->hGetAll('image:' . $i);
            if (isset($item['mall_id']) && $item['mall_id'] == $mallId) {
                $returnArr[] = $item;
            }
        }
        return response()->json($returnArr);
    }

    public function getCityByCountry() {
        $redis = $this->connectRedis();
    }

}
