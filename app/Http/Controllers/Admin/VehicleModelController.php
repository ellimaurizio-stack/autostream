<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\VehicleModel;
use Inertia\Inertia;

class VehicleModelController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/VehicleModels/Index', [
            'vehicleModels' => VehicleModel::latest()->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/VehicleModels/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'fuel_type' => 'required|string|max:50'
        ]);

        VehicleModel::create($validated);

        return redirect()->route('admin.vehicle-models.index')->with('success', 'Vehicle Model created.');
    }
}
