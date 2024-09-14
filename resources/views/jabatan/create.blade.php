@extends('layouts.main')
@section('container')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mb-4">
            <h1 class="mt-4 mb-4">Tambah Data Jabatan</h1>  
            <div class="card mb-4"> 
            </div>
            <form method="post" action="/jabatan/">
                @csrf
                <div class="form-group mb-3">
                  <label for="exampleInputEmail1">Nama Jabatan</label>
                  <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" autofocus value="{{ old('jabatan') }}">
                  @error('jabatan')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <label for="exampleInputEmail1">Slug</label>
                  <input type="text" name="slug" class="form-control" id="slug" disabled readonly >
                 
                </div>
                
                <button type="submit" class="btn btn-primary">Tambah Data</button>
              </form>
        </div>
    </main>
    <script>
      const jabatan = document.querySelector('#jabatan');
      const slug = document.querySelector('#slug');
  
      jabatan.addEventListener('change', function(){
          fetch('/jabatan/posts/checkSlug?jabatan=' + jabatan.value)
          .then(response => response.json())
          .then(data => slug.value = data.slug)
      });
  </script>
@endsection