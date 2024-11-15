<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // GET /api/patients
    public function index()
    {
        return Patient::all();
    }

    // POST /api/patients
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|in:male,female',
            'status' => 'required|string',
            'diagnosis_date' => 'required|date',
        ]);

        $patient = Patient::create($validatedData);
        return response()->json($patient, 201);
    }

    // GET /api/patients/{id}
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return response()->json($patient);
    }

    // PUT /api/patients/{id}
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'age' => 'integer',
            'gender' => 'in:male,female',
            'status' => 'string',
            'diagnosis_date' => 'date',
        ]);

        $patient->update($validatedData);
        return response()->json($patient);
    }

    // DELETE /api/patients/{id}
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return response()->json(null, 204);
    }
}
