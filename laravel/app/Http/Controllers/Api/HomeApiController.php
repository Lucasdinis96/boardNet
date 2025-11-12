<?php

namespace App\Http\Controllers\Api;

use App\Services\HomeService;

class HomeApiController extends Controller {
    protected $service;

    public function __construct(HomeService $service) {
        $this->service = $service;
    }

    public function index() {
        $data = $this->service->getHomeData();
        return response()->json($data);
    }
}
