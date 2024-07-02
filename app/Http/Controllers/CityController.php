<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Models\City;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
    //
    private City $city;
    public function __construct(City $city)
    {
        $this->city = $city;
    }
    public function saveData(){
        $file = File::get(storage_path('app\cities500.json'));
        $datas = json_decode($file,true);
        //split into arrays of 500 records each
        $chunks = array_chunk($datas,500);
        // foreach($chunks as $chunk){
        //     // insert to the database 500 records at a time
        //     $this->city::insert($chunk); // executing about 22s
        // }
        DB::beginTransaction();
        try {
            foreach ($chunks as $chunk) {
                DB::table('cities')->insert($chunk); // executing about 7s;
            }
            DB::commit();
            return ApiResponse::success("add data successful",200);
        } catch (Exception $e) {
            DB::rollback();
            return ApiResponse::error($e->getMessage(),400);
        }
    }
    public function index(){
        $timeStart = microtime(true);
        // $cities = Cache::remember('cache_cities',20, function () {
        //     return $this->city->all();
        // });
        $cities = $this->city->all();
        $timeExe = microtime(true) - $timeStart;
        return [
            "cities_size" => count($cities),
            "Exe_Time" => $timeExe
        ];
        // ApiResponse::testPerformance($cities,$timeExe,"hehe",201);
    }
}
