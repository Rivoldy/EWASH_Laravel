<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\menu;
use Alert;
class MenuModel extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $tampung=menu:: where ('menu_name', 'like', '%' . $search . '%')//->get();
        ->Paginate(15);
        return view ('models.menu', ['tampung'=>$tampung]);
    }


    public function search(Request $request)
{
    $search = $request->input('search');

    $query = menu::query();

    if ($search) {
        $query->where('menu_name', 'LIKE', '%' . $search . '%');
    }

    $tampung = $query->get();

    // ...

    return view('models.menu', ['tampung' => $tampung, 'search' => $search]);
}

    public function create()
    {
        return view('models.create_menu');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Simpan data ke dalam tabel "group_access_name"
    menu::create([
        'menu_name' => $request->input('menu_name'),
    ]);
    Alert::success('success', 'Data menu berhasil ditambahkan');
    return redirect()->route('menu.index');
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
        $menu = menu::where('menu_name', $id)->first();
        if (!$menu) {
            // Handle jika data tidak ditemukan
        }
        return view('models.edit_menu', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = menu::where('menu_name', $id)->first();
        if (!$menu) {
            // Handle jika data tidak ditemukan
        }
    
        // Validasi data yang diinputkan oleh pengguna (gunakan $request->validate)
    
        $menu->update([
            'menu_name' => $request->input('menu_name'),
            // Tambahkan kolom lain yang perlu diubah sesuai dengan tabel Anda
        ]);
        Alert::success('success', 'Data berhasil diperbarui');
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = menu::where('menu_name', $id)->first();

        if ($menu) {
            $menu->delete();
            Alert::success('success', 'Data berhasil dihapus');
            return redirect()->route('menu.index');
        }
    
        return redirect()->route('menu.index')->with('error', 'Data tidak ditemukan');
    }
}
