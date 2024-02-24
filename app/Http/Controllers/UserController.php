<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\ResponseBuilder;
use App\Services\UserService;

class userController extends BaseController
{
    public function __construct(private UserService $userService) {}

    public function getAll() {
        return ResponseBuilder::getResponse(
            fn() => $this->userService->getAll()
        );
    }

    public function getById($id) {
        return ResponseBuilder::getResponse(
            fn() => $this->userService->getById($id)
        );
    }

    public function create(Request $req) {
        $type = $user['type'] ?? 'USER';
        $context = $user['context'] ?? 'STANDARD';
        $user = $req->request->all(); // Convert InputBag to array
        return ResponseBuilder::getResponse(fn() =>
            $this->userService->create(
                $user['type'],
                $user['context'],
                $user['firebaseId'],
                $user['email'],
            )
        );
    }

    public function update($id, Request $req) {
        return ResponseBuilder::getResponse(fn() =>
            $this->userService->update(
                $id,
                $req->input('email'),
                $req->input('password'),
            )
        );
    }

    public function delete($id) {
        return ResponseBuilder::getResponse(
            fn() => $this->userService->delete($id)
        );
    }
}
