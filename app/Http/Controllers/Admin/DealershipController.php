<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Dealership;
use Inertia\Inertia;

class DealershipController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dealerships/Index', [
            'dealerships' => Dealership::latest()->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Dealerships/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:dealerships,code',
            'address' => 'required|string',
            'availability_enabled' => 'boolean'
        ]);

        Dealership::create($validated);

        return redirect()->route('admin.dealerships.index')->with('success', 'Dealership created successfully.');
    }
}
