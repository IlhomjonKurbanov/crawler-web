<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Point_of_interest;
use App\Node;

class MapController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('map/index');
    }

    public function saveCircleToDatabase(Request $request) {
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $radius = $request->input('radius');
        $id = $request->input('id');
        $type = $request->input('type');

        if ($type === 'node') {
            $result = Node::add($lat, $lng, $radius, $id);
        } else if ($type == 'poi') {
            $result = Point_of_interest::add($lat, $lng, $radius, $id);
        }
        if ($result) {
            return response()->json(array('status' => 1, 'message' => 'Success'));
        }
        return response()->json(array('status' => 0, 'message' => 'Error !!'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
