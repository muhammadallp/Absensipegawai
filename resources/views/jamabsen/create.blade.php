@extends('layouts.main')
@section('container')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mb-4">
            <h1 class="mt-4 mb-4">Tambah Data Jam Absen</h1>  
            <div class="card mb-4"> 
            </div>
            <form method="post" action="/jamAbsen/">
                @csrf
                <div class="form-group mb-3">
                  <label for="exampleInputEmail1">Keterangan</label>
                  <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" autofocus value="{{ old('nama') }}">
                  @error('nama')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <label for="exampleInputEmail1">Slug</label>
                  <input type="text" name="slug" class="form-control" id="slug" disabled readonly >
                </div>
                <div class="form-group mb-3">
                  <label for="exampleInputEmail1">Awal</label>
                  <input type="time" name="awal" class="form-control @error('awal') is-invalid @enderror" id="awal" autofocus value="{{ old('awal') }}">
                  @error('awal')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <label for="exampleInputEmail1">Akhir</label>
                  <input type="time" name="akhir" class="form-control @error('akhir') is-invalid @enderror" id="akhir" autofocus value="{{ old('akhir') }}">
                  @error('akhir')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
              </form>
        </div>
    </main>
    <script>
      const nama = document.querySelector('#nama');
      const slug = document.querySelector('#slug');
  
      nama.addEventListener('change', function(){
          fetch('/jamAbsen/posts/checkSlug?nama=' + nama.value)
          .then(response => response.json())
          .then(data => slug.value = data.slug)
      });
  </script>
@endsection