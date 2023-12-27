<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    
    public function login(){
        
            return view('Login.login');
    }
    
    public function loginApi(Request $request){

       $request->validate([
            'fty' => 'required',
            'nik' => 'required',
            'pass' =>'required',
        ]);
    
            $fty =  $request->fty;
            $nik =  $request->nik;
            $pass =  $request->pass;
           

            //inisialisasi dlu
            $curl = curl_init();

            //set urlnya
            curl_setopt($curl, CURLOPT_URL, 'http://192.168.100.190/api/api/v1.0/login');
            //method
            curl_setopt($curl, CURLOPT_POST, true);

            //requestnya ke bodynya
            $data = array(
                    'fty'=>$fty,
                    'nik'=>$nik,
                    'password'=>$pass,
                    'namaaplikasi'=>'ewash'
            );
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

            //auth header
            $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJwcm9ncmFtIjoiZXdhc2gifQ.XRU3OM9jsUYJXPWV4IKa7rruVedKNYakmFYPLwYQyoQ";
            $headers = array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json',
                'Accept: application/json'
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            
            //memberikan return
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            //jalan execute
            $response = curl_exec($curl);
            
            //close
            curl_close($curl);
               
                
                $tampung = json_decode($response, true);
              
                if($tampung['success'] == true){
                    session(['autorize'=>true]);
                    session(['fty' => $fty]);
                    session(['name'=> $tampung ['data']['nama']]);
                    session(['nik' => $tampung['data']['nik']]); 
                    return redirect('home');
                }else{
                    return back()->with('Loginerror','NIK atau Password salah!');
                }
                
                // var_dump(json_decode($response, true));
                // dd($tampung['success']);
                
            }

    
        
}