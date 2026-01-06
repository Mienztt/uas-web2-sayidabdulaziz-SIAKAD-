<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HaloController extends Controller
{
    function index(){
        $nama = "SAYID ABDUL AZIS";
        return view("halo.halo " , compact("nama"));
    }
}
