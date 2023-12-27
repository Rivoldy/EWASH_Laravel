<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\privilege;
use App\Models\privSambi;
use App\Models\group_access;
use Alert;
class PrivilegeKlegoSambi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $fty = session('fty');
    $query = $request->input('search');

    // Determine the model based on the session variable $fty
    if ($fty == '14') {
        $ewash = privilege::where('privilege_user_name', 'like', '%' . $query . '%')->get();
    } elseif ($fty == '15') {
        $ewash = privSambi::where('privilege_user_name', 'like', '%' . $query . '%')->get();
    } else {
        return redirect()->back()->withErrors(['ewash' => 'Invalid $ewash value']);
    }

    // Fetch group access data
    $groupAccessData = group_access::get();
    // dd($groupAccessData);
    return view('models.user_management', ['ewash' => $ewash, 'search' => $query, 'groupAccessData' => $groupAccessData]);
}
    

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $group = group_access::get();
        return view('models.create_user_management', ['group' => $group]);
    }
    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        $request->validate([
            'privilege_user_nik' => 'required',
            'privilege_user_name' => 'required',
            'privilege_group_access_id' => 'required',
            'privilege_rfid' => 'required',
            'privilege_aktif' => 'required',
        ]);
       
        $fty = session('fty');

        if ($fty == '14') {
            $model = new privilege();
        } elseif ($fty == '15') {
            $model = new privSambi();
        } else {
            return redirect()->back()->withErrors(['ewash' => 'Invalid $ewash value']);
        }

        $model->privilege_user_nik = $request->privilege_user_nik;
        $model->privilege_user_name = $request->privilege_user_name;
        $model->privilege_group_access_id = $request->privilege_group_access_id;
        $model->privilege_rfid = $request->privilege_rfid;
        $model->privilege_aktif = $request->privilege_aktif;
        $model->save();   
        if ($model->save()) {
            Alert::success('Berhasil', 'Menambahkan User Baru');
            return redirect('privilegeKlegoSambi');
        } else {
            
            Alert::error('Gagal', 'Terjadi kesalahan saat menambahkan Baru');
            return redirect()->back(); 
        }
       
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
    public function edit($id)
    {
        
        $fty = session('fty');

        if ($fty == '14') {
            $edit = privilege::find($id);
            $group = group_access::get();
            return view('models.edit_user_management', ['edit'=>$edit, 'group' => $group]);
        } elseif ($fty == '15') {
            $edit = privSambi::find($id);
            $group = group_access::get();
            return view('models.edit_user_management', ['edit'=>$edit, 'group' => $group]);
        } else {
            return redirect()->back()->withErrors(['ewash' => 'Invalid $ewash value']);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    // Update the specified resource in storage.
    public function update(Request $request, string $id)
    {
        $request->validate([
            'privilege_user_nik' => 'required',
            'privilege_user_name' => 'required',
            'privilege_group_access_id' => 'required',
            'privilege_rfid' => 'required',
            'privilege_aktif' => 'required',
        ]);


        $edit = privilege::find($id);
        $edit = privSambi::find($id);
        $edit->privilege_user_nik = $request->privilege_user_nik;
        $edit->privilege_user_name = $request->privilege_user_name;
        $edit->privilege_group_access_id = $request->privilege_group_access_id;
        $edit->privilege_rfid = $request->privilege_rfid;
        $edit->privilege_aktif = $request->privilege_aktif;
        $edit->save();

        if ($edit->save()) {
            Alert::success('Berhasil', 'Update User');
            return redirect('privilegeKlegoSambi'); 
        } else {
            Alert::error('Gagal', 'Terjadi kesalahan saat Update User');
            return redirect()->back(); 
        }
    }
    
    

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fty = session('fty');

        if ($fty == '14') {
            $privilage = privilege::find($id);
            // dd($id);
            $privilage->delete(); 

            return redirect('privilegeKlegoSambi');
        } elseif ($fty == '15') {
            $privilage = PrivSambi::find($id);

            $privilage->delete(); 

            return redirect('privilegeKlegoSambi');
        } else {
            return redirect()->back()->withErrors(['ewash' => 'Invalid $ewash value']);
        }
       
    }
}
