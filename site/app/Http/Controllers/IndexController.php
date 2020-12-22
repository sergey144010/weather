<?php

namespace App\Http\Controllers;

use App\Services\IndexServiceController;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $serviceController = new IndexServiceController($request);

        return view('index', $serviceController->handle());
    }
}
