<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\group_access;
use App\Models\role_access;
use App\Models\menu;
use Alert;

class ViewModel extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tampung = group_access::where('group_access_name', 'like', '%' . $search . '%')
            ->paginate(7);

        foreach ($tampung as $groupAccess) {
            $groupAccess->privilegeCount = role_access::where('role_access_group_access_id', $groupAccess->group_access_id)
                ->count();
        }

        return view('models.group_access', ['tampung' => $tampung, 'search' => $search]);
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
        $request->validate([
            'group_access_name' => 'required',
        ]);

        $group = new group_access;

        $group->group_access_name = $request->group_access_name;

        if ($group->save()) {
            Alert::success('Success', 'Menambahkan Group User Baru');
            return redirect('/GroupAccess');
        } else {
            Alert::error('Gagal', 'Terjadi kesalahan saat menambahkan Group User Baru');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Tambahkan logika tampilan data sesuai ID jika diperlukan.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $groupAccess = group_access::find($id);
        return view('models.edit_group_access', ['groupAccess' => $groupAccess]);
    }

    public function edit2($id)
{
    $menu = menu::latest()->get();
    $roleAccess = role_access::find($id);

    return view('models.edit_privilege', ['menu' => $menu, 'id' => $id, 'roleAccess' => $roleAccess]);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $groupAccess = group_access::where('group_access_name', $id)->first();
        if (!$groupAccess) {
            // Handle jika data tidak ditemukan
        }

        $groupAccess->update([
            'group_access_name' => $request->input('group_access_name'),
        ]);

        $roleAccess = role_access::where('role_access_group_access_id', $groupAccess->group_access_id)->first();

        if ($roleAccess) {
            $roleAccess->update([
                'role_access' => $request->input('privilege'),
            ]);
        }
        Alert::success('success', 'Data berhasil diperbarui');
        return redirect()->route('GroupAccess.index');
    }

    
    public function updateBatch(Request $request, $id)
    {
        $request->validate([
            'role_access' => 'required',
        ]);
        try{
            $roleAccessData = $request->input('role_access');
            $selected = $request->input('check_privilege');

            foreach ($selected as $roleId => $chk) {
                $roles = role_access::find($roleId);
    
                if ($roles) {
                    $roles->update([
                        'selected' => $chk,
                    ]);
                }
            }

            foreach ($roleAccessData as $roleId => $accessLevel) {
                $roles = role_access::find($roleId);
    
                if ($roles) {
                    $roles->update([
                        'role_access' => $accessLevel,
                    ]);
                }
            }
       
        return response()->json(['success' => true]); 
        Alert::success('Success', 'Update Berhasil');
        }catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
        
    }


    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $groupAccess = group_access::where('group_access_name', $id)->first();

        if ($groupAccess) {
            $groupAccess->delete();
            Alert::success('success', 'Data berhasil dihapus');
            return redirect()->route('GroupAccess.index')->with('success', 'Data berhasil dihapus');
        }

        return redirect()->route('GroupAccess.index')->with('error', 'Data tidak ditemukan');
    }

    public function editPrivilege($id)
    {
        $groupAccess = group_access::where('group_access_id', $id)->first();
        if (!$groupAccess) {
            // Handle if data is not found
        }
    
        $roleAccess = role_access::where('role_access_group_access_id', $groupAccess->group_access_id)->get();
    
        // Fetch the menu data
        $menu = menu::latest()->get();
    
        // Debugging: Print menu data
        dd($menu);
    
        return view('models.edit_privilege', compact('groupAccess', 'roleAccess', 'menu'));
    }
    



}
