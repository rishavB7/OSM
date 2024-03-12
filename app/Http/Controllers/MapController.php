<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\District_User_Map;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index() {
        $users = District_User_Map::all();
        $data = compact('users');

        return view('test')->with($data);

    }

    public function map_dist_user() {

    }
}
