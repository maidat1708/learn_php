<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileCollection;
use App\Http\Resources\ProfileResource;
use App\Http\Responses\ApiResponse;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Profile $profile;
    public function __construct(Profile $profile){
        $this->profile = $profile;
    }

    public function index()
    {
        //
        $profles = $this->profile->all();
        if(count($profles) == 0){
            return ApiResponse::error(404,"Profile not found!!!");
        }
        return ApiResponse::success(new ProfileCollection($profles),"Get all profile successful");
    }

    public function showProfileUser(Request $request){
        return ApiResponse::success(
            new ProfileResource($this->profile->findProfileByUserId($request['user_id'])),"Find user's profile successful");

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
