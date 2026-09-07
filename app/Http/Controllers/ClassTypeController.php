<?php

namespace App\Http\Controllers;

use App\Models\ClassType;
use Illuminate\Http\Request;

class ClassTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classTypes = ClassType::get();

        return view('class_type.index', compact('classTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('class_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'minutes' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
        ]);

        $cl = new ClassType();

        $cl->name = $request->name;
        $cl->description = $request->description ?? null;
        $cl->minutes =$request->minutes;

        $cl->update();

        return redirect()
            ->back()
            ->with('success', 'Class Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassType $classType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassType $classType)
    {
        return view('class_type.edit', compact('classType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassType $classType)
    {
         $validated = $request->validate([
            'name' => ['required', 'string', 'max:255',  'unique:class_types,name,' . $classType->id,],
            'minutes' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
        ]);

        $classType->name = $request->name;
        $classType->description = $request->description ?? null;
        $classType->minutes =$request->minutes;

        $classType->save();

        return redirect()
            ->back()
            ->with('success', 'Class Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassType $classType)
    {
        $classType->delete();
         return redirect()
            ->back()
            ->with('success', 'Class Deleted');
    }
}
