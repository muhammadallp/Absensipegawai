<?php

namespace App\Http\Controllers;

use App\Models\absen;
use App\Models\User;
use App\Models\location;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Client;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        $absen = DB::table('absen')
        ->join('users', 'absen.user_id', '=', 'users.id')
        ->select('users.*','absen.*')
        ->get();

       
    
        return view('absen.index',[
            'title'=>'Data Absen Karyawan',
            'absen'=>$absen
        ]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $absen = absen::count();
      
        $jam_absen = DB::table('jam_absen')
        ->select('*',)
        ->where('nama','jam masuk')
        ->first();
        $jam_absen1 = DB::table('jam_absen')
        ->select('*',)
        ->where('nama','jam Pulang')
        ->first();

        // dd($jam_absen->awal);
       return view('absen.create',[
        'title'=>'Absen | ABSENSI KARYAWAN',
        'location'=>location::all(),
        'absen'=>$absen,
        'absen_masuk'=>$jam_absen,
        'absen_pulang'=>$jam_absen1,
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
 
        $location = location::first();
        if ($location->latitude == $request->latitude ) {  
            $validatedData = $request->validate([
                'user_id'=>'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'absen_masuk'=>'required',
                'tanggal'=>'required'
            ]);
            absen::create($validatedData);
             session()->put('ada', true);
            return redirect('/absen/create')->with('success', 'Data Absen Berhasi Ditambahkan!');
        }else {
            return redirect('/absen/create')->with('success', 'Anda berada di luar jangkauan absen!');
        }
        
    // }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function show(absen $absen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function edit(absen $absen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, absen $absen)
    {
        
    }

    public function absenedit(Request $request, $user_id)
    {
        $absen = DB::table('absen')
        ->select('*')
        ->where('user_id', $user_id)
        ->orderByDesc('created_at')
        ->limit(1)
        ->first();
        // dd($absen);
        if($absen === null){
            return redirect('/absen/create')->with('success', 'Absen masuk anda tidak ada! Silahkan hubungi admin');
        }else{
        $validatedData = $request->validate([
            'absen_pulang' => 'required',
        ]);
        // dd($absen);
        absen::Where('id',$absen->id )
               ->update($validatedData);
               session()->put('edit', true);
        return redirect('/absen/create')->with('success', 'Data Berhasil Diupdate');
    }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function destroy(absen $absen)
    {
        //
    }

    public function search(Request $request)
    {
        return view('absen.laporan');
    }
    
    public function laporan(Request $request)

    {

         $bulan = $request->input('month');
        $month=date('m',strtotime($bulan));
        $tahun=date('Y',strtotime($bulan));
        $awalBulan = Carbon::createFromDate($tahun, $month, 1)->startOfMonth();
        $akhirBulan = Carbon::createFromDate($tahun, $month, 1)->endOfMonth();

        // Mendapatkan daftar tanggal dalam bentuk array
        $daftarTanggal = [];
        $currentDate = $awalBulan;
    
        while ($currentDate->lte($akhirBulan)) {
            $daftarTanggal[] = $currentDate->toDateString();
            $currentDate->addDay(); // Menambahkan 1 hari
        }
        // dd($bulan);
     
            $data= DB::table('absen')
            ->select('absen.*')
            ->whereMonth('absen.created_at', $month)
            ->get();

            $hasil = DB::table('absen')
            ->selectRaw('date(created_at) as tgl, count(*) as total')
            ->whereMonth('absen.created_at', $month)
            ->groupBy('tgl')
            ->get();
            $total = DB::table('absen')
            ->selectRaw('date(created_at) as tgl, count(*) as total')
            ->groupBy('tgl')
            ->first();

        // dd($hasil);
            $jam_absen = DB::table('jam_absen')
            ->select('*',)
            ->where('nama','jam masuk')
            ->first();
            $pegawai =DB::table('users')
            ->select('id','nik','nama')
            ->where('level','!=','admin')
            ->get();

            foreach ($pegawai as $key => $value) {
                $absen[] = DB::table('absen')
                    ->select('absen.*')
                    // ->where('absen.absen_masuk', '>', $jam_absen->akhir)
                    ->where('absen.user_id', $value->id)
                    ->whereMonth('absen.created_at', $month)
                    // ->where('created_at', 'like', $tangal . '%')
                    ->get();
            }
            $results[] = $absen;
        return view('absen.laporanabsen', [
            'daftarTanggal' => $daftarTanggal,
            'month' =>$bulan,
            'resulst'=>$request,
            'pegawai'=>$pegawai,
            'absen'=>$absen,
            'jamabsen'=>$jam_absen,
            'data'=>$data,
            'hasil'=>$hasil,
            'total' =>$total
        ],
        compact('results'));
        // return view('cuti.laporan');
    }


    public function viewpdf(Request $request)
    {
        
        $bulan = $request->input('month');
        $month=date('m',strtotime($bulan));
        $tahun=date('Y',strtotime($bulan));
        $awalBulan = Carbon::createFromDate($tahun, $month, 1)->startOfMonth();
        $akhirBulan = Carbon::createFromDate($tahun, $month, 1)->endOfMonth();

        // Mendapatkan daftar tanggal dalam bentuk array
        $daftarTanggal = [];
        $currentDate = $awalBulan;
    
        while ($currentDate->lte($akhirBulan)) {
            $daftarTanggal[] = $currentDate->toDateString();
            $currentDate->addDay(); // Menambahkan 1 hari
        }
        // dd($bulan);
     
            $data= DB::table('absen')
                    ->select('absen.*')
                    ->whereMonth('absen.created_at', $month)
                    ->get();
           
            $hasil = DB::table('absen')
            ->selectRaw('date(created_at) as tgl, count(*) as total')
            ->whereMonth('absen.created_at', $month)
            ->groupBy('tgl')
            ->get();
            $total = DB::table('absen')
            ->selectRaw('date(created_at) as tgl, count(*) as total')
            ->groupBy('tgl')
            ->first();

        // dd($hasil);
            $jam_absen = DB::table('jam_absen')
            ->select('*',)
            ->where('nama','jam masuk')
            ->first();
            $pegawai =DB::table('users')
            ->select('id','nik','nama')
            ->where('level','!=','admin')
            ->get();

            foreach ($pegawai as $key => $value) {
                $absen[] = DB::table('absen')
                    ->select('absen.*')
                    // ->where('absen.absen_masuk', '>', $jam_absen->akhir)
                    ->where('absen.user_id', $value->id)
                    ->whereMonth('absen.created_at', $month)
                    // ->where('created_at', 'like', $tangal . '%')
                    ->get();
            }
            $results[] = $absen;
        $pdf = Pdf::loadView('absen.cetak_laporan',[
            'daftarTanggal' => $daftarTanggal,
            'month' =>$bulan,
            'resulst'=>$request,
            'pegawai'=>$pegawai,
            'absen'=>$absen,
            'jamabsen'=>$jam_absen,
            'data'=>$data,
            'hasil'=>$hasil,
            'total' =>$total

        ]);
        return $pdf->download('laporan-data-absen.pdf');
        
    }

    public function setSession(Request $request)
    {
        $request->session()->put('nama', $request->nama);
        $request->session()->put('nip', $request->nip);
        return redirect('/laporan-terlambat');
    }


    public function terlambat(Request $request)
    {
        return view('absen.terlambat');
    }
    
    public function laporanterlambat(Request $request)

    {
            $bulan = $request->input('month');
            $month=date('d',strtotime($bulan));
            $data= DB::table('absen')
                    ->select('absen.*')
                    ->whereDate('absen.created_at', $bulan)
                    ->get();
        // dd($bulan);
            $jam_absen = DB::table('jam_absen')
            ->select('*',)
            ->where('nama','jam masuk')
            ->first();
            $pegawai =DB::table('users')
            ->select('id','nik','nama')
            ->where('level','!=','admin')
            ->get();

            foreach ($pegawai as $key => $value) {
                $absen[] = DB::table('absen')
                    ->select('absen.*')
                    // ->where('absen.absen_masuk', '>', $jam_absen->akhir)
                    ->where('absen.user_id', $value->id)
                    ->whereDate('absen.created_at', $bulan)
                    ->get();
            }

            $results[] = $absen;
            // dd($data);
        return view('absen.laporanterlambat', [
            'month' =>$bulan,
            'resulst'=>$request,
            'pegawai'=>$pegawai,
            'absen'=>$absen,
            'jamabsen'=>$jam_absen,
            'data'=>$data
        ],
        compact('results'));
        // return view('cuti.laporan');
    }

    public function viewterlambat(Request $request)
    {
        
        $bulan = $request->input('month');
        $month=date('d',strtotime($bulan));
        $data= DB::table('absen')
                ->select('absen.*')
                ->whereDate('absen.created_at', $bulan)
                ->get();
            // dd($bulan);
                $jam_absen = DB::table('jam_absen')
                ->select('*',)
                ->where('nama','jam masuk')
                ->first();
                $pegawai =DB::table('users')
                ->select('id','nik','nama')
                ->where('level','!=','admin')
                ->get();

        foreach ($pegawai as $key => $value) {
            $absen[] = DB::table('absen')
                ->select('absen.*')
                // ->where('absen.absen_masuk', '>', $jam_absen->akhir)
                ->where('absen.user_id', $value->id)
                ->whereDate('absen.created_at', $bulan)
                ->get();
        }
        $pdf = Pdf::loadView('absen.cetak_laporanketerlambatan',[
            'month' =>$bulan,
            'resulst'=>$request,
            'pegawai'=>$pegawai,
            'absen'=>$absen,
            'jamabsen'=>$jam_absen,
            'data'=>$data
        ]);
        return $pdf->download('laporan-data-absen.pdf');
        
    }

    // laporan absen perpegawai

    public function searchpegawai(Request $request)
    {
        $pegawai = user::where('level','!=','admin')->get();
        // dd($pegawai);
        return view('absen.laporanpegawai',[
            'title'=>'Laporan Absen',
            'pegawai'=>$pegawai,
        ]);
    }
    
    public function laporanpegawai(Request $request)

    {

         $bulan = $request->input('month');
         $karyawan = $request->input('karyawan');
        $month=date('m',strtotime($bulan));
        $tahun=date('Y',strtotime($bulan));
    


        // dd($daftarTanggal);
            $data= DB::table('absen')
            ->select('absen.*')
            // ->where('user_id',$karyawan)
            ->whereMonth('absen.created_at', $month)
            ->get();
            $hasil = DB::table('absen')
            ->selectRaw('date(created_at) as tgl, count(*) as total')
            // ->where('user_id',$karyawan)
            ->whereMonth('absen.created_at', $month)
            ->groupBy('tgl')
            ->get();
            $total = DB::table('absen')
            ->selectRaw('user_id as tgl, count(user_id) as total')
            ->whereMonth('created_at', $month)
            ->where('user_id',$karyawan)
            ->groupBy('tgl')
            ->first();

            $jam_absen = DB::table('jam_absen')
            ->select('*',)
            ->where('nama','jam masuk')
            ->first();
            $terlambat = DB::table('absen')
            ->selectRaw('user_id as tgl, count(user_id) as total')
            ->whereMonth('created_at', $month)
            ->where('user_id',$karyawan)
            ->where('absen_masuk','>',$jam_absen->akhir)
            ->groupBy('tgl')
            ->first();
        // dd($terlambat);
            $pegawai =DB::table('users')
            ->select('id','nik','nama')
            ->where('level','!=','admin')
            ->where('id',$karyawan)
            ->get();
            foreach ($pegawai as $key => $value) {
                $absen[] = DB::table('absen')
                    ->select('absen.*')
                    ->where('absen.user_id', $value->id)
                    ->whereMonth('absen.created_at', $month)
                    ->get();
            }
            $results= $absen;
        return view('absen.laporanabsenpegawai', [
            'month' =>$bulan,
            'karyawan' =>$karyawan,
            'resulst'=>$request,
            'pegawai'=>$pegawai,
            'absen'=>$absen,
            'jamabsen'=>$jam_absen,
            'data'=>$data,
            'hasil'=>$hasil,
            'total' =>$total,
            'terlambat' =>$terlambat
        ],
        compact('results'));
        // return view('cuti.laporan');
    }

    public function viewpegawai(Request $request)
    {
        
        $bulan = $request->input('month');
        $karyawan = $request->input('karyawan');
            $month=date('m',strtotime($bulan));
            $tahun=date('Y',strtotime($bulan));
            $data= DB::table('absen')
            ->select('absen.*')
            // ->where('user_id',$karyawan)
            ->whereMonth('absen.created_at', $month)
            ->get();
            $hasil = DB::table('absen')
            ->selectRaw('date(created_at) as tgl, count(*) as total')
            // ->where('user_id',$karyawan)
            ->whereMonth('absen.created_at', $month)
            ->groupBy('tgl')
            ->get();
            $total = DB::table('absen')
            ->selectRaw('user_id as tgl, count(user_id) as total')
            ->whereMonth('created_at', $month)
            ->where('user_id',$karyawan)
            ->groupBy('tgl')
            ->first();

            $jam_absen = DB::table('jam_absen')
            ->select('*',)
            ->where('nama','jam masuk')
            ->first();
            $terlambat = DB::table('absen')
            ->selectRaw('user_id as tgl, count(user_id) as total')
            ->whereMonth('created_at', $month)
            ->where('user_id',$karyawan)
            ->where('absen_masuk','>',$jam_absen->akhir)
            ->groupBy('tgl')
            ->first();
           $krn =DB::table('users')
           ->join('jabatan', 'users.jabatan_id', '=', 'jabatan.id')
           ->select('users.*', 'jabatan.jabatan')
           ->where('users.level','!=','admin')
           ->where('users.id',$karyawan)
           ->first();

           $pegawai =DB::table('users')
           ->select('id','nik','nama')
           ->where('level','!=','admin')
           ->where('id',$karyawan)
           ->get();
           foreach ($pegawai as $key => $value) {
               $absen[] = DB::table('absen')
                   ->select('absen.*')
                   ->where('absen.user_id', $value->id)
                   ->whereMonth('absen.created_at', $month)
                   ->get();
           }
           $results= $absen;
        $pdf = Pdf::loadView('absen.cetak_laporanpegawai',[
            'month' =>$bulan,
            'karyawan' =>$karyawan,
            'resulst'=>$request,
            'pegawai'=>$pegawai,
            'absen'=>$absen,
            'jamabsen'=>$jam_absen,
            'data'=>$data,
            'hasil'=>$hasil,
            'total' =>$total,
            'terlambat' =>$terlambat,
           'kn' => $krn,

        ]);
        return $pdf->download('laporan-data-absen.pdf');
        
    }

//     use GuzzleHttp\Client;
// use Carbon\Carbon;

// public function getHolidays($year, $month)
// {
   
// }


    
}

