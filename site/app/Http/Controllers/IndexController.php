<?php

namespace App\Http\Controllers;

use App\Services\IndexServiceController;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request): View
    {
        $serviceController = new IndexServiceController($request);

        return view('index', $serviceController->handle());
    }
}
