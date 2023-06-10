<?php

namespace App\Http\Controllers\API;

use App\Models\Expert;
use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\HTTP\Controllers\Controller;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return response()->json($services);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'required|image',
            'price'=>'required|numeric'
        ]);

        $service = new Service();
        $service->title = $request->input('title');
        $service->description = $request->input('description');
        $service->image = $request->file('image')->store('services_images');
        $user = Auth::user();
        $expert = Expert::find($user->id);
        $expert_id = $expert->id;
        $service->expert_id = $expert_id;
        $service->save();
        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'required|image',
            'price'=>'required|numeric'
        ]);

        $service->title = $request->input('title');
        $service->description = $request->input('description');
        $service->image = $request->file('image')->store('services_images');
        $service->save();
        return redirect()->route('services.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index');
    }
}
