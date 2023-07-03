<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // private function save_image($image){
    //     if($image){
    //         $image_name = time().'.'.$image->extension();
    //         $image->move(public_path('images/users'),$image_name);
    //         return $image_name;
    //     }
    // }
    protected function create(array $data)
    {
        $imagePath = null;

        if (isset($data['image']) && is_string($data['image'])) {
            $imagePath = 'users_images/' . time() . '_' . basename($data['image']);
            Storage::disk('public')->move($data['image'], $imagePath);
        } elseif (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $image = $data['image'];
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('users_images', $imageName, 'public');
        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image' => $imagePath
        ]);
    }

}











