<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AvailabilitySlot;
use Inertia\Inertia;

class AvailabilitySlotController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Manager/Slots/Index', [
            'slots' => $request->user()->availabilitySlots()->orderBy('date')->orderBy('start_time')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Manager/Slots/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time'
        ]);

        $request->user()->availabilitySlots()->create($validated);

        return redirect()->route('manager.slots.index')->with('success', 'Slot created.');
    }
}
