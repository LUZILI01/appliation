<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLocation;

class UserLocationController extends Controller
{
    // 存储用户位置
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        
        UserLocation::create($request->all());

        return response()->json(['message' => 'Location saved successfully.']);
    }

    // 获取所有用户的位置
    public function getLocations()
    {
        $locations = UserLocation::all();
        return response()->json($locations);
    }
}
