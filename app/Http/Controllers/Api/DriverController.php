<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function show(Request $request)
    {
        // return user associate with driver 
        return $request->user()->driver;
    }
    
    
    public function update(Request $request)
    {
        // return user 
    }
}
