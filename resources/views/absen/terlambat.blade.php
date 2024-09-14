@extends('layouts.main')
@section('container')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-6 mb-4">
            <h2 class="mt-4 mb-4">Laporan Data Absen PerHari</h2>
            @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
            {{ session('success') }}
            </div>
            @endif
            <form action="{{ route('setSession') }}" method="post">
                @csrf
                <div class="container mt-5">
                    <div class="row">
                        {{-- <div class="col-md-4 mr-3"> --}}
                            <div class="form-group col-sm-4 col-md-5 mb-2 ">
                                <div class="form-group mb-2">
                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Silahkan inputkan nama Camat"> 
                                </div>
                            </div>
                            <div class="form-group col-sm-2 col-md-5 mb-4 ml-3">
                                <div class="form-group mb-2">
                                    <input type="text" id="nip" name="nip" class="form-control" placeholder="silahkan Inputkan NIP Camat"> 
                                </div>
                            </div>
                            <div class="col-4 col-md-2 mb-4">
                                <button type="submit" class="btn btn-primary"> Save</button>
                            </div>
                    </div>
                </div>
            </form>
            <br>
            
   
              <div class="row g-0">
                    <div class="form-group col-sm-8 col-md-10 mb-4">
                        <input type="date" id="month" name="month" class="form-control"> 
                      </div>
                      <div class="col-4 col-md-2 mb-4">
                          <button type="submit" id="tampil" class="btn btn-primary"> <i class="fas fa-search "></i></button>
                      </div>


            </div>
            <div id="tampil_transaksi" class="row"></div>
        
    </main>
    <script>
        $(function(){
         $("#tampil").click(function(){
            var month = $("#month").val();
            $.ajax({
               url:"/laporan-terlambat-absen",
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