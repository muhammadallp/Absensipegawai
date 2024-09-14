@extends('layouts.main')
@section('container')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mb-4">
            <h1 class="mt-4 mb-4">Data Jabatan</h1>
            @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
            {{ session('success') }}
            </div>
            @endif
            <a href="/jabatan/create" class="btn btn-primary mb-3">Tambah Data</a>  
            <div class="card mb-4">

                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Nama Jabatan</th>
                                <th>waktu dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jabatan as $kr)
                            <tr>
                                <td>{{ $kr->jabatan }}</td>
                                <td>{{ $kr->created_at }}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm border-0" href="/jabatan/{{$kr->slug}}/edit">  <i class="fas fa-pen "></i></a>
                                    <form method="post" action="/jabatan/{{$kr->slug}}" class="d-inline">
                                        @method('delete')
                                        @csrf
                                    <button class="btn btn-danger btn-sm border-0" onclick="return confirm('Apakah anda yakin mau dihapus?')"><span><i class="fas fa-trash "></i></span></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

@endsection