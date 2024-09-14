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
                    <div class="card-body">
                        <table width='100%'>
                            <tr>
                                <th align="left">
                                   NIP
                                </th>
                                <th align="left">
                                    :
                                </th>
                                <td  align="left">{{ $kn->nik }}</td>

                                <th align="right">
                                    Alamat
                                </th>
                                <th>
                                    :
                                </th>
                                <td>{{ $kn->alamat }}</td>
                            </tr>
                            <tr>
                                <th align="left">
                                    Nama
                                </th>
                                <th>
                                    :
                                </th>
                                <td>{{ $kn->nama }}</td>

                                <th align="right">
                                    Jenis Kelamin
                                    
                                </th>
                                <th>
                                    :
                                </th>
                                <td>{{ $kn->jk }}</td>
                                
                            </tr>
                            <tr>
                                <th align="left">
                                    Jabatan
                                </th>
                                <th>
                                    :
                                </th>
                                <td>{{$kn->jabatan }} </td>
                                
                                <th align="right">
                                    Nomor HandPone
                                </th>
                                <th>
                                    :
                                </th>
                                <td>{{ $kn->nohp }}</td>
                            </tr>
                               
                        
                     </table>
                    </div>   
                    <br>
                    <br>
                    @if(count($data) > 0)
                    <table id='theList' border=1 width='100%' class='table table-bordered table-striped' cellspacing="0">

                        <thead>
                            <tr>
                               
                                <th> Total Hadir  </th>
                                <th> Total Terlambat</th>
                                @php
                                $totalData = $total->total;
                                $totalalfa = $totalData - $totalData;
                            @endphp
                            </tr>
                        </thead>
                        <tbody>
                           
        
                            @foreach($pegawai as $key => $value)
                            @php
                            $pegawaiData = $pegawai->where('id', $karyawan )->first();
                            @endphp
                                <tr>
                                   
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