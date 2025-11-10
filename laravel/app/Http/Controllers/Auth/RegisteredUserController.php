<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisteredUserRequest;
use App\Services\RegisteredUserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisteredUserController extends Controller {
    protected RegisteredUserService $service;

    public function __construct(RegisteredUserService $service) {
        $this->service = $service;
    }

    public function create(): View {
        $data = $this->service->getRegisterData();
        return view('auth.register', $data);
    }

    public function store(RegisteredUserRequest $request): RedirectResponse {
        $this->service->register($request->validated());
        return redirect()->route('myTrades');
    }
}
