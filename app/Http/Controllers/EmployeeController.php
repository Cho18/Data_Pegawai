<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     */
    public function index(Request $request)
    {
        $employees = Employee::orderBy('name', 'asc')
            ->orderBy('gender', 'asc')
            ->orderBy('address', 'asc')
            ->orderBy('division', 'asc')
            ->orderBy('level', 'asc')
            ->orderBy('position', 'asc')
            ->orderBy('hire_date', 'asc')
            ->get();

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        return view('employees.add');
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(EmployeeRequest $request)
    {
        Employee::create([
            'profile'           => $request->profile,
            'name'              => $request->name,
            'gender'            => $request->gender,
            'address'           => $request->address,
            'division'          => $request->division,
            'level'             => $request->level,
            'position'          => $request->position,
            'salary'            => $request->salary,
            'hire_date'         => $request->hire_date,
        ]);

        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil ditambahkan');
    }

    public function uploadProfile(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $profilePath = $request->file('file')->store('profiles', 'public');
            return response()->json(['path' => $profilePath], 200);
        }

        return response()->json(['error' => 'Gagal.'], 400);
    }

}
