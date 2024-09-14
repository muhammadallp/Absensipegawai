@extends('layouts.main')
@section('container')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mb-4">
            <h1 class="mt-4 mb-4">Tambah Data Karyawan</h1>  
            <div class="card mb-4"> 
            </div>
            <form method="post" action="/karyawan/">
                @csrf
                <div class="form-group mb-3">
                  <label for="exampleInputEmail1">Nomor Induk Pegawai</label>
                  <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" autofocus value="{{ old('nik') }}">
                  @error('nik')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" autofocus value="{{ old('nama') }}">
                  @error('nama')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <label for="exampleInputEmail1">Alamat</label>
                  <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" autofocus value="{{ old('alamat') }}">
                  @error('alamat')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                    <select class="form-select" name="jk" class="form-control" id="exampleFormControlSelect1">
                    <option selected disabled>Silahkan Pilih Jenis Kelamin</option>
                      <option value="laki-laki"> Laki-Laki</option>
                      <option value="perempuan"> Perembpuan</option>
                    </select>
                  </div>
                <div class="form-group mb-3">
                    <label for="exampleInputEmail1">nomor Handpone</label>
                    <input type="text" name="nohp" class="form-control @error('nohp') is-invalid @enderror" id="nohp" autofocus value="{{ old('nohp') }}">
                    @error('nohp')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="form-group mb-3">
                    <label for="exampleFormControlSelect1">Jabatan</label>
                    <select class="form-select" name="jabatan_id" class="form-control" id="exampleFormControlSelect1">
                    <option selected disabled>Silahkan Pilih Jabatan</option>
                    @foreach($jabatan as $jk)
                            @if(old('jabatan_id')==$jk->id)
                            <option value="{{ $jk->id }}" selected>{{ $jk->jabatan }}</option>
                            @else
                            <option value="{{ $jk->id }}">{{ $jk->jabatan }} </option>
                            @endif
                             @endforeach
                    </select>
                  </div>
                <div class="form-group mb-3">
                  <label  for="exampleInputPassword1">Password</label>
                  <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                  @error('password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                </div>
                <input type="hidden" name="level" value="pegawai">
                <input type="hidden" name="photo" value="default.jpg">
                <button type="submit" class="btn btn-primary">Tambah Data</button>
              </form>
        </div>
    </main>

@endsection