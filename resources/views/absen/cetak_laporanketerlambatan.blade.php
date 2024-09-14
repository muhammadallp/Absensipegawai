<?php $session = session(); ?>
<body onLoad="javascript:print()"> 


                            <div class="panel-heading">
                            <table width="100%">
							<tr>
							<td><div align="center">
							<div align="center">
                                <b>PEMERINTAHAN KECAMATAN V KOTO<br>JL. Bendungan Air Manjuto, Lalang Luas, Kecamatan V koto, Mukomuko, Bengkulu</b><br><hr><br>Laporan Data Absen Perhari<br> Tanggal : {{date('d F Y', strtotime($month))  }}</div>
							 </td>
							</tr>
							</table>
                    </div>
                    <br>
                    
                    @if(count($data) > 0)
                    <table id='theList' border=1 width='100%' class='table table-bordered table-striped' cellspacing="0">
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
                                            @php
                                            $absenData = $absen[$key]->first(); // Ambil data absen pertama dari hasil query
                                            @endphp
                                    
                                                <td>
                                                    
                                                @if($absenData)
                                                {{ $absenData->absen_masuk }}
                                                <td>{{ $absenData->absen_pulang }}</td>
                                                
                                                @if($absenData->absen_masuk > $jamabsen->akhir)
                                                <td >Terlambat</td>
                                                @else
                                                <td>Hadir</td>
                                                @endif
                                               
                                                @else
                                                <p align="center" > - </p>
                                               <td ><p align="center"> - </p>  </td>
                                                <td class="text-danger" >Tidak Hadir</td>
                                                @endif
                                                </td>
                                                {{-- @endforeach --}}
                                            </tr>
                                            @endforeach
            
                                        
                                    </tbody>
                                </table>
                                @else
                                <p>Tidak ada data absen yang ditemukan.</p>
                            @endif
                    <br>
                    <br>
                    <br>
                    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF" >
                    <tr>
                        <td width="63%" bgcolor="#FFFFFF">
                            <p align="center"></p><br/>
                        </td>
                         <td width="37%" bgcolor="#FFFFFF">
                             <div align="center">Kecamatan V koto <?= Date('d F Y'); ?><br/>
                            Camat Kecamatan V Koto
                            <br/><br/>
                            <br/><br/>
                            {{ session('nama') }}
                       
                     
                            <br>
                            {{ session('nip') }}
                            
                            <br/>
                            </div>
                        </td>
                    </tr>
                    </table> 