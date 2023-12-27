<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllocateModel;

class AllocateController extends Controller
{
    public function index()
    {
        // Retrieve a list of KP records from the AllocateModel
        $kpList = AllocateModel::all();

        return view('MainMenu.allocate', compact('kpList'));
    }

    public function show($id)
    {
        // Retrieve a specific KP record by ID from the AllocateModel
        $kp = AllocateModel::findOrFail($id);

        return view('allocate.show', compact('kp'));
    }

    public function create()
    {
        // Return a view for creating a new KP record
        return view('allocate.create');
    }

    public function store(Request $request)
    {
        // Validate and store a new KP record in the AllocateModel
        $validatedData = $request->validate([
            'kp' => 'required',
            'color' => 'required',
            'size' => 'required',
            'qty' => 'required',
            'pack' => 'required',
            'addi' => 'required',
            'pic' => 'required',
        ]);

        AllocateModel::create($validatedData);

        return redirect()->route('allocate.index')->with('success', 'KP record created successfully');
    }

    // You can add more methods for updating and deleting records as needed.

}
