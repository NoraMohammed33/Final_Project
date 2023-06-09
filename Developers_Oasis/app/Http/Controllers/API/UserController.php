<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\File;
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Department;
use App\Models\Service;
use App\Models\Expert;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use Exception;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{

    public function profile(Request $request)
    {
        $user = $request->user();
        $services = Service::with('ratings')->where('expert_id', $user->id)->get(); // Fetch services associated with the user
        $serviceRating = ServiceRating::where('user_id', $user->id)->get(); // Fetch service ratings given by the user

        return response()->json([
            'user' => $user,
            'services' => $services,
            'serviceRating' => $serviceRating,
        ]);
    }
    public function getUser(Request $request)
    {
        return $request->user();
    }
    public function index()
    {
        return UserResource::collection(User::all());
    }



    public function store(StoreUserRequest $request)
    {

        $user =User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'image'=>$request['image']
        ]);

        return new UserResource($user);
    }







    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($user)
            try {
                $user->update($request->all());
                return new UserResource($user);
            } catch (Exception $e) {
                return $e;
            }
        else {
            return response('', 404);
        }
    }
    public function destroy(User $user)
    {
        if ($user) {
            try {
                $user->delete();
                return new Response('', 204);
            } catch (Exception $e) {
                return $e;
            }
        } else {
            return response()->json('', 404);
        }
    }
}



