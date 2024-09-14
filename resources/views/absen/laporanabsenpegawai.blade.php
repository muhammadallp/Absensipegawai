<div class="container-fluid px-4">
    <!-- <h1 class="mt-4">Tables</h1> -->
    <form action="/viewpegawai" method="GET" class="mb-3">
    <input type="hidden" name="month" id="month" value="{{ $month }}">
    <input type="hidden" name="karyawan" id="karyawan" value="{{ $karyawan }}">
    <button type="submit" id="tampil" class="btn btn-primary mb-3">Print PDF</button>
    <div class="card mb-4">
    
                @if(count($data) > 0)
                <table  border=1 width='100%' class='table ' cellspacing="0">
                <thead>
                    <tr>
                        <th  >Nip Pegawai  </th>
                        <th  >Nama Pegawai  </th>
                        <th  >Total Hadir  </th>
                        <th  >Total Terlambat</th>
                        @php
                        $totalData = $total->total;
                        $totalalfa = $totalData - $totalData;
                    @endphp
                    </tr>
                    <tr>
 
                    </tr>
                </thead>
                <tbody>
                   

                    @foreach($pegawai as $key => $value)
                    @php
                    $pegawaiData = $pegawai->where('id', $karyawan )->first();
                    @endphp
                        <tr>
                            <td >{{ $value->nik }}</td>
                            <td >{{ $value->nama }}</td>
                            <td>{{ $totalData }}</td>

                            <td>{{ $terlambat->total }}</td>
                                @endforeach
                            </tr>

                            
                        </tbody>
                    </table>
                    @else
                    <p>Tidak ada data absen yang ditemukan.</p>
                @endif
                </div>
        </div>