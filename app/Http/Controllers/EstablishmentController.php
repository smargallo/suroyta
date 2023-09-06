<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establishment;
use App\Models\Destination;

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
            'description' => 'required|string',
            'location' => 'required|string|max:255',
        ]);

        // Create a new establishment using the validated data
        $establishment = Establishment::create($validatedData);

        
        // Attach the selected destination to the new establishment
        $establishment->destinations()->attach($request->input('destination_id'));

        // Redirect to the appropriate page (e.g., show the created establishment)
        return redirect()->route('admin.establishments.show', $establishment->id);
    }


    public function show(string $id)
    {
        // Retrieve the specific establishment based on the provided $id
        $establishment = Establishment::findOrFail($id);

        // Return a view to display the details of the establishment
        return view('admin.establishments.show', compact('establishment'));
    }


    public function edit(string $id)
    {
        // Retrieve the specific establishment based on the provided $id
        $establishment = Establishment::findOrFail($id);

        // Return a view with a form for editing the establishment
        return view('admin.establishments.edit', compact('establishment'));
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

}
