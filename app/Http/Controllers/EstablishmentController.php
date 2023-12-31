<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establishment;
use App\Models\Destination;
use App\Models\Service;
use App\Models\Room;
use App\Models\Ride;
use App\Models\Cottage;

class EstablishmentController extends Controller
{
    public function index()
    {
        // Retrieve a list of establishments from your data source
        $establishments = Establishment::all(); // You'll need to replace 'Establishment' with your actual model name

        // Return a view to display the list of establishments
        return view('admin.establishments.index', compact('establishments'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $establishment = new Establishment;
        // Retrieve all destinations from the database
        $destinations = Destination::where('status', 1)->get();
 

        return view('admin.establishments.create', ['establishment' => $establishment, 'destinations' => $destinations]);
    }

    public function store(Request $request)
    {

        
        // Validate input
        $validatedData =  $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'location' => 'string|max:255',
            'destination_id' => 'required',
        ]); 
        
        // Create a new establishment using the validated data
        $establishment = Establishment::create( $validatedData );

        // Upload and associate multiple images with the establishment
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images/establishments', 'public');
                $establishment->images()->create(['image_path' => $imagePath]);
            }
        }
        
        $establishment->destination()->associate($request->input('destination_id'));
        

        // Redirect to the appropriate page (e.g., show the created establishment)
        return redirect()->route('admin.establishments.show', $establishment->id);
    }


    public function show(string $id)
    {
        // Retrieve the specific establishment based on the provided $id
        $establishment  = Establishment::findOrFail($id);

        $services       = $establishment->services;
        $rides          = $establishment->rides;
        $rooms          = $establishment->rooms;
        $images         = $establishment->images;
        $cottages       = $establishment->cottages;

        // Return a view to display the details of the establishment
        return view('admin.establishments.show', compact('establishment', 'rides', 'images', 'rooms', 'cottages'));
    }


    public function edit(string $id)
    {
        // Retrieve the specific establishment based on the provided $id
        $establishment = Establishment::findOrFail($id);
        $destinations = Destination::where('status', 1)->get();
        $images       = $establishment->images;
        // Return a view with a form for editing the establishment
        return view('admin.establishments.edit', compact('establishment', 'destinations', 'images'));
    }


    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            // Define validation rules for your establishment fields here
        ]);

        // Retrieve the specific establishment based on the provided $id
        $establishment = Establishment::findOrFail($id);

        // Update the establishment with the validated data
        $establishment->update($validatedData);

        // Upload and associate multiple images with the establishment
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images/establishments', 'public');
                $establishment->images()->create(['image_path' => $imagePath]);
            }
        }
        
        $establishment->destination()->associate($request->input('destination_id'));

        // Redirect to the appropriate page (e.g., show the updated establishment)
        return redirect()->route('admin.establishments.show', $establishment->id);
    }


    public function destroy(string $id)
    {
        // Retrieve the specific establishment based on the provided $id
        $establishment = Establishment::findOrFail($id);

        // Delete the establishment
        $establishment->delete();

        // Redirect to the index page (list of establishments) or any other appropriate page
        return redirect()->route('admin.establishments.index');
    }

    public function storeRoom(Request $request, Establishment $establishment)
    { 

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'nullable|numeric',
            'price' => 'nullable|numeric',
        ]);

        $room = new Room([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'capacity' => $request->input('capacity'),
            'price' => $request->input('price'),
        ]);

        $establishment->rooms()->save($room);

        return redirect()->route('admin.establishments.show', $establishment)->with('success', 'Room created successfully.');
    }

    public function updateRoom(Request $request, Establishment $establishment, Room $room)
    {
         
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'nullable|numeric',
            'price' => 'nullable|numeric',
        ]);
 
        // Update the attributes of the existing Ride model
        $room->name = $request->input('name');
        $room->description = $request->input('description');
        $room->capacity = $request->input('capacity');
        $room->price = $request->input('price');

        // Save the updated model
        $room->save();

        return redirect()->route('admin.establishments.show', $establishment);
    }

    public function storeRide(Request $request, Establishment $establishment)
    { 

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
        ]);

        $ride = new Ride([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ]);

        $establishment->rides()->save($ride);

        return redirect()->route('admin.establishments.show', $establishment)->with('success', 'Room created successfully.');
    }

    public function updateRide(Request $request, Establishment $establishment, Ride $ride)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
        ]);
 
        // Update the attributes of the existing Ride model
        $ride->name = $request->input('name');
        $ride->description = $request->input('description');
        $ride->price = $request->input('price');

        // Save the updated model
        $ride->save();


        return redirect()->route('admin.establishments.show', $establishment);
    }

    public function deleteRoom(Establishment $establishment, Room $room)
    {
        $room->delete();

        return redirect()->route('admin.establishments.show', $establishment);
    }

    public function deleteRide(Establishment $establishment, Ride $ride)
    {
        $ride->delete();

        return redirect()->route('admin.establishments.show', $establishment);
    }

    public function deleteCottage(Establishment $establishment, Cottage $cottage)
    {
        $cottage->delete();

        return redirect()->route('admin.establishments.show', $establishment);
    }

    // For Services
    public function storeService(Request $request, Establishment $establishment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $service = new Service([
            'name' => $request->input('name'),
        ]);

        $establishment->services()->save($service);

        return redirect()->route('admin.establishments.show', $establishment);
    }

    public function updateService(Request $request, Establishment $establishment, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $service->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.establishments.show', $establishment);
    }

    public function deleteService(Establishment $establishment, Service $service)
    {
        $service->delete();

        return redirect()->route('admin.establishments.show', $establishment);
    }
}
