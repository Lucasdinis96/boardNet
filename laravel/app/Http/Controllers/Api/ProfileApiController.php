<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Services\ProfileService;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileApiController extends Controller {
    protected ProfileService $service;

    public function __construct(ProfileService $service) {
        $this->service = $service;
    }

    public function show(Request $request) {
        $data = $this->service->getEditData();
        return response()->json(UserResource::collection($data));
    }

    public function update(ProfileUpdateRequest $request) {
        $this->service->updateProfile($request->user(), $request->validated());

        return response()->json([
            'message' => 'Perfil atualizado com sucesso.',
        ]);
    }

    /**
     * Exclui a conta do usuário autenticado
     */
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        
        $this->service->deleteAccount($user);

        // Se quiser invalidar o token atual
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Conta excluída com sucesso.'
        ]);
    }
}
