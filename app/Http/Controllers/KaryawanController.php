<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $karyawan = DB::table('users')
        ->join('jabatan', 'users.jabatan_id', '=', 'jabatan.id')
        ->select('users.*','jabatan.jabatan')
        ->Where('users.level', '!=', 'admin')
        ->get();
        
        return view('karyawan.index',[
            'title'=>'Data Karyawan',
            'karyawan'=>$karyawan,
            // 'karyawan'=>User::all()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('karyawan.create',[
        'title'=>'Data Karyawan',
        'jabatan'=>jabatan::all()
       ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik'=>'required|min:10|unique:users',
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255',
            'jk' => 'required',
            'nohp' => 'required|max:13',
            'jabatan_id' => 'required',
            'password' => 'required|min:5',
            'level' => 'required',
            'photo'=>'required'
        ]);
        // dd('berhasil');
        $validatedData['password'] =Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect('/karyawan')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = DB::table('users')
        ->join('jabatan', 'users.jabatan_id', '=', 'jabatan.id')
        ->select('users.*','jabatan.jabatan')
        ->where('users.id', $id)
        ->first();
        // dd($karyawan);
        return view('karyawan.edit',[
            'title'=>'Data Karyawan',
            'karyawan'=>$karyawan,
           'jabatan'=>jabatan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nik'=>'required|min:10',
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255',
            'jk' => 'required',
            'nohp' => 'required|max:13',
            'jabatan_id' => 'required',
            'password' => 'required|min:5',
            'level' => 'required',
        ]);
        // dd('berhasil');
        $validatedData['password'] =Hash::make($validatedData['password']);
        User::Where('id',$id)
               ->update($validatedData);
        return redirect('/karyawan')->with('success', 'Data Berhasil DiUpdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/karyawan')->with('success', 'Data Berhasil dihapus');
    
    
    }
    public function laporankaryawan()
    {
        $data['users'] = DB::table('users')
        ->join('jabatan', 'users.jabatan_id', '=', 'jabatan.id')
        ->select('users.*','jabatan.jabatan')
        ->Where('users.level', '!=', 'admin')
        ->get();
        $pdf = Pdf::loadView('karyawan.laporan', $data);
        return $pdf->download('laporan-data-karyawan.pdf');
        
    }
}
