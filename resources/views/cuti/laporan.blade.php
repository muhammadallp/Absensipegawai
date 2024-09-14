@extends('layouts.main')
@section('container')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-6 mb-4">
            <h1 class="mt-4 mb-4">Data Cuti</h1>
            @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
            {{ session('success') }}
            </div>
            @endif
            
            {{-- <form action="/laporan-data-cuti" method="GET" class="mb-3"> --}}
              <div class="row g-0">
                    <div class="form-group col-sm-8 col-md-10 mb-4">
                        {{-- <label for="exampleFormControlSelect1">Tahun</label> --}}
                        <select class="form-select" name="year" class="form-control" id="year">
                        <option selected disabled>Silahkan Pilih Tahun</option>
                        @foreach(range(date('Y'), 2000) as $year)
                        @if(old('year')==$year)
                        <option value="{{ $year }}" selected>{{ $year }}</option>
                        @else
                        <option value="{{ $year }}">{{ $year }}</option>
                        @endif
                        @endforeach
                        </select>
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
            var year = $("#year").val();
            $.ajax({
               url:"/laporan-cuti",
               type:"GET",
               data:"year="+year,
               cache:false,
               success:function(html){
               $("#tampil_transaksi").html(html);
               }
            })
             })
          
        })
     </script>
@endsection