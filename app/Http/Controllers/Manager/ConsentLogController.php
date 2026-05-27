<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ConsentLog;
use App\Models\LegalDocument;
use Inertia\Inertia;

class ConsentLogController extends Controller
{
    public function create(Request $request)
    {
        return Inertia::render('Manager/ConsentLogs/Create', [
            'customers' => $request->user()->managerCustomers,
            'documents' => LegalDocument::where('is_active', true)->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'legal_document_id' => 'required|exists:legal_documents,id',
        ]);

        $validated['ip_address'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();
        $validated['consented_at'] = now();

        ConsentLog::create($validated);

        return redirect()->route('manager.dashboard')->with('success', 'Consent logged.');
    }
}
