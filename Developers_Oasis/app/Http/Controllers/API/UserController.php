<?php

namespace App\Http\Controllers\API;

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

class UserController extends Controller
{

    public function profile(Request $request)
    {
        $user = $request->user();
        $service = Service::with('ratings')->first(); // Modify this to fetch the appropriate service
        $serviceRating = ServiceRating::first(); // Modify this to fetch the appropriate service rating
        $expert = Expert::with('department')->first(); // Modify this to fetch the appropriate expert
        $department = Department::first(); // Modify this to fetch the appropriate department

        return response()->json([
            'user' => $user,
            'service' => $service,
            'serviceRating' => $serviceRating,
            'expert' => $expert,
            'department' => $department,
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
//dd($request);
//        $user = User::create($request->all());
        $user =User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
//            'image'=>$request['image']
        ]);
//        $dept_id=$request['dept_id'];
//        $bio=$request['bio'];
//        $user_id=$request['user_id'];
//        $expert_info=["dept_id"=>$dept_id,"bio"=>$bio,"user_id"=>$user_id];
//        $expert= $this->storeExpirt($expert_info);
        return new UserResource($user);
    }


//    private function storeExpirt(Array $expert_info)
//    {
////        return $expert_info['dept_id"];
//        $expert = Expert::create([
//        'dept_id' => $expert_info['dept_id'],
//        'bio' => $expert_info['bio'],
//        'user_id' =>  $expert_info['user_id']
//
//    ]);
//        return $expert;
//
//    }





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



