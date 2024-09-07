<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units= Unit::with('unit')->paginate(10);
        return view('units.index',compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units= Unit::all();
        return view('units.create', compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->validate([
            'name' => 'required|string|min:3',
            'unit_id'=> '',
            'unit_multiplier'=> '',
        ]);
        
        Unit::create($data);
        return to_route('units.index')->with('success', 'تم اضافة وحدة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        $units= Unit::where('id', '<>', $unit->id)->where(function ($query) use ($unit) {
            $query->where('unit_id', '<>', $unit->id)
                ->orwhereNull('unit_id');
        })->get();
        return view('units.edit', ['unit' => $unit, 'units' => $units]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $data= $request->validate([
            'name' => 'required|string|min:3',
            'unit_id'=> '',
            'unit_multiplier'=> '',
        ]);
        $unit->update($data);
        return to_route('units.index')->with('success', 'تم تعديل وحدة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return to_route('units.index')->with('success', 'تم حذف وحدة بنجاح');
    }
}
