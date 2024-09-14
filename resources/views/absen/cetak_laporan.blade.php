<?php $session = session(); ?>
<body onLoad="javascript:print()"> 


                            <div class="panel-heading">
                            <table width="100%">
							<tr>
							<td><div align="center">
							<div align="center">
                                <b>PEMERINTAHAN KECAMATAN V KOTO<br>JL. Bendungan Air Manjuto, Lalang Luas, Kecamatan V koto, Mukomuko, Bengkulu</b><br><hr><br>Laporan Data Absen Pegawai<br> Bulan : <?= date('F Y', strtotime( $month))  ?></div>
							 </td>
							</tr>
							</table>
                    </div>
                    <br>
                    @if(count($data) > 0)
                    <table id='theList' border=1 width='100%' class='table table-bordered table-striped' cellspacing="0">

                        {{-- <table  border=1 width='100%' class='table ' cellspacing="0"> --}}
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
                                        <td class="text-primary">Hadir</td>
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