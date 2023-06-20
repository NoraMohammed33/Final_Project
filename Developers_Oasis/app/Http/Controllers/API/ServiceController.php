<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ServiceResource;
use App\Models\Expert;
use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\HTTP\Controllers\Controller;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::withCount('contracts')->get();

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
        $service = new Service();
        $service->title = $request->input('title');
        $service->description = $request->input('description');
        $service->price = $request->input('price');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('services_images', $imageName, 'public');
            $service->image = $imagePath;
        }
        $userId = Auth::user()->getAuthIdentifier();
        $expertId = Expert::where('user_id', $userId)->first()->id;
        $service->expert_id = $expertId;
        $service->save();
        return response()->json('Service saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service);
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
    public function update(UpdateServiceRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->title = $request->input('title');
        $service->description = $request->input('description');
        $service->price = $request->input('price');
        if ($request->hasFile('image')) {
            $imagePath = 'public/' . $service->image;
            Storage::delete($imagePath);
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('services_images', $imageName, 'public');
            $service->image = $imagePath;
        }
        $service->save();
        return response()->json('Service updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $imagePath = 'public/' . $service->image;
        Storage::delete($imagePath);
        $service->delete();
        return response()->json('Service deleted successfully');
    }
}

