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
        return response()->json(array_filter(array_unique($returnArr)));
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
                $itemArr = $redis->hgetAll('mall:' . $i);
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
            $item = $redis->hget('mall:' . $i, 'country');
            if (!empty($item) && $item == $country) {
                $itemArr = $redis->hgetAll('mall:' . $i);
                $returnArr[] = $itemArr;
            }
        }
        return response()->json($returnArr);
    }

    public function getImagesByMall(Request $request) {
        $redis = $this->connectRedis();
        $mallId = $request->input('mall_id');
        $number = $request->input('number');
        $total = $redis->get('totalDownload');
        if ($number == 'All') {
            $number = $total;
        }
        if (empty($number)) {
            $number = 60000;
        }
        // echo $total;
        $returnArr = array();

        for ($i = 1; $i <= $number; $i++) {
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

    public function getImagesByMall2(Request $request) {
        $redis = $this->connectRedis();
        $mallId = $request->input('mall_id');
        $list = 'mallimage:' . $mallId;
        $arrList = $redis->lrange($list, 0, -1);
        $total = count($arrList);
        $number = $request->input('number');
        if ($number == 'All') {
            $number = $total;
        }
        if (empty($number) || $number == 'Limit') {
            $number = 1000;
        }
        $itemArr = array();
        $returnArr = array();
        $cnt = 0;
        foreach ($arrList as $item) {
            $cnt++;
            $items = $redis->hmget('image:' . $item, 'url', 'image_id', 'latitude', 'longitude');
//            var_dump($items);
//            die()
            $itemArr = array();
            if (!empty($items[2]) || !empty($items[3])) {
                $itemArr['url'] = $items[0];
                $itemArr['image_id'] = $item;
                $itemArr['latitude'] = $items[2];
                $itemArr['longitude'] = $items[3];
                $returnArr[] = $itemArr;
            }
            if ($cnt === (int) $number) {
                break;
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
