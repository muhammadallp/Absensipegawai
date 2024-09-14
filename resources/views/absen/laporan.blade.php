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
            
            {{-- <form action="/laporan-data-cuti" method="GET" class="mb-3"> --}}
              <div class="row g-0">
                    <div class="form-group col-sm-8 col-md-10 mb-4">
                        <input type="month" id="month" name="month" class="form-control"> 
                      </div>
                      <div class="col-4 col-md-2 mb-4">
                          <button type="submit" id="tampil" class="btn btn-primary"> <i class="fas fa-search "></i></button>
                      </div>
                {{-- </form> --}}

            </div>
            <div id="tampil_transaksi" class="row"></div>

            
        
    </main>
    <script>
        $(function(){
         $("#tampil").click(function(){
            var month = $("#month").val();
            $.ajax({
               url:"/laporan-absen",
               type:"GET",
               data:"month="+month,
               cache:false,
               success:function(html){
               $("#tampil_transaksi").html(html);
               }
            })
             })
          
        })
     </script>
@endsection