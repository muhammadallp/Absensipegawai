@extends('layouts.main')
@section('container')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mb-4">
            <h1 class="mt-4 mb-4">Data Jam Absen</h1>
            @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
            {{ session('success') }}
            </div>
            @endif
            @if($total >= 2 )
            <a href="/jamAbsen/create" class="btn btn-primary mb-3 disabled" >Tambah Data</a>  
            @else
            <a href="/jamAbsen/create" class="btn btn-primary mb-3">Tambah Data</a>
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
                                <th>Keterangan</th>
                                <th>Aawal</th>
                                <th>Akhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jamAbsen as $ja)
                            <tr>
                                <td>{{ $ja->nama }}</td>
                                <td>{{ $ja->awal }}</td>
                                <td>{{ $ja->akhir }}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm border-0" href="/jamAbsen/{{$ja->slug}}/edit">  <i class="fas fa-pen "></i></a>
                                    <form method="post" action="/jamAbsen/{{$ja->slug}}" class="d-inline">
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