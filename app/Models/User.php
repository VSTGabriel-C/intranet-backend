<?php

namespace App\Models;

use App\Traits\HttpResponses;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HttpResponses;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
        'token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    public function login_model($request)
    {
        $headers = [
            'email' => $request->header()['php-auth-user'][0],
            'password' => $request->header()['php-auth-pw'][0],
        ];

        if (!Auth::attempt($headers)) {
            return $this->error('', 'Credential do not match', 401);
        }

        $user = User::where('email', $headers['email'])->first();

        $token = $user->createToken('API Token of' . $user->email)->plainTextToken;

        return $this->succes([
            'user' => $user,
            'token' => $token
        ], 'login success');
    }

    public function create_model($request)
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'admin' => $request->admin,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('API Token of' . $user->email)->plainTextToken;

        return $this->succes([
            'user' => $user,
            'token' => $token
        ], 'User created successfully');
    }

    public function update_model(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        if (!$user) {
            return $this->error('', 'Credential do not match', 401);
        }

        $user->update($request->all());

        return $this->succes([
            'user' => $user
        ], 'User updated successfully');
    }

    public function delete_model()
    {
        $user = User::where('id', Auth::user()->id)->first();
        if (!$user) {
            return $this->error('', 'Credential do not match', 401);
        }

        $user->delete();

        return $this->succes('', 'User deleted successfully');
    }
}
