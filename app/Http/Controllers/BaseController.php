<?php


namespace App\Http\Controllers;
use App\Service\Task\Service;
use Illuminate\Support\Facades\App;

class BaseController extends Controller
{
    public $service;

    public function __constructor(Service $service)
    {
        $this->service = $service;
    }
}
