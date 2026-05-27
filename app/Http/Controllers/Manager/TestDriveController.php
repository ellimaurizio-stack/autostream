<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TestDrive;
use Inertia\Inertia;

class TestDriveController extends Controller
{
    public function index(Request $request)
    {
        // Get test drives for this manager's customers
        $customers = $request->user()->managerCustomers()->pluck('id');
        $testDrives = TestDrive::with(['customer', 'vehicleModel', 'availabilitySlot'])
            ->whereIn('customer_id', $customers)
            ->orderBy('date', 'desc')
            ->get();

        return Inertia::render('Manager/TestDrives/Index', [
            'testDrives' => $testDrives
        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('Manager/TestDrives/Create', [
            'customers' => $request->user()->managerCustomers,
            'vehicleModels' => \App\Models\VehicleModel::all(),
            'slots' => $request->user()->availabilitySlots()->where('is_booked', false)->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_model_id' => 'required|exists:vehicle_models,id',
            'availability_slot_id' => 'nullable|exists:availability_slots,id',
            'date' => 'required|date',
            'scheduled_time' => 'required|date_format:H:i',
        ]);

        // Generate a random code
        $validated['reservation_code'] = strtoupper(substr(uniqid(), -6));
        $validated['status'] = 'BOOKED';

        TestDrive::create($validated);

        if (!empty($validated['availability_slot_id'])) {
            \App\Models\AvailabilitySlot::where('id', $validated['availability_slot_id'])->update(['is_booked' => true]);
        }

        return redirect()->route('manager.test-drives.index')->with('success', 'Test Drive booked.');
    }
}
