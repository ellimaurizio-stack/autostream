<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // Manager sees only their customers
        return Inertia::render('Manager/Customers/Index', [
            'customers' => $request->user()->managerCustomers()->latest()->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Manager/Customers/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string|max:50',
            'preferences' => 'nullable|string'
        ]);

        $request->user()->managerCustomers()->create($validated);

        return redirect()->route('manager.customers.index')->with('success', 'Customer created.');
    }
}
