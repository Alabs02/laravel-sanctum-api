<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Exception, Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Actions\CreateUserAction;
use App\Http\Controllers\Api\BaseController as BaseController;

class AuthController extends BaseController
{
    public function signin(Request $request)
    {
        $authUser = User::where('email', $request->email)->first();
        if(Hash::check($request->password, $authUser->password)) {
            $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken;
            $success['name'] =  $authUser->name;
            $success['type'] = 'user';

            return $this->sendResponse($success, 'User signed in', 200);
        } else {
            return $this->sendError('Error', ['error' => 'User does not exists or invalid details.'], 422);
        }
    }

    public function signup(UserRequest $request, CreateUserAction $createUserAction)
    {
        try {
            $user = $createUserAction->execute($request->data());
            $success['token'] = $user->createToken('Mile9App')->plainTextToken;
            $success['name'] = $user->name;
            $success['type'] = 'user';

            return $this->sendResponse($success, 'User created successfully.', 201);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), ['error' =>$e->getMessage()], 422);
        }
    }
}
