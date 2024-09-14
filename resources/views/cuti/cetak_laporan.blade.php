<?php $session = session(); ?>
<body onLoad="javascript:print()"> 


                            <div class="panel-heading">
                            <table width="100%">
							<tr>
							<td><div align="center">
							<div align="center">
							<b>PEMERINTAHAN KECAMATAN V KOTO<br>JL. Bendungan Air Manjuto, Lalang Luas, Kecamatan V koto, Mukomuko, Bengkulu</b><br><hr><br>Laporan Data Cuti Pegawai<br><?= Date('d F Y'); ?></div>
							 </td>
							</tr>
							</table>
                    </div>
                    <br>
                    <table id='theList' border=1 width='100%' class='table table-bordered table-striped' cellspacing="0">

                            <tr>
                                <th>Nama Pegawai</th>
                                <th>Awal Cuti</th>
                                <th>Akhir Cuti</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>

                            @foreach($cuti as $kr)
                            <tr>
                                <td>{{ $kr->nama }}</td>
                                <td>{{date('d F Y', strtotime($kr->mulai))  }}</td>
                                <td>{{date('d F Y', strtotime( $kr->akhir)) }}</td>
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

                    </table>
                    <br>
                    <br>
                    <br>
                    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF" >
                    <tr>
                        <td width="63%" bgcolor="#FFFFFF">
                            <p align="center"></p><br/>
                        </td>
                         <td width="37%" bgcolor="#FFFFFF">
                             <div align="center">Kecamatan V Koto <?= Date('d F Y'); ?><br/>
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