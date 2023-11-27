<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class AuthController extends BaseApiController
{

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * login user.
     *
     * @return Response
     */
    public function login(LoginRequest $request)
    {
        list($status, $message, $data, $code) = $this->userService->login($request->validated);

        if ($status) {

            return $this->fullDataResponse($data['token'], new UserResource($data['user']), $message, $code);
        }

        return $this->errorResponse($message, null, $code);
    }

}
