@extends('layouts.main')
@section('container')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mb-4">
            <h1 class="mt-4 mb-4">Data Cuti karyawan</h1>
            @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
            {{ session('success') }}
            </div>
            @endif

            <div class="card mb-4">
                {{-- <form action="" method="GET">
                    <select name="year">
                        @foreach(range(date('Y'), 2000) as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                    <button type="submit">Search</button>
                </form> --}}
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Nomor Induk Pegawai</th>
                                <th>Nama Pegawai</th>
                                <th>Awal Cuti</th>
                                <th>Akhir Cuti</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cuti as $kr)
                            <tr>
                                <td>{{ $kr->nik }}</td>
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
                                <td>
                                    <div class="col-12 ">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                              Opsi
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                              <li>
                                                <form method="post" action="/cuti/{{ $kr->id }}">
                                                    @method('put')
                                                      @csrf
                                                      <input type="hidden" name="status" value="2">
                                                <button type="submit" class="dropdown-item">Approve</button>
                                                </form>
                                            </li>
                                              <li>
                                                <form method="post" action="/cuti/{{ $kr->id }}">
                                                    @method('put')
                                                      @csrf
                                                      <input type="hidden" name="status" value="0">
                                                <button type="submit" class="dropdown-item">No Approve</button>
                                                </form>
                                            </li>
                                            </ul>
                                          {{-- </li> --}}
                                        {{-- </select> --}}
                                      </div>

                                      
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