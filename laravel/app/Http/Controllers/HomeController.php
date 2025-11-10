<?php

namespace App\Http\Controllers;

use App\Services\HomeService;

class HomeController extends Controller {
    protected $service;

    public function __construct(HomeService $service) {
        $this->service = $service;
    }

    public function index() {
        $data = $this->service->getHomeData();
        return view('home', $data);
    }
}
