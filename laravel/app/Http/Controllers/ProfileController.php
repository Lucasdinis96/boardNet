<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller {
    protected ProfileService $service;

    public function __construct(ProfileService $service) {
        $this->service = $service;
    }

    public function edit(Request $request): View {
        $data = $this->service->getEditData();
        return view('profile.edit', $data);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse {
        $this->service->updateProfile($request->user(), $request->validated());

        return Redirect::route('editProfile')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();

        $this->service->deleteAccount($user);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
