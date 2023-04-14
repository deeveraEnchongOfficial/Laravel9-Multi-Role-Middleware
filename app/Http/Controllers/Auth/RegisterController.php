<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Shops;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Faker\Guesser\Name;
use App\Notifications\ShopRegistration;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        // dd($data['role']);

        if (isset($data['role'])) {

            $user = User::create([
            'role' => $data['role'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $shop = $user->shops()->create([
            'shop_name' => $data['shop_name'],
            'user_role_id' => $data['role'],
            'address' => $data['address'],
            'users_id' => $user->id,
        ]);

        if (!$user->role) {
            $user->role = 'user';
            $user->save();
        }

        Notification::route('mail', $data['email'])
            ->notify(new ShopRegistration($user));

        return $user;

        } else {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }
    }

    protected function registered($request, $user)
    {
        Auth::logout(); // Log out the newly registered user

        return redirect()
        ->route("login")->with('success', 'Your Account is created successfully check your gmail for other info.');
    }
}
