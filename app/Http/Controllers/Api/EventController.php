<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Traits\CanLoadRelations;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{


    private array $allowedRelations = ['user', 'attendees'];

    use CanLoadRelations;

    public function __construct() {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return EventResource::collection($this->loadRelations(Event::query())->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedEvent = $request->validate([
            'name' => 'required',
            'description' => 'required|min:5',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d'
        ]);
        $user = Auth::user();
        Event::create([...$validatedEvent, 'user_id' => $user->id]);
        return response()->json([
            'message' => "Event created succssfully!"
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {

        Gate::authorize('view-event', $event);
        return new EventResource($this->loadRelations($event));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        Gate::authorize('delete', $event);
        $event->delete();
        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
