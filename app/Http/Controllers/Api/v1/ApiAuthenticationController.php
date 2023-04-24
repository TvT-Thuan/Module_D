<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\CitizenResource;
use App\Models\Citizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthenticationController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = Citizen::CitizenLogin($request);
        if ($data) {
            return response()->json($data);
        }
        return response()->json(['message' => 'Invalid login'], 401);
    }

    public function logout(Request $request)
    {
        if (Citizen::CitizenLogout($request->token)) {
            return response()->json(['message' => 'Logout success']);
        }
        return response()->json(['message' => 'Invalid token'], 401);
    }
}
