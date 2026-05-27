<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\LegalDocument;
use Inertia\Inertia;

class LegalDocumentController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/LegalDocuments/Index', [
            'documents' => LegalDocument::latest()->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/LegalDocuments/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:PRIVACY_POLICY,TERMS_CONDITIONS',
            'version' => 'required|string|max:50',
            'content' => 'required|string',
            'is_active' => 'boolean'
        ]);

        if ($validated['is_active']) {
            LegalDocument::where('type', $validated['type'])->update(['is_active' => false]);
        }

        LegalDocument::create($validated);

        return redirect()->route('admin.legal-documents.index')->with('success', 'Document created.');
    }
}
