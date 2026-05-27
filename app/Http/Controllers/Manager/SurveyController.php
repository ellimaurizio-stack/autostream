<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Survey;
use App\Models\TestDrive;
use Inertia\Inertia;

class SurveyController extends Controller
{
    public function create(Request $request)
    {
        $testDrives = TestDrive::with('customer', 'vehicleModel')
            ->whereHas('customer', function($q) use ($request) {
                $q->where('manager_id', $request->user()->id);
            })
            ->whereDoesntHave('survey') // A test drive should have only 1 survey ideally
            ->get();

        return Inertia::render('Manager/Surveys/Create', [
            'testDrives' => $testDrives
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'test_drive_id' => 'required|exists:test_drives,id',
            'driving_rating' => 'required|integer|min:1|max:5',
            'comfort_rating' => 'required|integer|min:1|max:5',
            'positive_feedback' => 'nullable|string',
            'negative_feedback' => 'nullable|string',
            'privacy_consent' => 'boolean'
        ]);

        Survey::create($validated);
        
        // Mark test drive as completed
        TestDrive::where('id', $validated['test_drive_id'])->update(['status' => 'COMPLETED']);

        return redirect()->route('manager.dashboard')->with('success', 'Survey submitted.');
    }
}
