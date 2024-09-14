<div class="container-fluid px-4">
    <!-- <h1 class="mt-4">Tables</h1> -->
    <form action="/view-pdf" method="GET" class="mb-3">
    <input type="hidden" name="year" id="year" value="{{ $year }}">
    <button type="submit" id="tampil" class="btn btn-primary mb-3">Print PDF</button>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user fa-fw"></i>
           Data Cuti
        </div>
        <div class="card-body">
            <table class="table" id="datatablesSimple">
                <thead>
                            <tr>
                                <th>Nama Pegawai</th>
                                <th>Awal Cuti</th>
                                <th>Akhir Cuti</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $kr)
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>