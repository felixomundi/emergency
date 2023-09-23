<?php

namespace App\Http\Controllers\CommonUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CasesController extends Controller
{
    public function index(){
        return view("user.cases.index");
    }
    public function create(){
        return view("user.cases.create");
    }
}
