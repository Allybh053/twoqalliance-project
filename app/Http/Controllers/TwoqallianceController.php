<?php

namespace App\Http\Controllers;

use App\Models\twoqalliance;
use Illuminate\Http\Request;

class TwoqallianceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('twoqalliance.index', ['companies' => Twoqalliance::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('twoqalliance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:twoqalliances,email,' . ($twoqalliance->id ?? 'NULL'),
            'website' => 'nullable|url|unique:twoqalliances,website,' . ($twoqalliance->id ?? 'NULL'),
            'logo' => 'nullable|image|dimensions:min_width=100,min_height=100',
        ]);


        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        twoqalliance::create($validated);

        return redirect()->route('twoqalliance.index')->with('success', 'Company created');

    }

    /**
     * Display the specified resource.
     */
    public function show(twoqalliance $twoqalliance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(twoqalliance $twoqalliance)
    {
        return view('twoqalliance.edit', compact('twoqalliance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, twoqalliance $twoqalliance)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|unique:twoqalliances,email,' . $twoqalliance->id,
        'website' => 'nullable|url|unique:twoqalliances,website,' . $twoqalliance->id,
        'logo' => 'nullable|image|dimensions:min_width=100,min_height=100',
    ]);

    if ($request->hasFile('logo')) {
        if ($twoqalliance->logo) {
            Storage::disk('public')->delete($twoqalliance->logo);
        }
        $validated['logo'] = $request->file('logo')->store('logos', 'public');
    }

    $twoqalliance->update($validated);

    return redirect()->route('twoqalliance.index')->with('success', 'Company updated');
}

public function destroy(twoqalliance $twoqalliance)
{
    if ($twoqalliance->logo) {
        Storage::disk('public')->delete($twoqalliance->logo);
    }

    $twoqalliance->delete();

    return redirect()->route('twoqalliance.index')->with('success', 'Company deleted');
}
}
