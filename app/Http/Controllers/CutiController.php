<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
class CutiController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuti = DB::table('cuti')
        ->join('users', 'cuti.user_id', '=', 'users.id')
        ->select('users.nama','cuti.*')
        ->get();
        return view('cuti.index',[
            'title'=>'Data cuti',
            'cuti'=>$cuti
        ]);
    }

    public function datacuti()
    {
        $cuti = DB::table('cuti')
        ->join('users', 'cuti.user_id', '=', 'users.id')
        ->select('users.nama','users.nik','cuti.*')
        ->get();
        return view('cuti.datacuti',[
            'title'=>'Data cuti',
            'cuti'=>$cuti
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cuti.create',[
            'title'=>'Data Pengajuan Cuti'
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
            'user_id'=>'required',
            'mulai'=>'required',
            'akhir'=>'required',
            'keterangan'=>'required',
            'status'=>'required',
        ]);
        // dd($validatedData);
        cuti::create($validatedData);
       return redirect('/cuti')->with('success','Data Berhasil Di Tambahkan'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function show(cuti $cuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function edit(cuti $cuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cuti $cuti)
    {
        $validatedData = $request->validate([
            'status'=>'required',
        ]);
        cuti::Where('id',$cuti->id)
               ->update($validatedData);
       return redirect('/data-cuti')->with('success','Data Berhasil Di Edit'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function destroy(cuti $cuti)
    {
        //
    }

    public function search(Request $request)
    {
        return view('cuti.laporan');
    }

    public function view_pdf(Request $request)
    {
   
        $year = $request->input('year');
        $data['cuti'] =  DB::table('cuti')
        ->join('users', 'cuti.user_id', '=', 'users.id')
        ->select('users.nama','users.nik','cuti.*')
        ->whereYear('cuti.created_at', $year)
        ->get();
        $pdf = Pdf::loadView('cuti.cetak_laporan', $data);
        return $pdf->download('laporan-data-cuti.pdf');
        
    }
    
    public function laporan(Request $request)

    {
        $year = $request->input('year');
        $cuti = DB::table('cuti')
            ->join('users', 'cuti.user_id', '=', 'users.id')
            ->select('users.nama','users.nik','cuti.*')
            ->whereYear('cuti.created_at', $year)
            ->get();
            $results = $cuti;
        return view('cuti.laporancuti', [
            'year' =>$year,
            'resulst'=>$cuti
        ],
        compact('results'));
        // return view('cuti.laporan');
    }


}
