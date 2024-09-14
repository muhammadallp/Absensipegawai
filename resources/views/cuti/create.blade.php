@extends('layouts.main')
@section('container')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mb-4">
            <h1 class="mt-4 mb-4">Tambah Data Cuti</h1>  
            <div class="card mb-4"> 
            </div>
            <form method="post" action="/cuti/">
                @csrf
                <div class="form-group mb-3">
                  <label for="exampleInputEmail1">Nama </label>
                  <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" readonly value="{{ auth()->user()->nama }}">
                  <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                  <input type="hidden" name="status" value="1">
                  @error('nama')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <label for="exampleInputEmail1">Awal Cuti</label>
                  <input type="date" name="mulai" class="form-control @error('mulai') is-invalid @enderror" id="mulai" autofocus value="{{ old('mulai') }}">
                  @error('mulai')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <label for="exampleInputEmail1">Akhir Cuti</label>
                  <input type="date" name="akhir" class="form-control @error('akhir') is-invalid @enderror" id="akhir" autofocus value="{{ old('akhir') }}">
                  @error('akhir')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                  <textarea class="form-control  @error('keterangan') is-invalid @enderror" name="keterangan" id="exampleFormControlTextarea1" rows="3"  value="{{ old('keterangan') }}"></textarea>
                  @error('keterangan')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
              </form>
        </div>
    </main>
@endsection