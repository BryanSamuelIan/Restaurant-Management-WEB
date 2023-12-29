<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();

        return view('event.index', ['events' => $events,
            'pagetitle' => "events"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('event.create', [
            'pagetitle' => "Buat Event"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'banner' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string',
            'is_active' => 'required',
        ]);

        // Check if the file was uploaded successfully
        if ($request->hasFile('banner')) {
            $imagePath = $request->file('banner')->store('images', 'public');

            // Create Event using validated data
            $event = Event::create([
                'name' => $validatedData['name'],
                'banner' => $imagePath, // Store the path to the uploaded image
                'is_active' => $validatedData['is_active'],
            ]);

            if ($event) {
                return redirect()->route('owner.events')->with('success', 'Event created successfully');
            } else {
                return redirect()->back()->withInput()->withErrors(['Failed to create event']);
            }
        }

        return redirect()->back()->withInput()->withErrors(['banner' => 'Failed to upload image']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $eventEdit = Event::find($id);
        return view('event.edit', ['eventEdit' => $eventEdit,
            'pagetitle' => "Edit Event"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'name' => 'required|string',
            'is_active' => 'required',
            'banner' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $event = Event::find($id);

        if ($request->hasFile('banner')) {

            if ($event->banner) {
                Storage::disk('public')->delete($event->banner);
            }


            $bannerPath = $request->file('banner')->store('images', 'public');

            $event->update([
                'name' => $validatedData['name'],
                'banner' => $bannerPath,
                'is_active' => $validatedData['is_active'],
            ]);
        } else {

            $event->update([
                'name' => $validatedData['name'],
                'is_active' => $validatedData['is_active'],
            ]);
        }

        return redirect()->route('owner.events');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $old = Event::find($id);

        if ($old->banner) {
            if (Storage::disk('public')->exists($old->banner)) {
                Storage::disk('public')->delete($old->banner);
            }
        }
        Event::find($id)->delete();
        return redirect()->route('owner.events');

    }
}
