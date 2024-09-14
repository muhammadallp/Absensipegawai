<?php

namespace App\Http\Controllers;

use App\Models\jabatan;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jabatan.index',[
            'title'=>'Data Jabatan',
            'jabatan'=>jabatan::all()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jabatan.create',[
            'title'=>'Data jabatan',
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
            'jabatan'=>'required',
            'slug'=>''
        ]);
       jabatan::create($validatedData);
       return redirect('/jabatan')->with('success','Data Berhasil Di Tambahkan'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(jabatan $jabatan)
    {
        return view('jabatan.edit',[
            'title'=>'Data Jabatan',
            'jabatan'=>$jabatan,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jabatan $jabatan)
    {
        $validatedData = $request->validate([
            'jabatan'=>'required',
            'slug'=>''
        ]);
        jabatan::Where('id',$jabatan->id)
               ->update($validatedData);
       return redirect('/jabatan')->with('success','Data Berhasil Di Edit'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(jabatan $jabatan)
    {
        jabatan::destroy($jabatan->id);
        return redirect('/jabatan')->with('success', 'Data Berhasil dihapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(jabatan::class, 'slug', $request->jabatan);
        return response()->json(['slug'=>$slug]);
    }
}
