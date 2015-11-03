<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Path;

class PathsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('paths')->delete();

        Path::create(['id' => 1, 'floor_level' => 1, 'svg_json' => '']);
    }

}
