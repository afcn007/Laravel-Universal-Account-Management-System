<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UcController extends Controller
{
    //
    public function getUserInfo(Request $request){
        return $request->user();
    }
}
