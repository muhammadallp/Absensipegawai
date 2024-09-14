@extends('layouts.main')
@section('container')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mb-4">
            <h1 class="mt-4 mb-4">Data Absen Karyawan</h1>
            @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
            {{ session('success') }}
            </div>
            @endif
            <div class="card mb-4">

                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>nomor Induk Pegawai</th>
                                <th>Nama Pegawai</th>
                                <th>Absen masuk</th>
                                <th>Absen Pulang</th>
                                <th>tanggal</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absen as $kr)
                            <tr>
                                <td>{{ $kr->nik }}</td>
                                <td>{{ $kr->nama }}</td>
                                <td>{{ $kr->absen_masuk }}</td>
                                <td>{{ $kr->absen_pulang }}</td>
                                <td>{{ $kr->created_at }}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

@endsection