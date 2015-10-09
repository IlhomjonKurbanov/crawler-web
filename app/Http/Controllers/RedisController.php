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

    public function updateImageList() {
        set_time_limit(0);
        
        $timeStart = time();
        $redis = $this->connectRedis();

        // get total image
        $totalImage = $redis->get('totalDownload');
        $totalMall = $redis->get('totalMall');

        $mallList = array();
        $limit = 10000;
        $pages = 0;
        
        $totalUpdatedImage = 0;

        echo 'Total images: ' . $totalImage . '<br/>';
        echo 'Total malls: ' . $totalMall . '<br/>';

        if ($totalImage > 0) {
            // get mall list and bind to array
            for ($i = 1; $i <= $totalMall; $i++) {
                $mall = $redis->hGetAll('mall:' . $i); // get a mall

                if ($mall) {
                    // reset image list
                    $redis->del('mallimage:' . $i);
                    $mallList[$mall['mall_id']] = array(
                        'total' => 0,
                        'imageList' => array()
                    );
                }
            }


            $pages = ceil($totalImage / $limit);
            for ($page = 0; $page < $pages; $page++) {
                // get images from Redis and update to mall list
                for ($i = $limit * $page; $i < min($limit * ($page + 1), $totalImage); $i++) {
                    $image = $redis->hGetAll('image:' . $i); // get mall ID from image
                    if ($image) {
                        $mallId = intval($image['mall_id']);
                        if (isset($mallList[$mallId])) {
                            $mallList[$mallId]['total'] ++;
                            $mallList[$mallId]['imageList'][] = $i;
                            
                            $totalUpdatedImage++;
                        }
                    }
                }

                // update mall DB
                foreach ($mallList as $key => $value) {
                    // update image list 
                    if ($mallList[$key]['imageList']) {
                        $redis->rpush('mallimage:' . $key, $mallList[$key]['imageList']);
                    }
                    
                    // reset image list
                    $mallList[$key]['imageList'] = array();
                }
            }
            
            echo 'Total image updated: ' . $totalUpdatedImage . '<br>';
            echo 'Last count images: <br>';
            var_dump($mallList);

            // update mall DB
            foreach ($mallList as $key => $value) {
                $redis->hset('mall:' . $key, 'totalImage', $value['total']);
            }
            
            echo 'Total execution time: ' . ((time() - $timeStart) / 3600);
        }
    }

}
