<div class="container-fluid px-4">
    <!-- <h1 class="mt-4">Tables</h1> -->
    <form action="/viewpdf" method="GET" class="mb-3">
    <input type="hidden" name="month" id="month" value="{{ $month }}">
    <button type="submit" id="tampil" class="btn btn-primary mb-3">Print PDF</button>
    <div class="card mb-4">
    
                @if(count($data) > 0)
                <table  border=1 width='100%' class='table ' cellspacing="0">
                <thead>
                    <tr>
                        <th rowspan="2" >Nip Pegawai  </th>
                        <th rowspan="2" >Nama Pegawai  </th>
                        <th colspan="{{ $total->total }}" class="text-center">Tanggal</th>
                    </tr>
                    <tr>
                       @foreach($hasil as $tanggal)
                            <th>{{ date('d', strtotime($tanggal->tgl)) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($pegawai as $key => $value)
                        <tr>
                            <td >{{ $value->nik }}</td>
                            <td >{{ $value->nama }}</td>
                            @foreach($hasil as $tgl)
                                @php
                                $tangal= $tgl->tgl;
                                    $absenData = $absen[$key]->where('tanggal', $tangal)->first();
                                    @endphp
                              @if($absenData)
                                @if($absenData->absen_masuk > $jamabsen->akhir)
                                <td class="text-warning">Terlambat</td>
                                @else
                                <td><p class="text-primary">Hadir</p></td>
                                @endif
                              
                                    @else
                                        <td class="text-danger" >
                                            Tidak Hadir
                                        </td>
                                    @endif

                                @endforeach
                                @endforeach
                            </tr>

                            
                        </tbody>
                    </table>
                    @else
                    <p>Tidak ada data absen yang ditemukan.</p>
                @endif
                </div>
        </div>