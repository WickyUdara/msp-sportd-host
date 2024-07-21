<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function dashboard(){
        $data['nav']="dashboard";
        return view('admin.dashboard',$data);
    }



    function categories(){
        $categories = DB::table('categories')->get();
        return view('admin.categories',compact('categories'));
    }
}
