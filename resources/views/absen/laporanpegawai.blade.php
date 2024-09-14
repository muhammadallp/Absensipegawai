@extends('layouts.main')
@section('container')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-6 mb-4">
            <h2 class="mt-4 mb-4">Laporan Data Absen Karyawan Perbulan</h2>
            @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
            {{ session('success') }}
            </div>
            @endif
            
            <div class="container mt-5">
                <div class="row">
                    {{-- <div class="col-md-4 mr-3"> --}}
                        <div class="form-group col-sm-4 col-md-5 mb-2 ">
                            <!-- Form pertama di sini -->
                            <div class="form-group mb-2">
                                <select class="form-select" name="karyawan" id="karyawan" class="form-control" id="exampleFormControlSelect1">
                                    <option selected disabled>Silahkan Pilih Karyawan</option>
                                    @foreach ($pegawai as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                          
                                    </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-2 col-md-5 mb-4 ml-3">
                            <div class="form-group mb-2">
                                <input type="month" id="month" name="month" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-4 col-md-2 mb-4">
                            <button type="submit" id="tampil" class="btn btn-primary"> <i class="fas fa-search "></i></button>
                        </div>
                </div>
            </div>

            </div>
            <div id="tampil_transaksi" class="row"></div>

    </main>
    <script>


        $(function(){
    $("#tampil").click(function(){
        var month = $("#month").val();
        var karyawan = $("#karyawan").val();

        
        var data = {
            "month": month,
            "karyawan": karyawan,

        };

        $.ajax({
            url:"/laporan-absenpegawai",
            type: "GET",
            data: data,
            cache: false,
            success: function(html){
                $("#tampil_transaksi").html(html);
            }
        });
    });
});
     </script>
@endsection