<?php

namespace App\Http\Controllers\Constructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConstructorController extends Controller
{
    public function control(Request $request)
    {
        return view("constructor.creating_bot");
    }
}
