<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Traits\CanLoadRelations;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{


    private array $allowedRelations = ['user', 'attendees'];

    use CanLoadRelations;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {

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
    public function destroy(string $id)
    {
        //
    }
}
