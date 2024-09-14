<?php $session = session(); ?>
<body onLoad="javascript:print()"> 
                            <div class="panel-heading">
                            <table width="100%">
							<tr>
							<td><div align="center">
							<div align="center">
                                <b>PEMERINTAHAN KECAMATAN V KOTO<br>JL. Bendungan Air Manjuto, Lalang Luas, Kecamatan V koto, Mukomuko, Bengkulu</b><br><hr><br>Laporan Data Pegawai<br><?= Date('d F Y'); ?></div>
							 </td>
							</tr>
							</table>
                    </div>
                    <br>
                    <table id='theList' border=1 width='100%' class='table table-bordered table-striped' cellspacing="0">

                            <tr>
                                <th>Nomor Induk Pegawai</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>No HP</th>
                                <th>Jabatan</th>
                            </tr>

                            @foreach($users as $kr)
                            <tr>
                                <td>{{ $kr->nik }}</td>
                                <td>{{ $kr->nama }}</td>
                                <td>{{ $kr->alamat }}</td>
                                <td>{{ $kr->jk }}</td>
                                <td>{{ $kr->nohp }}</td>
                                <td>{{ $kr->jabatan }}</td>
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
                             <div align="center">Wali Nagara <?= Date('d F Y'); ?><br/>
                            Wali Nagari
                            <br/><br/>
                            <br/><br/>
                            {{ $session->get('namapegawai'); }}
                     
                            <br>
                            <?= $session->get('nip'); ?>
                            
                            <br/>
                            </div>
                        </td>
                    </tr>
                    </table> 