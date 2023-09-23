<?php

namespace App\Http\Controllers\CommonUser;

use App\Http\Controllers\Controller;
use App\Models\County;
use Illuminate\Http\Request;

class CasesController extends Controller
{
    public function index(){
        return view("user.cases.index");
    }
    public function create(){
        $counties = County::all();
        return view("user.cases.create", compact("counties"));
    }
}
