@extends('layouts.main')
@section('container')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mb-4">
            <h1 class="mt-4 mb-4">Data Cuti</h1>
            @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
            {{ session('success') }}
            </div>
            @endif
            <a href="/cuti/create" class="btn btn-primary mb-3">Tambah Data</a>  
            <div class="card mb-4">

                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Nama Pegawai</th>
                                <th>Awal Cuti</th>
                                <th>Akhir Cuti</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cuti as $kr)
                            <tr>
                                <td>{{ $kr->nama }}</td>
                                <td>{{ $kr->mulai }}</td>
                                <td>{{ $kr->akhir }}</td>
                                <td>{{ $kr->keterangan }}</td>
                                @if($kr->status ===0)
                                <td><p class="text-danger fw-bold">Reject</p></td>
                                @elseif($kr->status ===1)
                                <td><p class="text-primary fw-bold">Process</p></td>
                                @else
                                <td><p class="text-success fw-bold">Approval</p></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

@endsection