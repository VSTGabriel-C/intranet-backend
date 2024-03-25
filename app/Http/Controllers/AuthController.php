<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(Request $request)
    {
        $user = (new User)->login_model($request);

        return $user;
    }

    public function create(CreateUserRequest $request)
    {
        $user = (new User)->create_model($request);

        return $user;
    }

    public function update(Request $request)
    {
        $user = (new User)->update_model($request);

        return $user;
    }

    public function delete()
    {
        $user = (new User)->delete_model();

        return $user;
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->succes('', 'Successfully been logged out');
    }
}
