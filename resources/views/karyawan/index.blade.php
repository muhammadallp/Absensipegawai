@extends('layouts.main')
@section('container')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mb-4">
            <h1 class="mt-4 mb-4">Data Pegawai</h1>
            @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
            {{ session('success') }}
            </div>
            @endif
            <div class="btn-group" role="group" aria-label="Tombol-tombol">
                <a href="/karyawan/create" class="btn btn-primary btn-sm mb-3">Tambah Data</a>  
                <a href="/laporan-karyawan" class="btn btn-info btn-sm mb-3">Print PDF</a>
        </div>
        
            <div class="card mb-4">

                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Nomor Induk Pegawai</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>No HP</th>
                                <th>Jabatan</th>
                                <th>Photo</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($karyawan as $kr)
                            <tr>
                                <td>{{ $kr->nik }}</td>
                                <td>{{ $kr->nama }}</td>
                                <td>{{ $kr->alamat }}</td>
                                <td>{{ $kr->jk }}</td>
                                <td>{{ $kr->nohp }}</td>
                                <td>{{ $kr->jabatan }}</td>
                                <td>{{ $kr->photo }}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm border-0" href="/karyawan/{{$kr->id}}/edit">  <i class="fas fa-pen "></i></a>
                                    <form method="post" action="/karyawan/{{$kr->id}}" class="d-inline">
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