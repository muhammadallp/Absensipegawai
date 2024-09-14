<div class="container-fluid px-4">
    <!-- <h1 class="mt-4">Tables</h1> -->
    <form action="/viewterlambat" method="GET" class="mb-3">
    <input type="hidden" name="month" id="month" value="{{ $month }}">
    <button type="submit" id="tampil" class="btn btn-primary mb-3">Print PDF</button>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user fa-fw"></i>
           Data Absen
        </div>
        <div class="card-body">
            @if(count($data) > 0)
            <table class="table" id="datatablesSimple">
                <thead>
                            <tr>
                                <th>Nomor Induk Pegawai</th>
                                <th>Nama Pegawai</th>
                                <th>tanggal</th>
                                <th>Absen Masuk</th>
                                <th>absen Pulang</th>
                                <th>Keterangan</th>

                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($pegawai as $key => $value)
                            <tr>
                                
                                <td>{{ $value->nik }} </td>
                                <td>{{ $value->nama }}</td>
                                <td>{{date('d F Y', strtotime($month))  }}</td> 
                                {{-- @foreach ($absen[$key] as $absenData) --}}
                                @php
                                $absenData = $absen[$key]->first(); // Ambil data absen pertama dari hasil query
                                @endphp
                            
                                    <td>
                                    @if($absenData)
                                    {{ $absenData->absen_masuk }}
                                    <td>{{ $absenData->absen_pulang }}</td>
                                        @if($absenData->absen_masuk > $jamabsen->akhir)
                                        <td class="text-warning">Terlambat</td>
                                        @else
                                        <td><p class="text-primary">Hadir</p></td>
                                        @endif
                                     @else
                                     <p> - </p>
                                    <td> - </td>
                                     <td class="text-danger" >Tidak Hadir</td>

                              
                                @endif
                                    </td>
                                </tr>
                                @endforeach

                            
                        </tbody>
                    </table>
                    @else
                    <p>Tidak ada data absen yang ditemukan.</p>
                @endif
                </div>
            </div>
        </div>