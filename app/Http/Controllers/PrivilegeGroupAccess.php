<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\group_access;
class PrivilegeGroupAccess extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tampung=group_access::get();
        return view ('models.group_access', ['tampung'=>$tampung]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('models.create_group_access');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    // Simpan data ke dalam tabel "group_access_name"
    // group_access::create([
    //     'group_access_id' => $request->input('group_access_id'),
    // ]);

    // return redirect()->route('PrivilegeGroupAccess.index')->with('success', 'Data Group Access berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $PreGroupAccess = group_access::where('group_access_id', $id)->first();
        if (!$PreGroupAccess) {
            // Handle jika data tidak ditemukan
        }
        return view('models.privilege_edit_group_access', compact('PreGroupAccess'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $PreGroupAccess = group_access::where('group_access_id', $id)->first();
    if (!$PreGroupAccess) {
        // Handle jika data tidak ditemukan
    }

    // Validasi data yang diinputkan oleh pengguna (gunakan $request->validate)

    $PreGroupAccess->update([
        'group_access_id' => $request->input('group_access_id'),
        // Tambahkan kolom lain yang perlu diubah sesuai dengan tabel Anda
    ]);

    return redirect()->route('PreGroupAccess.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $groupAccess = group_access::where('group_access_name', $id)->first();

        // if ($groupAccess) {
        //     $groupAccess->delete();
        //     return redirect()->route('GroupAccess.index')->with('success', 'Data berhasil dihapus');
        // }
    
        // return redirect()->route('GroupAccess.index')->with('error', 'Data tidak ditemukan');
    }
    
}
