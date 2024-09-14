<?php

namespace App\Http\Controllers;

use App\Models\JamAbsen;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
class JamAbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = jamAbsen::count('id');
        // dd($total);
      return view('jamabsen.index',[
        'title'=>'Data Jam Absen',
        'jamAbsen'=>JamAbsen::all(),
        'total'=>$total

      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('jamabsen.create',[
        'title'=>'Data Jam Absen',

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
            'nama'=>'required',
            'slug'=>'',
            'awal'=>'required',
            'akhir'=>'required'
        ]);
        jamAbsen::create($validatedData);
        return redirect('/jamAbsen')->with('success','Data Berhasil Di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JamAbsen  $jamAbsen
     * @return \Illuminate\Http\Response
     */
    public function show(JamAbsen $jamAbsen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JamAbsen  $jamAbsen
     * @return \Illuminate\Http\Response
     */
    public function edit(JamAbsen $jamAbsen)
    {
        // dd($jamAbsen);
        return view('jamabsen.edit',[
            'title'=>'Data Jam Absen',
            'jamAbsen'=>$jamAbsen
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JamAbsen  $jamAbsen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JamAbsen $jamAbsen)
    {
        $validatedData = $request->validate([
            'nama'=>'required',
            'slug'=>'',
            'awal'=>'required',
            'akhir'=>'required'
        ]);
        // dd($validatedData);
        jamAbsen::where('id',$jamAbsen->id)
            ->update($validatedData);
        return redirect('/jamAbsen')->with('success','Data Berhasil Di Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JamAbsen  $jamAbsen
     * @return \Illuminate\Http\Response
     */
    public function destroy(JamAbsen $jamAbsen)
    {
        jamAbsen::destroy($jamAbsen->id);
        return redirect('/jamAbsen')->with('success', 'Data Berhasil dihapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(jamAbsen::class, 'slug', $request->nama);
        return response()->json(['slug'=>$slug]);
    }
}
