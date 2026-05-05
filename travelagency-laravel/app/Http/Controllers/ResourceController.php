<?php

namespace App\Http\Controllers;

use App\Models\TravelResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    public function store(Request $request)
    {
        // DEBUG - посмотрим что приходит
        \Log::info('Upload request', [
            'has_file' => $request->hasFile('image'),
            'files' => $request->allFiles(),
            'all' => $request->except('image'),
        ]);

        $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'required',
            'location'      => 'required',
            'region'        => 'required',
            'pricePerNight' => 'required|numeric',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $resource = new TravelResource();
        $resource->name          = $request->name;
        $resource->description   = $request->description;
        $resource->location      = $request->location;
        $resource->region        = $request->region;
        $resource->pricePerNight = $request->pricePerNight;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image    = $request->file('image');
            $ext      = $image->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $ext;

            // Убедимся что папка существует
            if (!file_exists(storage_path('app/public/resources'))) {
                mkdir(storage_path('app/public/resources'), 0755, true);
            }

            $image->move(storage_path('app/public/resources'), $filename);
            $resource->imageUrl = url('storage/resources/' . $filename);

            \Log::info('File saved', ['path' => $resource->imageUrl]);
        } else {
            \Log::warning('No file in request!');
            return response()->json(['message' => 'No image file received!'], 422);
        }

        $resource->save();

        return response()->json([
            'message'  => 'Resource created successfully!',
            'resource' => $resource,
            'imageUrl' => $resource->imageUrl
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $resource = TravelResource::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required',
            'location' => 'sometimes|required',
            'region' => 'sometimes|required',
            'pricePerNight' => 'sometimes|required|numeric',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->has('name')) $resource->name = $request->name;
        if ($request->has('description')) $resource->description = $request->description;
        if ($request->has('location')) $resource->location = $request->location;
        if ($request->has('region')) $resource->region = $request->region;
        if ($request->has('pricePerNight')) $resource->pricePerNight = $request->pricePerNight;

        if ($request->hasFile('image')) {
            if ($resource->imageUrl) {
                $oldPath = str_replace('storage/', 'public/', $resource->imageUrl);
                Storage::delete($oldPath);
            }

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/resources', $filename);
            $resource->imageUrl = url('storage/resources/' . $filename);        }

        $resource->save();

        return response()->json([
            'message' => 'Resource updated successfully!',
            'resource' => $resource
        ], 200);
    }
}
